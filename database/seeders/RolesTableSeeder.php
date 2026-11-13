<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $roles = [
            [
                'name' => 'Admin',
                'is_deleted' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'User',
                'is_deleted' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'SEO',
                'is_deleted' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(['name' => $role['name']], $role);
        }
    }
}
