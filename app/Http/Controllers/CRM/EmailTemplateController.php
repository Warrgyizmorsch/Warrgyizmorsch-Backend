<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Services\EmailTemplateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailTemplateController extends Controller
{
    protected EmailTemplateService $templateService;

    public function __construct(EmailTemplateService $templateService)
    {
        $this->templateService = $templateService;
    }

    /**
     * Display Email Template Master Listing
     */
    public function index(Request $request)
    {
        $query = EmailTemplate::with(['creator', 'updater']);

        // Search Filter
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }

        // Type Filter
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Status Filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', (int) $request->status);
        }

        $templates = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        $types = EmailTemplate::select('type')->distinct()->whereNotNull('type')->pluck('type');

        $availableVariables = $this->templateService->getAvailableVariables();

        return view('crm.email_templates.index', compact('templates', 'types', 'availableVariables'));
    }

    /**
     * Store new Email Template
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'status' => 'required|boolean',
        ]);

        EmailTemplate::create([
            'name' => $request->name,
            'type' => $request->type,
            'subject' => $request->subject,
            'body' => $request->body,
            'status' => $request->boolean('status'),
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('email-templates.index')->with('success', 'Email Template created successfully!');
    }

    /**
     * Get details for edit modal
     */
    public function edit(EmailTemplate $emailTemplate)
    {
        return response()->json([
            'status' => 'success',
            'template' => $emailTemplate,
        ]);
    }

    /**
     * Update Email Template
     */
    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $emailTemplate->update([
            'name' => $request->name,
            'type' => $request->type,
            'subject' => $request->subject,
            'body' => $request->body,
            'status' => $request->boolean('status'),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('email-templates.index')->with('success', 'Email Template updated successfully!');
    }

    /**
     * Delete Email Template
     */
    public function destroy(EmailTemplate $emailTemplate)
    {
        $emailTemplate->delete();

        return redirect()->route('email-templates.index')->with('success', 'Email Template deleted successfully!');
    }

    /**
     * Toggle Active/Inactive Status
     */
    public function toggleStatus(EmailTemplate $emailTemplate)
    {
        $emailTemplate->status = !$emailTemplate->status;
        $emailTemplate->updated_by = Auth::id();
        $emailTemplate->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Template status updated successfully!',
            'new_status' => $emailTemplate->status,
        ]);
    }
}
