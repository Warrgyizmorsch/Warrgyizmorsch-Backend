<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Leads;
use App\Models\CallBack;
use App\Models\LeadImportJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LeadsCommentsImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $importJobId;
    public ?int $uploadedBy;

    public function __construct(int $importJobId, ?int $uploadedBy = null)
    {
        $this->importJobId = $importJobId;
        $this->uploadedBy = $uploadedBy;
        $this->onQueue('default');
    }

    public function handle(): void
    {
        $importJob = LeadImportJob::find($this->importJobId);
        if (!$importJob) {
            Log::error("Comments import job not found: ID {$this->importJobId}");
            return;
        }

        $importJob->update(['status' => 'processing', 'processed_rows' => 0]);

        $fullPath = Storage::path($importJob->file_path);
        if (!file_exists($fullPath)) {
            Log::error("File not found at: {$fullPath}");
            $importJob->update(['status' => 'failed', 'message' => 'File not found on server']);
            return;
        }

        try {
            $spreadsheet = IOFactory::load($fullPath);
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestDataRow();
            $highestColumn = $sheet->getHighestDataColumn();

            $row1 = $sheet->rangeToArray("A1:{$highestColumn}1", null, true, true, true)[1] ?? [];
            
            $norm = fn(string $h) => trim(preg_replace('/[^a-z0-9]+/i', '_', mb_strtolower(str_replace(['’', "'"], '', $h))), '_');

            // Detect column positions
            $colMap = [
                'phone' => null,
                'email' => null,
                'name' => null,
                'comments' => []
            ];

            foreach ($row1 as $colLetter => $rawHeader) {
                if (empty($rawHeader)) continue;
                $nHeader = $norm($rawHeader);

                if (in_array($nHeader, ['contact_no', 'contact', 'mobile', 'phone', 'phone_number']) && !$colMap['phone']) {
                    $colMap['phone'] = $colLetter;
                } elseif (in_array($nHeader, ['user_email', 'email']) && !$colMap['email']) {
                    $colMap['email'] = $colLetter;
                } elseif (in_array($nHeader, ['user_name', 'name']) && !$colMap['name']) {
                    $colMap['name'] = $colLetter;
                } elseif (str_contains($nHeader, 'comment')) {
                    $colMap['comments'][] = $colLetter;
                }
            }

            $matchedLeadsCount = 0;
            $importedCommentsCount = 0;
            $skippedRowsCount = 0;
            $skippedDetails = [];

            DB::beginTransaction();

            for ($r = 2; $r <= $highestRow; $r++) {
                $rawPhone = $colMap['phone'] ? $sheet->getCell("{$colMap['phone']}{$r}")->getValue() : null;
                $rawEmail = $colMap['email'] ? $sheet->getCell("{$colMap['email']}{$r}")->getValue() : null;
                $rawName  = $colMap['name']  ? $sheet->getCell("{$colMap['name']}{$r}")->getValue()  : null;

                // Clean phone number: remove +91, spaces, hyphens, non-digits
                $phone = preg_replace('/[^0-9]/', '', (string)$rawPhone);
                if (strlen($phone) > 10 && str_starts_with($phone, '91')) {
                    $phone = substr($phone, -10);
                }

                $email = strtolower(trim((string)$rawEmail));
                $name  = trim((string)$rawName);

                if (!$phone && !$email && !$name) {
                    $skippedRowsCount++;
                    $skippedDetails[] = [
                        'row' => $r,
                        'name' => 'Empty Row',
                        'phone' => 'N/A',
                        'email' => 'N/A',
                    ];
                    $importJob->increment('processed_rows');
                    continue;
                }

                // Match existing lead by Phone, Email, or Name
                $lead = null;

                if (!empty($phone)) {
                    $lead = Leads::whereHas('user', function ($q) use ($phone) {
                        $q->whereRaw("REPLACE(REPLACE(REPLACE(contact_no, ' ', ''), '+91', ''), '-', '') LIKE ?", ['%' . $phone . '%']);
                    })->latest()->first();
                }

                if (!$lead && !empty($email) && !str_contains($email, '@demo.com')) {
                    $lead = Leads::whereHas('user', function ($q) use ($email) {
                        $q->where('email', $email);
                    })->latest()->first();
                }

                if (!$lead && !empty($name)) {
                    $lead = Leads::whereHas('user', function ($q) use ($name) {
                        $q->where('name', 'like', '%' . $name . '%');
                    })->latest()->first();
                }

                if (!$lead) {
                    // Do NOT create duplicate lead as per requirement!
                    $skippedRowsCount++;
                    $skippedDetails[] = [
                        'row' => $r,
                        'name' => $name ?: 'N/A',
                        'phone' => $phone ?: 'N/A',
                        'email' => $email ?: 'N/A',
                    ];
                    $importJob->increment('processed_rows');
                    continue;
                }

                $matchedLeadsCount++;
                $rowCommentsAdded = false;

                // Extract all comments from comment, comment 1, comment 2 columns
                foreach ($colMap['comments'] as $colLet) {
                    $commentVal = trim((string)$sheet->getCell("{$colLet}{$r}")->getValue());
                    if ($commentVal === '' || $commentVal === 'N/A' || $commentVal === '-') continue;

                    // Avoid duplicate comment insertion for the same lead
                    $exists = CallBack::where('lead_id', $lead->id)
                        ->where('message', $commentVal)
                        ->exists();

                    if (!$exists) {
                        CallBack::create([
                            'lead_id' => $lead->id,
                            'created_by' => $this->uploadedBy ?? 1,
                            'message' => $commentVal,
                            'status' => $lead->lead_status ?? 'Followup',
                            'is_done' => 1,
                        ]);
                        $importedCommentsCount++;
                        $rowCommentsAdded = true;
                    }
                }

                $importJob->increment('processed_rows');
            }

            DB::commit();

            $skippedListText = "";
            if (!empty($skippedDetails)) {
                $skippedListText .= "\n\n--- Unmatched Skipped Rows ({$skippedRowsCount}) ---\n";
                foreach ($skippedDetails as $item) {
                    $skippedListText .= "Row {$item['row']}: {$item['name']} | Phone: {$item['phone']} | Email: {$item['email']}\n";
                }
            }

            $summaryMsg = "Comments Import Complete!\nMatched Leads: {$matchedLeadsCount} | Comments Imported: {$importedCommentsCount} | Skipped Rows: {$skippedRowsCount}" . $skippedListText;

            $updateData = ['status' => 'completed'];
            if (\Illuminate\Support\Facades\Schema::hasColumn('lead_import_jobs', 'error_message')) {
                $updateData['error_message'] = $summaryMsg;
            }
            if (\Illuminate\Support\Facades\Schema::hasColumn('lead_import_jobs', 'message')) {
                $updateData['message'] = $summaryMsg;
            }

            $importJob->update($updateData);

            Log::info($summaryMsg);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("Comments Import Job Failed: " . $e->getMessage(), ['exception' => $e]);
            $errData = ['status' => 'failed'];
            if (\Illuminate\Support\Facades\Schema::hasColumn('lead_import_jobs', 'error_message')) {
                $errData['error_message'] = 'Error: ' . $e->getMessage();
            }
            if (\Illuminate\Support\Facades\Schema::hasColumn('lead_import_jobs', 'message')) {
                $errData['message'] = 'Error: ' . $e->getMessage();
            }
            $importJob->update($errData);
        }
    }
}
