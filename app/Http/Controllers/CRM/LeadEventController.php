<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\LeadEvent;
use App\Models\LeadHistory;
use App\Models\Leads;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LeadEventController extends Controller
{
    /**
     * Check if the authenticated user has permission to access the lead.
     * Telecaller (role_id == 3) can only access leads they own.
     */
    protected function checkLeadAccess(Leads $lead): bool
    {
        $user = Auth::user();
        if (!$user) return false;

        // Role 3 is Telecaller
        if ($user->role_id == 3) {
            return (int)$lead->lead_owner === (int)$user->id;
        }

        return true;
    }

    /**
     * Display listing of upcoming events with KPI counters and filters.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();
        $tomorrow = Carbon::tomorrow()->toDateString();
        $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
        $endOfWeek = Carbon::now()->endOfWeek()->toDateString();

        // Base query with relationships
        $query = LeadEvent::with(['lead.user', 'assignedUser', 'creator']);

        // Permission filtering: Telecaller (role_id == 3) only sees own leads/assignments
        if ($user->role_id == 3) {
            $query->where(function ($q) use ($user) {
                $q->whereHas('lead', function ($leadQ) use ($user) {
                    $leadQ->where('lead_owner', $user->id);
                })->orWhere('assigned_to', $user->id);
            });
        }

        // Base KPI counts query respecting user permissions
        $kpiBase = LeadEvent::query();
        if ($user->role_id == 3) {
            $kpiBase->where(function ($q) use ($user) {
                $q->whereHas('lead', function ($leadQ) use ($user) {
                    $leadQ->where('lead_owner', $user->id);
                })->orWhere('assigned_to', $user->id);
            });
        }

        // Calculate KPI Metrics
        $kpis = [
            'today' => (clone $kpiBase)->where('status', LeadEvent::STATUS_SCHEDULED)->whereDate('event_date', $today)->count(),
            'tomorrow' => (clone $kpiBase)->where('status', LeadEvent::STATUS_SCHEDULED)->whereDate('event_date', $tomorrow)->count(),
            'this_week' => (clone $kpiBase)->where('status', LeadEvent::STATUS_SCHEDULED)->whereBetween('event_date', [$startOfWeek, $endOfWeek])->count(),
            'overdue' => (clone $kpiBase)->where('status', LeadEvent::STATUS_SCHEDULED)->where('event_date', '<', $today)->count(),
            'completed' => (clone $kpiBase)->where('status', LeadEvent::STATUS_COMPLETED)->count(),
            'all_upcoming' => (clone $kpiBase)->where('status', LeadEvent::STATUS_SCHEDULED)->where('event_date', '>=', $today)->count(),
            'total' => (clone $kpiBase)->count(),
        ];

        // Apply Quick Filter
        $quickFilter = $request->input('quick_filter', 'all_upcoming');
        switch ($quickFilter) {
            case 'today':
                $query->where('status', LeadEvent::STATUS_SCHEDULED)->whereDate('event_date', $today);
                break;
            case 'tomorrow':
                $query->where('status', LeadEvent::STATUS_SCHEDULED)->whereDate('event_date', $tomorrow);
                break;
            case 'this_week':
                $query->where('status', LeadEvent::STATUS_SCHEDULED)->whereBetween('event_date', [$startOfWeek, $endOfWeek]);
                break;
            case 'overdue':
                $query->where('status', LeadEvent::STATUS_SCHEDULED)->where('event_date', '<', $today);
                break;
            case 'completed':
                $query->where('status', LeadEvent::STATUS_COMPLETED);
                break;
            case 'cancelled':
                $query->where('status', LeadEvent::STATUS_CANCELLED);
                break;
            case 'rescheduled':
                $query->where('status', LeadEvent::STATUS_RESCHEDULED);
                break;
            case 'all_upcoming':
                $query->where('status', LeadEvent::STATUS_SCHEDULED)->where('event_date', '>=', $today);
                break;
            case 'all':
            default:
                // No quick filter applied
                break;
        }

        // Specific Event Type Filter
        if ($request->filled('event_type')) {
            $query->where('event_type', $request->input('event_type'));
        }

        // Specific Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Assigned To Filter
        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->input('assigned_to'));
        }

        // Date Range Filters
        if ($request->filled('date_from')) {
            $query->whereDate('event_date', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('event_date', '<=', $request->input('date_to'));
        }

        // Text Search Filter (Lead Name, Mobile, Email, Business Name, Event Title)
        if ($request->filled('search')) {
            $searchTerm = trim($request->input('search'));
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhereHas('lead', function ($lq) use ($searchTerm) {
                      $lq->where('business_name', 'like', "%{$searchTerm}%")
                         ->orWhereHas('user', function ($uq) use ($searchTerm) {
                             $uq->where('name', 'like', "%{$searchTerm}%")
                                ->orWhere('contact_no', 'like', "%{$searchTerm}%")
                                ->orWhere('email', 'like', "%{$searchTerm}%");
                         });
                  });
            });
        }

        // Sorting: upcoming closest first, then by start time
        $events = $query->orderBy('event_date', 'asc')
                        ->orderBy('start_time', 'asc')
                        ->paginate(20)
                        ->withQueryString();

        // Users list for assignment dropdown
        $users = User::select('id', 'name')->orderBy('name')->get();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'kpis' => $kpis,
                'events' => $events,
            ]);
        }

        return view('crm.events.index', compact('events', 'kpis', 'users', 'quickFilter'));
    }

    /**
     * Store a newly created event for a lead.
     */
    public function store(Request $request, $leadId)
    {
        $lead = Leads::findOrFail($leadId);

        if (!$this->checkLeadAccess($lead)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. You do not have permission to schedule events for this lead.'
            ], 403);
        }

        $validated = $request->validate([
            'event_type' => [
                'required',
                'string',
                Rule::in([
                    LeadEvent::TYPE_MEETING_SCHEDULE,
                    LeadEvent::TYPE_DISCOVERY_CALL,
                    LeadEvent::TYPE_PROJECTION_CALL,
                    LeadEvent::TYPE_CONVERSION,
                ]),
            ],
            'event_date' => 'required|date',
            'start_time' => 'required|string',
            'end_time' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2000',
        ]);

        $event = LeadEvent::create([
            'lead_id' => $lead->id,
            'event_type' => $validated['event_type'],
            'event_date' => $validated['event_date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'] ?? null,
            'assigned_to' => $validated['assigned_to'] ?? $lead->lead_owner ?? Auth::id(),
            'title' => $validated['title'] ?? null,
            'description' => $validated['description'] ?? null,
            'status' => LeadEvent::STATUS_SCHEDULED,
            'created_by' => Auth::id(),
        ]);

        // Audit Trail via LeadHistory (DOES NOT touch lead status/bucket)
        try {
            LeadHistory::create([
                'lead_id' => $lead->id,
                'user_id' => Auth::id(),
                'action' => 'Event Scheduled: ' . $event->type_label,
                'changes' => json_encode([
                    'event_id' => $event->id,
                    'event_type' => $event->event_type,
                    'event_date' => $event->event_date->format('Y-m-d'),
                    'start_time' => $event->start_time,
                    'title' => $event->title,
                ]),
            ]);
        } catch (\Throwable $e) {
            // Ignore audit log error silently
        }

        $event->load(['assignedUser', 'creator']);

        return response()->json([
            'status' => 'success',
            'message' => 'Event scheduled successfully.',
            'event' => $event,
        ]);
    }

    /**
     * Update an existing event.
     */
    public function update(Request $request, $id)
    {
        $event = LeadEvent::with('lead')->findOrFail($id);

        if (!$this->checkLeadAccess($event->lead)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. You do not have permission to modify this event.'
            ], 403);
        }

        $validated = $request->validate([
            'event_type' => [
                'sometimes',
                'required',
                'string',
                Rule::in([
                    LeadEvent::TYPE_MEETING_SCHEDULE,
                    LeadEvent::TYPE_DISCOVERY_CALL,
                    LeadEvent::TYPE_PROJECTION_CALL,
                    LeadEvent::TYPE_CONVERSION,
                ]),
            ],
            'event_date' => 'sometimes|required|date',
            'start_time' => 'sometimes|required|string',
            'end_time' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2000',
            'status' => [
                'sometimes',
                'required',
                'string',
                Rule::in([
                    LeadEvent::STATUS_SCHEDULED,
                    LeadEvent::STATUS_COMPLETED,
                    LeadEvent::STATUS_CANCELLED,
                    LeadEvent::STATUS_RESCHEDULED,
                ]),
            ],
        ]);

        if (isset($validated['status']) && $validated['status'] === LeadEvent::STATUS_COMPLETED && $event->status !== LeadEvent::STATUS_COMPLETED) {
            $event->completed_at = Carbon::now();
        } elseif (isset($validated['status']) && $validated['status'] !== LeadEvent::STATUS_COMPLETED) {
            $event->completed_at = null;
        }

        $event->update($validated);

        try {
            LeadHistory::create([
                'lead_id' => $event->lead_id,
                'user_id' => Auth::id(),
                'action' => 'Event Updated: ' . $event->type_label,
                'changes' => json_encode($validated),
            ]);
        } catch (\Throwable $e) {
            // Ignore audit log error silently
        }

        $event->load(['assignedUser', 'creator']);

        return response()->json([
            'status' => 'success',
            'message' => 'Event updated successfully.',
            'event' => $event,
        ]);
    }

    /**
     * Mark an event as completed.
     */
    public function complete(Request $request, $id)
    {
        $event = LeadEvent::with('lead')->findOrFail($id);

        if (!$this->checkLeadAccess($event->lead)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized to update this event.'
            ], 403);
        }

        $event->status = LeadEvent::STATUS_COMPLETED;
        $event->completed_at = Carbon::now();
        $event->save();

        try {
            LeadHistory::create([
                'lead_id' => $event->lead_id,
                'user_id' => Auth::id(),
                'action' => 'Event Completed: ' . $event->type_label,
                'changes' => json_encode(['completed_at' => $event->completed_at->toIso8601String()]),
            ]);
        } catch (\Throwable $e) {
            // Ignore audit log error silently
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Event marked as completed.',
            'event' => $event,
        ]);
    }

    /**
     * Cancel an event.
     */
    public function cancel(Request $request, $id)
    {
        $event = LeadEvent::with('lead')->findOrFail($id);

        if (!$this->checkLeadAccess($event->lead)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized to update this event.'
            ], 403);
        }

        $event->status = LeadEvent::STATUS_CANCELLED;
        $event->save();

        try {
            LeadHistory::create([
                'lead_id' => $event->lead_id,
                'user_id' => Auth::id(),
                'action' => 'Event Cancelled: ' . $event->type_label,
                'changes' => json_encode(['cancelled_at' => Carbon::now()->toIso8601String()]),
            ]);
        } catch (\Throwable $e) {
            // Ignore audit log error silently
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Event cancelled.',
            'event' => $event,
        ]);
    }

    /**
     * Reschedule an event with a new date and time.
     */
    public function reschedule(Request $request, $id)
    {
        $event = LeadEvent::with('lead')->findOrFail($id);

        if (!$this->checkLeadAccess($event->lead)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized to update this event.'
            ], 403);
        }

        $validated = $request->validate([
            'event_date' => 'required|date',
            'start_time' => 'required|string',
            'end_time' => 'nullable|string',
            'status' => [
                'nullable',
                'string',
                Rule::in([LeadEvent::STATUS_SCHEDULED, LeadEvent::STATUS_RESCHEDULED]),
            ],
        ]);

        $oldDate = $event->event_date ? $event->event_date->format('Y-m-d') : '';
        $oldTime = $event->start_time;

        $event->event_date = $validated['event_date'];
        $event->start_time = $validated['start_time'];
        if (isset($validated['end_time'])) {
            $event->end_time = $validated['end_time'];
        }
        $event->status = $validated['status'] ?? LeadEvent::STATUS_SCHEDULED;
        $event->save();

        try {
            LeadHistory::create([
                'lead_id' => $event->lead_id,
                'user_id' => Auth::id(),
                'action' => 'Event Rescheduled: ' . $event->type_label,
                'changes' => json_encode([
                    'from' => "{$oldDate} {$oldTime}",
                    'to' => "{$event->event_date->format('Y-m-d')} {$event->start_time}",
                ]),
            ]);
        } catch (\Throwable $e) {
            // Ignore audit log error silently
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Event rescheduled successfully.',
            'event' => $event,
        ]);
    }

    /**
     * Get all events for a specific lead (for modals / AJAX).
     */
    public function getLeadEvents($leadId)
    {
        $lead = Leads::findOrFail($leadId);

        if (!$this->checkLeadAccess($lead)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized.'
            ], 403);
        }

        $events = LeadEvent::with(['assignedUser:id,name', 'creator:id,name'])
            ->where('lead_id', $lead->id)
            ->orderBy('event_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get()
            ->map(function ($ev) {
                return [
                    'id' => $ev->id,
                    'lead_id' => $ev->lead_id,
                    'event_type' => $ev->event_type,
                    'event_type_label' => $ev->type_label,
                    'title' => $ev->title,
                    'description' => $ev->description,
                    'event_date' => $ev->event_date ? $ev->event_date->format('Y-m-d') : null,
                    'event_date_formatted' => $ev->event_date ? $ev->event_date->format('d M Y') : '',
                    'start_time' => $ev->start_time,
                    'start_time_formatted' => $ev->start_time ? Carbon::parse($ev->start_time)->format('h:i A') : '',
                    'end_time' => $ev->end_time,
                    'end_time_formatted' => $ev->end_time ? Carbon::parse($ev->end_time)->format('h:i A') : '',
                    'status' => $ev->status,
                    'status_label' => $ev->status_label,
                    'assigned_to' => $ev->assigned_to,
                    'assigned_user_name' => optional($ev->assignedUser)->name ?? 'Unassigned',
                    'creator_name' => optional($ev->creator)->name ?? 'System',
                    'completed_at' => $ev->completed_at ? $ev->completed_at->format('d M Y, h:i A') : null,
                    'is_overdue' => ($ev->status === LeadEvent::STATUS_SCHEDULED && $ev->event_date && $ev->event_date->isPast() && !$ev->event_date->isToday()),
                    'is_today' => ($ev->event_date && $ev->event_date->isToday()),
                ];
            });

        return response()->json([
            'status' => 'success',
            'events' => $events,
        ]);
    }

    /**
     * Delete an event.
     */
    public function destroy($id)
    {
        $event = LeadEvent::with('lead')->findOrFail($id);

        if (!$this->checkLeadAccess($event->lead)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized to delete this event.'
            ], 403);
        }

        $leadId = $event->lead_id;
        $eventLabel = $event->type_label;

        $event->delete();

        try {
            LeadHistory::create([
                'lead_id' => $leadId,
                'user_id' => Auth::id(),
                'action' => 'Event Deleted: ' . $eventLabel,
                'changes' => json_encode(['event_id' => $id]),
            ]);
        } catch (\Throwable $e) {
            // Ignore audit log error silently
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Event deleted successfully.',
        ]);
    }
}
