<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('buckets', 'type')) {
            Schema::table('buckets', function (Blueprint $table) {
                $table->string('type')->default('lead')->after('name')->index();
            });
        }

        // 1. Gather bucket IDs referenced in leads table
        $leadBucketIds = DB::table('leads')
            ->whereNotNull('lead_bucket_id')
            ->pluck('lead_bucket_id')
            ->unique()
            ->toArray();

        // 2. Gather bucket IDs referenced in orders table
        $orderBucketIds = DB::table('orders')
            ->whereNotNull('order_bucket_id')
            ->pluck('order_bucket_id')
            ->unique()
            ->toArray();

        // 3. Conflict detection (referenced by BOTH leads and orders)
        $conflictIds = array_values(array_intersect($leadBucketIds, $orderBucketIds));

        $pureLeadIds = array_diff($leadBucketIds, $conflictIds);
        $pureOrderIds = array_diff($orderBucketIds, $conflictIds);

        // 4. Classify pure Lead buckets
        if (!empty($pureLeadIds)) {
            DB::table('buckets')->whereIn('id', $pureLeadIds)->update(['type' => 'lead']);
        }

        // 5. Classify pure Order buckets
        if (!empty($pureOrderIds)) {
            DB::table('buckets')->whereIn('id', $pureOrderIds)->update(['type' => 'order']);
        }

        // 6. Conflicting buckets log
        if (!empty($conflictIds)) {
            Log::warning('Migration 2026_08_21_000000_add_type_to_buckets_table: Conflicting bucket IDs found in both leads and orders table', [
                'conflict_bucket_ids' => $conflictIds
            ]);
        }

        // 7. Child Sub-Status Type Inheritance (Ensure children match parent status type)
        $parentTypes = DB::table('buckets')
            ->whereNull('parent_id')
            ->pluck('type', 'id');

        foreach ($parentTypes as $parentId => $pType) {
            DB::table('buckets')
                ->where('parent_id', $parentId)
                ->update(['type' => $pType]);
        }

        // 8. Auto-register new routes in system permissions (routes & role_permissions tables)
        if (Schema::hasTable('routes')) {
            $routesToRegister = [
                ['name' => 'Lead Statuses Index', 'route_name' => 'lead-status.index', 'method' => 'GET'],
                ['name' => 'Order Statuses Index', 'route_name' => 'order-status.index', 'method' => 'GET'],
            ];

            foreach ($routesToRegister as $rData) {
                $routeId = DB::table('routes')->where('route_name', $rData['route_name'])->value('id');
                if (!$routeId) {
                    $routeId = DB::table('routes')->insertGetId([
                        'name' => $rData['name'],
                        'route_name' => $rData['route_name'],
                        'method' => $rData['method'],
                        'is_deleted' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                if ($routeId && Schema::hasTable('roles') && Schema::hasTable('role_permissions')) {
                    $roles = DB::table('roles')->where('is_deleted', 0)->pluck('id');
                    foreach ($roles as $roleId) {
                        DB::table('role_permissions')->updateOrInsert(
                            ['role_id' => $roleId, 'route_id' => $routeId],
                            ['is_allowed' => 1, 'updated_at' => now(), 'created_at' => now()]
                        );
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('buckets', 'type')) {
            Schema::table('buckets', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
};
