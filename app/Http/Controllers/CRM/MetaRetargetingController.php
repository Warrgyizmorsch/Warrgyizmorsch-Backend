<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Bucket;
use App\Models\Category;
use App\Models\Leads;
use App\Services\MetaAudienceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MetaRetargetingController extends Controller
{
    protected MetaAudienceService $metaService;

    public function __construct(MetaAudienceService $metaService)
    {
        $this->metaService = $metaService;
    }

    /**
     * Display the Meta Retargeting & Custom Audiences Dashboard
     */
    public function index()
    {
        try {
            $connection = $this->metaService->getConnectionStatus();
            $audienceRes = $this->metaService->getCustomAudiences();
            $audiences = $audienceRes['success'] ? $audienceRes['data'] : [];

            $buckets = Bucket::where('is_deleted', 0)->orderBy('name')->get(['id', 'name']);
            $categories = Category::orderBy('name')->get(['id', 'name']);

            $totalLeadsCount = Leads::count();
            $metaLeadsCount = Leads::where(function ($q) {
                $q->whereNotNull('lead_id')
                  ->orWhere('platform', 'like', '%meta%')
                  ->orWhere('platform', 'like', '%facebook%')
                  ->orWhere('platform', 'like', '%instagram%');
            })->count();

            $statuses = Leads::whereNotNull('lead_status')
                ->distinct()
                ->pluck('lead_status')
                ->filter();

            return view('crm.meta.retargeting', compact(
                'connection',
                'audiences',
                'buckets',
                'categories',
                'totalLeadsCount',
                'metaLeadsCount',
                'statuses'
            ));
        } catch (\Throwable $e) {
            Log::error('MetaRetargetingController index error', ['msg' => $e->getMessage()]);

            $connection = [
                'app_id' => config('meta_integration.app_id'),
                'page_id' => config('meta_integration.page_id'),
                'ad_account_id' => config('meta_integration.ad_account_id'),
                'token_valid' => false,
                'page_name' => null,
                'ad_account_name' => null,
                'error' => $e->getMessage(),
            ];
            $audiences = [];
            $buckets = collect();
            $categories = collect();
            $totalLeadsCount = 0;
            $metaLeadsCount = 0;
            $statuses = collect();

            return view('crm.meta.retargeting', compact(
                'connection',
                'audiences',
                'buckets',
                'categories',
                'totalLeadsCount',
                'metaLeadsCount',
                'statuses'
            ))->with('error', 'Error loading Meta integration: ' . $e->getMessage());
        }
    }

    /**
     * Preview count of matching leads based on filter
     */
    public function previewCount(Request $request)
    {
        try {
            $query = $this->buildLeadsQuery($request);
            $count = $query->count();

            return response()->json([
                'success' => true,
                'count' => $count,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'count' => 0,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Create a new Custom Audience on Meta
     */
    public function createAudience(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);

        $result = $this->metaService->createCustomAudience(
            $request->input('name'),
            $request->input('description', '')
        );

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'message' => $result['error'] ?? 'Failed to create audience on Meta.',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Custom Audience created successfully on Meta!',
            'audience_id' => $result['audience_id'],
        ]);
    }

    /**
     * Sync filtered leads to selected Custom Audience
     */
    public function syncLeads(Request $request)
    {
        $request->validate([
            'audience_id' => 'required|string',
        ]);

        $audienceId = $request->input('audience_id');
        $query = $this->buildLeadsQuery($request);
        $leads = $query->with('user')->get();

        if ($leads->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No matching leads found for the selected criteria.',
            ], 422);
        }

        $result = $this->metaService->syncLeadsToAudience($audienceId, $leads);

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'message' => $result['error'] ?? 'Error while uploading leads to Meta audience.',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => "Successfully synced {$result['synced_count']} leads to Meta Custom Audience for retargeting! (Skipped: {$result['skipped_count']} leads without email/phone)",
            'synced_count' => $result['synced_count'],
            'skipped_count' => $result['skipped_count'],
        ]);
    }

    /**
     * Sync CRM leads to Meta Dataset (Events Manager / CAPI)
     */
    public function syncDataset(Request $request)
    {
        try {
            $eventName = $request->input('event_name', 'Lead');
            $query = $this->buildLeadsQuery($request);
            $leads = $query->with('user')->get();

            if ($leads->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No matching leads found to sync to Meta Dataset.',
                ], 422);
            }

            $result = $this->metaService->syncLeadsToDataset($leads, $eventName);

            if (!$result['success']) {
                return response()->json([
                    'success' => false,
                    'message' => $result['error'] ?? 'Error sending events to Meta Dataset.',
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => "Successfully sent {$result['synced_count']} CRM events to Meta Dataset ({$result['dataset_id']})! Meta Events Manager will now show Active status.",
                'synced_count' => $result['synced_count'],
                'dataset_id' => $result['dataset_id'],
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Subscribe Page to Webhooks
     */
    public function subscribeWebhook()
    {
        $result = $this->metaService->subscribePageToWebhook();

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'message' => $result['error'] ?? 'Failed to subscribe page.',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Facebook Page successfully subscribed to Meta Lead Ads Webhook! Real-time leads are now active.',
        ]);
    }

    /**
     * Helper to build lead query from request filters
     */
    private function buildLeadsQuery(Request $request)
    {
        $query = Leads::query();

        // Bucket filter
        if ($request->filled('bucket_id') && $request->bucket_id !== 'all') {
            $query->where('lead_bucket_id', $request->bucket_id);
        }

        // Status filter
        if ($request->filled('lead_status') && $request->lead_status !== 'all') {
            $query->where('lead_status', $request->lead_status);
        }

        // Category filter
        if ($request->filled('category_id') && $request->category_id !== 'all') {
            $query->where('category_id', $request->category_id);
        }

        // Platform filter
        if ($request->filled('platform') && $request->platform !== 'all') {
            if ($request->platform === 'meta') {
                $query->where(function ($q) {
                    $q->where('platform', 'like', '%meta%')
                      ->orWhere('platform', 'like', '%facebook%')
                      ->orWhere('platform', 'like', '%instagram%');
                });
            } else {
                $query->where('platform', 'like', '%' . $request->platform . '%');
            }
        }

        // Date range
        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', Carbon::parse($request->start_date));
        }

        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', Carbon::parse($request->end_date));
        }

        // Only leads that have users
        $query->whereHas('user', function ($q) {
            $q->whereNotNull('contact_no')->orWhereNotNull('email');
        });

        return $query;
    }
}

