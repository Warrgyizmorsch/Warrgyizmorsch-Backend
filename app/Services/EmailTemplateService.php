<?php

namespace App\Services;

use App\Models\Leads;

class EmailTemplateService
{
    /**
     * Get array of supported dynamic variables and descriptions
     */
    public function getAvailableVariables(): array
    {
        return [
            '{{lead_name}}' => 'Lead Contact Name',
            '{{lead_email}}' => 'Lead Email Address',
            '{{lead_phone}}' => 'Lead Phone / Contact Number',
            '{{lead_status}}' => 'Lead Current Status',
            '{{lead_source}}' => 'Lead Source / Platform',
            '{{lead_owner}}' => 'Assigned Lead Executive Name',
            '{{owner_email}}' => 'Assigned Lead Executive Email',
            '{{company_name}}' => 'Company / Business Name',
        ];
    }

    /**
     * Replace dynamic variables in template string using lead data
     */
    public function replaceVariables(?string $content, Leads $lead): string
    {
        if (empty($content)) {
            return '';
        }

        $leadUser = $lead->user;
        $leadOwner = $lead->owner;

        $replacements = [
            '{{lead_name}}' => $leadUser->name ?? 'Valued Client',
            '{{lead_email}}' => $leadUser->email ?? '',
            '{{lead_phone}}' => $leadUser->contact_no ?? '',
            '{{lead_status}}' => $lead->lead_status ?? 'New',
            '{{lead_source}}' => $lead->platform ?? $lead->campaign_name ?? 'Website',
            '{{lead_owner}}' => $leadOwner->name ?? 'Support Team',
            '{{owner_email}}' => $leadOwner->email ?? '',
            '{{company_name}}' => !empty($lead->business_name) ? $lead->business_name : config('app.name', 'Warrgyizmorsch'),
        ];

        return strtr($content, $replacements);
    }

    /**
     * Format email body: preserves HTML or formats plain text linebreaks cleanly into paragraphs
     */
    public function formatBodyContent(string $body): string
    {
        if (empty(trim($body))) {
            return '';
        }

        // Check if body contains HTML block tags
        if (preg_match('/<(p|div|table|ul|ol|h[1-6]|br)[\s\/>]/i', $body)) {
            return $body;
        }

        // Format plain text into clean HTML paragraphs
        $paragraphs = explode("\n\n", trim($body));
        $formatted = '';

        foreach ($paragraphs as $p) {
            $pTrim = trim($p);
            if ($pTrim !== '') {
                $formatted .= '<p style="margin: 0 0 16px 0; line-height: 1.7; color: #334155; font-size: 15px;">' . nl2br(e($pTrim)) . '</p>';
            }
        }

        return $formatted ?: nl2br(e($body));
    }

    /**
     * Validate if lead has valid email address
     */
    public function validateLeadEmail(Leads $lead): array
    {
        $email = optional($lead->user)->email;

        if (empty($email)) {
            return [
                'valid' => false,
                'message' => 'This lead does not have an email address associated with their account.',
            ];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [
                'valid' => false,
                'message' => 'The lead email address (' . e($email) . ') is invalid.',
            ];
        }

        return [
            'valid' => true,
            'email' => $email,
        ];
    }
}
