<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Mail\LeadEmail;
use App\Models\EmailLog;
use App\Models\EmailTemplate;
use App\Models\Leads;
use App\Services\EmailTemplateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LeadEmailController extends Controller
{
    protected EmailTemplateService $templateService;

    public function __construct(EmailTemplateService $templateService)
    {
        $this->templateService = $templateService;
    }

    /**
     * Get list of active email templates for dropdown
     */
    public function getTemplates()
    {
        $templates = EmailTemplate::where('status', 1)
            ->select('id', 'name', 'type', 'subject')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json([
            'status' => 'success',
            'templates' => $templates,
        ]);
    }

    /**
     * Generate dynamic preview for selected lead & template
     */
    public function generatePreview(Request $request)
    {
        $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'template_id' => 'required|exists:email_templates,id',
        ]);

        $lead = Leads::with(['user', 'owner'])->findOrFail($request->lead_id);
        $template = EmailTemplate::findOrFail($request->template_id);

        if (!$template->status) {
            return response()->json([
                'status' => 'error',
                'message' => 'The selected email template is currently inactive.',
            ], 422);
        }

        $emailValidation = $this->templateService->validateLeadEmail($lead);
        if (!$emailValidation['valid']) {
            return response()->json([
                'status' => 'error',
                'message' => $emailValidation['message'],
            ], 422);
        }

        $generatedSubject = $this->templateService->replaceVariables($template->subject, $lead);
        $rawBody = $this->templateService->replaceVariables($template->body, $lead);
        $generatedBody = $this->templateService->formatBodyContent($rawBody);

        return response()->json([
            'status' => 'success',
            'to_email' => $emailValidation['email'],
            'lead_name' => optional($lead->user)->name ?? 'N/A',
            'subject' => $generatedSubject,
            'body' => $generatedBody,
        ]);
    }

    /**
     * Send dynamic email to lead & record log
     */
    public function sendEmail(Request $request)
    {
        $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'template_id' => 'required|exists:email_templates,id',
            'custom_to_email' => 'nullable|email',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp,gif,doc,docx|max:10240',
        ]);

        $lead = Leads::with(['user', 'owner'])->findOrFail($request->lead_id);
        $template = EmailTemplate::findOrFail($request->template_id);
        $attachmentFile = $request->file('attachment');

        // 1. Authorization check
        if (Auth::user()->role_id == 3 && $lead->lead_owner != Auth::id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to send email to this lead.',
            ], 403);
        }

        // 2. Validate Template Status
        if (!$template->status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Selected template is inactive.',
            ], 422);
        }

        // 3. Validate Lead Email (or custom provided email)
        $toEmail = $request->filled('custom_to_email') ? trim($request->custom_to_email) : null;

        if (empty($toEmail)) {
            $emailValidation = $this->templateService->validateLeadEmail($lead);
            if (!$emailValidation['valid']) {
                return response()->json([
                    'status' => 'error',
                    'message' => $emailValidation['message'],
                ], 422);
            }
            $toEmail = $emailValidation['email'];
        } else {
            if (!filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'The provided recipient email address is invalid.',
                ], 422);
            }
            // Update lead user's email if changed
            if ($lead->user && $lead->user->email !== $toEmail) {
                $lead->user->email = $toEmail;
                $lead->user->save();
            }
        }

        $subject = $this->templateService->replaceVariables($template->subject, $lead);
        $rawBody = $this->templateService->replaceVariables($template->body, $lead);
        $body = $this->templateService->formatBodyContent($rawBody);

        if (empty(trim($subject)) || empty(trim($body))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email subject or body cannot be empty.',
            ], 422);
        }

        // 4. Create Pending Log Record (does not save binary attachment to DB as requested)
        $log = EmailLog::create([
            'lead_id' => $lead->id,
            'template_id' => $template->id,
            'sent_by' => Auth::id(),
            'to_email' => $toEmail,
            'subject' => $subject,
            'body' => $body,
            'status' => 'pending',
        ]);

        // 5. Send Mail with optional attachment
        try {
            Mail::to($toEmail)->send(new LeadEmail($subject, $body, $attachmentFile));

            $log->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Email sent successfully.',
            ]);

        } catch (\Exception $e) {
            \Log::error('Lead Email Sending Failed: ' . $e->getMessage());

            $log->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Unable to send email. Please try again.',
            ], 500);
        }
    }

    /**
     * Get Email History Logs for a Lead
     */
    public function getHistory(Leads $lead)
    {
        $logs = EmailLog::with(['template:id,name', 'sender:id,name'])
            ->where('lead_id', $lead->id)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($log) {
                return [
                    'id' => $log->id,
                    'template_name' => optional($log->template)->name ?? 'Custom Email',
                    'to_email' => $log->to_email,
                    'sent_by' => optional($log->sender)->name ?? 'System',
                    'subject' => $log->subject,
                    'body' => $log->body,
                    'status' => ucfirst($log->status),
                    'error_message' => $log->error_message,
                    'sent_date' => $log->created_at ? $log->created_at->format('d M Y, h:i A') : 'N/A',
                ];
            });

        return response()->json([
            'status' => 'success',
            'logs' => $logs,
        ]);
    }
}
