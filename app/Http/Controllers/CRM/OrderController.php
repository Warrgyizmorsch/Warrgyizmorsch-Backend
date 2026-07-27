<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Leads;
use App\Models\Bucket;
use App\Models\Category;
use App\Models\User;
use App\Models\LeadSource;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // 1. Auto Sync converted leads into orders table
        $this->syncConvertedLeadsToOrders();

        // 2. Query orders table
        $query = Order::with([
            'user',
            'owner',
            'converter',
            'bucket.children',
            'lead.messages',
            'category',
        ]);

        // Role-based restrictions
        if (auth()->check() && auth()->user()->role_id == 3) {
            $query->where('order_owner', auth()->id());
        }

        // Global Search
        if ($request->filled('search')) {
            $search = $request->search;
            $digitsOnly = preg_replace('/\D+/', '', $search);

            $query->where(function($q) use ($search, $digitsOnly) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search, $digitsOnly) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");

                      if ($digitsOnly !== '') {
                          $uq->orWhereRaw("REPLACE(contact_no, ' ', '') LIKE ?", ['%' . $digitsOnly . '%']);
                      } else {
                          $uq->orWhere('contact_no', 'like', "%{$search}%");
                      }
                  });
            });
        }

        // Date Filter
        if ($request->filled('from') && $request->filled('to')) {
            $from = Carbon::parse($request->from)->startOfDay();
            $to = Carbon::parse($request->to)->endOfDay();
            $query->whereBetween('created_at', [$from, $to]);
        } elseif ($request->filled('from')) {
            $from = Carbon::parse($request->from)->toDateString();
            $query->whereDate('created_at', $from);
        }

        // Filters
        if ($request->filled('status'))
            $query->where('order_status', $request->status);
        if ($request->filled('lead_engagement_status'))
            $query->where('order_engagement_status', strtolower($request->lead_engagement_status));

        if ($request->filled('owner_id')) {
            if ($request->owner_id === 'null') {
                $query->whereNull('order_owner');
            } else {
                $query->where('order_owner', $request->owner_id);
            }
        }

        // Order Buckets filter
        $orderBucketIds = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where('name', 'NOT LIKE', '%lead%')
            ->pluck('id')
            ->toArray();

        if ($request->filled('bucket_id') && $request->bucket_id !== 'all' && $request->bucket_id !== 'all_orders') {
            $query->where('order_bucket_id', $request->bucket_id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $totalOrdersCount = Order::when(auth()->check() && auth()->user()->role_id == 3, fn($q) => $q->where('order_owner', auth()->id()))
            ->count();

        $filteredOrdersCount = (clone $query)->count();

        $perPage = $request->get('per_page', 20);
        $orders = $query->orderBy('updated_at', 'desc')->paginate($perPage);

        // Fetch Order Buckets with count from orders table
        $orderBuckets = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where('name', 'NOT LIKE', '%lead%')
            ->select('buckets.*')
            ->selectSub(function ($q) {
                $q->from('orders')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('orders.order_bucket_id', 'buckets.id')
                    ->when(auth()->check() && auth()->user()->role_id == 3, function ($qq) {
                        $qq->where('orders.order_owner', auth()->id());
                    });
            }, 'leads_count')
            ->orderBy('id', 'asc')
            ->get();

        $owners = User::whereIn('role_id', [1, 3])->where('is_deleted', 0)->get();
        $sources = LeadSource::pluck('source_name')->toArray();
        $categories = Category::where('is_active', 1)->get();
        $allBuckets = Bucket::whereNull('parent_id')->where('is_deleted', 0)->with('children')->get();

        return view('crm.orders.index', compact(
            'orders',
            'orderBuckets',
            'totalOrdersCount',
            'filteredOrdersCount',
            'owners',
            'sources',
            'categories',
            'allBuckets'
        ));
    }

    /**
     * Auto Sync Converted Leads to Orders Table
     */
    private function syncConvertedLeadsToOrders()
    {
        $orderBucketIds = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where('name', 'NOT LIKE', '%lead%')
            ->pluck('id')
            ->toArray();

        $convertedLeads = Leads::where(function($q) use ($orderBucketIds) {
            $q->where('is_converted', 1)
              ->orWhereIn('lead_bucket_id', $orderBucketIds);
        })->get();

        foreach ($convertedLeads as $lead) {
            Order::firstOrCreate(
                ['lead_id' => $lead->id],
                [
                    'order_number'            => 'ORD-' . (10000 + $lead->id),
                    'uid'                     => $lead->uid,
                    'order_bucket_id'         => $lead->lead_bucket_id,
                    'order_status'            => $lead->lead_status,
                    'order_engagement_status' => $lead->lead_engagement_status,
                    'order_owner'             => $lead->lead_owner,
                    'converted_by'            => auth()->check() ? auth()->id() : null,
                    'category_id'             => $lead->category_id,
                    'product'                 => $lead->product,
                    'services'                => $lead->services,
                    'pain_points'             => $lead->pain_points,
                    'client_details'          => $lead->client_details,
                    'documents'               => $lead->documents,
                    'converted_at'            => $lead->updated_at ?? now(),
                ]
            );
        }
    }
}
