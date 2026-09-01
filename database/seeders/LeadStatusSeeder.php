<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeadStatusSeeder extends Seeder
{
    public function run(): void
    {
        $leadStatuses = [
            'New Lead' => 'bg-info text-dark',
            'Yet to Call' => 'bg-primary text-white',
            'Call Done' => 'bg-secondary text-white',
            'Lead Qualification' => 'bg-warning text-dark',
        ];

        $dealStatuses = [
            'Deal Created' => 'bg-primary text-white',
            'Intro Call Done' => 'bg-info text-dark',
            'Pending Proposal' => 'bg-warning text-dark',
            'Proposal Created' => 'bg-primary text-white',
            'Proposal Scheduled' => 'bg-info text-white',
            'Proposal Call Done' => 'bg-secondary text-white',
            'Negotiation' => 'bg-warning text-dark',
            'Won' => 'bg-success text-white',
            'Lost' => 'bg-danger text-white',
        ];

        DB::transaction(function () use ($leadStatuses, $dealStatuses): void {
            $now = now();

            // 1. Lead Statuses (type = 'lead')
            DB::table('buckets')
                ->where(function ($query) {
                    $query->where('type', 'lead')->orWhereNull('type');
                })
                ->update([
                    'is_deleted' => 1,
                    'updated_at' => $now,
                ]);

            foreach ($leadStatuses as $name => $color) {
                $existing = DB::table('buckets')
                    ->where('name', $name)
                    ->where(function ($query) {
                        $query->where('type', 'lead')->orWhereNull('type');
                    })
                    ->first();

                if ($existing) {
                    DB::table('buckets')->where('id', $existing->id)->update([
                        'type' => 'lead',
                        'parent_id' => null,
                        'bucket_color' => $color,
                        'is_deleted' => 0,
                        'updated_at' => $now,
                    ]);
                } else {
                    DB::table('buckets')->insert([
                        'name' => $name,
                        'type' => 'lead',
                        'parent_id' => null,
                        'bucket_color' => $color,
                        'is_deleted' => 0,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }

            // 2. Deal Statuses (type = 'order')
            DB::table('buckets')
                ->where('type', 'order')
                ->update([
                    'is_deleted' => 1,
                    'updated_at' => $now,
                ]);

            foreach ($dealStatuses as $name => $color) {
                $existing = DB::table('buckets')
                    ->where('name', $name)
                    ->where('type', 'order')
                    ->first();

                if ($existing) {
                    DB::table('buckets')->where('id', $existing->id)->update([
                        'type' => 'order',
                        'parent_id' => null,
                        'bucket_color' => $color,
                        'is_deleted' => 0,
                        'updated_at' => $now,
                    ]);
                } else {
                    DB::table('buckets')->insert([
                        'name' => $name,
                        'type' => 'order',
                        'parent_id' => null,
                        'bucket_color' => $color,
                        'is_deleted' => 0,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        });
    }
}
