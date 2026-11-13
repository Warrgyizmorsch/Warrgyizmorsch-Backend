<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add lead_bucket_name column if it does not exist
        if (!Schema::hasColumn('leads', 'lead_bucket_name')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->string('lead_bucket_name', 255)->nullable()->after('lead_bucket_id');
                $table->index('lead_bucket_name');
            });
        }

        // 2. Safe, Idempotent Historical Backfill
        // Retrieve ALL buckets (active and soft-deleted) to resolve accurate historical parent/main bucket names
        $allBuckets = DB::table('buckets')->get()->keyBy('id');

        $mainBucketNameMap = [];
        foreach ($allBuckets as $id => $bucket) {
            if (!empty($bucket->parent_id) && isset($allBuckets[$bucket->parent_id])) {
                // If it is a child/sub-status bucket, resolve its MAIN/PARENT bucket name
                $mainBucketNameMap[$id] = $allBuckets[$bucket->parent_id]->name;
            } else {
                // If it is a main bucket, use that bucket's own name
                $mainBucketNameMap[$id] = $bucket->name;
            }
        }

        // Backfill records that do not have lead_bucket_name populated yet
        foreach ($mainBucketNameMap as $bucketId => $mainBucketName) {
            DB::table('leads')
                ->where('lead_bucket_id', $bucketId)
                ->where(function ($q) {
                    $q->whereNull('lead_bucket_name')
                      ->orWhere('lead_bucket_name', '');
                })
                ->update(['lead_bucket_name' => $mainBucketName]);
        }

        // Historical legacy fallback for bucket ID 1 (default Lead bucket in legacy seeds)
        DB::table('leads')
            ->where('lead_bucket_id', 1)
            ->where(function ($q) {
                $q->whereNull('lead_bucket_name')
                  ->orWhere('lead_bucket_name', '');
            })
            ->update(['lead_bucket_name' => 'Lead']);

        // Historical fallback for leads with NULL lead_bucket_id but known status
        DB::table('leads')
            ->whereNull('lead_bucket_id')
            ->where(function ($q) {
                $q->whereNull('lead_bucket_name')
                  ->orWhere('lead_bucket_name', '');
            })
            ->where('lead_status', 'Negotiation')
            ->update(['lead_bucket_name' => 'Lead']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('leads', 'lead_bucket_name')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->dropIndex(['lead_bucket_name']);
                $table->dropColumn('lead_bucket_name');
            });
        }
    }
};
