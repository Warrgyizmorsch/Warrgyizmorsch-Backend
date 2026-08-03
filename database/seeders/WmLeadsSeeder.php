<?php

namespace Database\Seeders;

use App\Models\Leads;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use RuntimeException;

class WmLeadsSeeder extends Seeder
{
    public function run(): void
    {
        $workbookPath = env(
            'WM_LEADS_SEEDER_FILE',
            'C:\\Users\\ansh\\Downloads\\new leads - wm (1).xlsx'
        );

        if (! is_file($workbookPath)) {
            throw new RuntimeException("WM leads workbook was not found: {$workbookPath}");
        }

        $rows = IOFactory::load($workbookPath)
            ->getActiveSheet()
            ->toArray(null, true, true, false);

        $headers = array_map([$this, 'normalizeHeader'], array_shift($rows) ?? []);
        $bucket = DB::table('buckets')->where('name', 'Lead')->first();
        $imported = 0;
        $skipped = [];

        DB::transaction(function () use ($rows, $headers, $bucket, &$imported, &$skipped): void {
            foreach ($rows as $index => $row) {
                $lead = array_combine($headers, array_pad($row, count($headers), null));
                $metaLeadId = $this->metaLeadId($lead['id'] ?? null);

                if (! $metaLeadId) {
                    $skipped[] = $this->skippedRow($index, $lead, 'Missing or invalid Meta lead ID.');
                    continue;
                }

                if (Leads::where('lead_id', $metaLeadId)->exists()) {
                    $skipped[] = $this->skippedRow($index, $lead, 'Lead ID already exists.');
                    continue;
                }

                [$countryCode, $phone] = $this->phoneDetails($lead['phone_number'] ?? null);

                if (! $phone) {
                    $skipped[] = $this->skippedRow($index, $lead, 'Missing or invalid phone number.');
                    continue;
                }

                $email = strtolower(trim((string) ($lead['email_address'] ?? '')));
                $email = $email ?: "{$phone}@gmail.com";
                $user = $this->findOrCreateUser(
                    trim((string) ($lead['full_name'] ?? '')),
                    $email,
                    $phone,
                    $countryCode
                );
                $createdAt = $this->createdAt($lead['created_time'] ?? null);

                DB::table('leads')->insert([
                    'lead_id' => $metaLeadId,
                    'uid' => $user->id,
                    'date' => $createdAt->toDateString(),
                    'campaign_name' => $this->value($lead, 'campaign_name'),
                    'adset_name' => $this->value($lead, 'adset_name'),
                    'ad_name' => $this->value($lead, 'ad_name'),
                    'form_name' => $this->value($lead, 'form_name'),
                    'platform' => $this->platform($lead['platform'] ?? null),
                    'company_name' => $this->companyName($lead),
                    'description' => $this->value($lead, 'comment'),
                    'lead_data' => json_encode([
                        'ad_id' => $this->value($lead, 'ad_id'),
                        'adset_id' => $this->value($lead, 'adset_id'),
                        'campaign_id' => $this->value($lead, 'campaign_id'),
                        'form_id' => $this->value($lead, 'form_id'),
                    ], JSON_THROW_ON_ERROR),
                    'lead_bucket_id' => $bucket?->id,
                    'lead_status' => $bucket?->name,
                    'is_converted' => false,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);

                $imported++;
            }
        });

        Storage::disk('local')->put(
            'imports/wm-leads-skipped.json',
            json_encode($skipped, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR)
        );

        $this->command?->info(
            'WM leads import complete: ' . $imported . ' imported, ' . count($skipped) . ' skipped.'
        );
        $this->command?->info('Skipped rows: storage/app/imports/wm-leads-skipped.json');
    }

    private function findOrCreateUser(string $name, string $email, string $phone, ?string $countryCode): User
    {
        $user = User::where('contact_no', $phone)
            ->orWhere('email', $email)
            ->first();

        if ($user) {
            if (! $user->country_code && $countryCode) {
                $user->update(['country_code' => $countryCode]);
            }

            return $user;
        }

        return User::create([
            'name' => $name ?: 'Meta User',
            'email' => $email,
            'contact_no' => $phone,
            'country_code' => $countryCode,
            'role_id' => 2,
            'password' => Hash::make('user@123'),
        ]);
    }

    private function metaLeadId(mixed $value): ?int
    {
        $digits = preg_replace('/\D+/', '', (string) $value);

        return $digits === '' ? null : (int) $digits;
    }

    private function phoneDetails(mixed $value): array
    {
        $digits = preg_replace('/\D+/', '', (string) $value);

        if (strlen($digits) === 12 && str_starts_with($digits, '91')) {
            return ['+91', substr($digits, 2)];
        }

        if (strlen($digits) === 10) {
            return ['+91', $digits];
        }

        return [null, null];
    }

    private function createdAt(mixed $value): Carbon
    {
        try {
            return Carbon::parse((string) $value)->setTimezone(config('app.timezone'));
        } catch (\Throwable) {
            return now();
        }
    }

    private function platform(mixed $value): ?string
    {
        $platform = strtolower(trim((string) $value));

        return match ($platform) {
            'fb', 'facebook' => 'facebook',
            'ig', 'instagram' => 'instagram',
            'linkedin', 'linkding' => 'linkedin',
            '' => null,
            default => $platform,
        };
    }

    private function companyName(array $lead): ?string
    {
        $companyName = $this->value($lead, 'company_name');

        if ($companyName) {
            return $companyName;
        }

        return strtolower((string) ($lead['platform'] ?? '')) === 'company'
            ? $this->value($lead, 'full_name')
            : null;
    }

    private function skippedRow(int $index, array $lead, string $reason): array
    {
        return [
            'row' => $index + 2,
            'lead_id' => $lead['id'] ?? null,
            'full_name' => $lead['full_name'] ?? null,
            'phone_number' => $lead['phone_number'] ?? null,
            'reason' => $reason,
        ];
    }

    private function normalizeHeader(mixed $header): string
    {
        return trim((string) preg_replace('/[^a-z0-9]+/i', '_', strtolower((string) $header)), '_');
    }

    private function value(array $lead, string $key): ?string
    {
        $value = trim((string) ($lead[$key] ?? ''));

        return $value === '' ? null : $value;
    }
}
