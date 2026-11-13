<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $seoRoleId = DB::table('roles')->where('name', 'SEO')->value('id');
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('user@123'),
                'role_id' => 1, // Admin
                'is_deleted' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Normal User',
                'email' => 'user@example.com',
                'password' => Hash::make('user@123'),
                'role_id' => 2, // User
                'is_deleted' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Aman Warr',
                'email' => 'aman.warr@gmai.com',
                'password' => Hash::make('12345678'),
                'role_id' => $seoRoleId,
                'is_deleted' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($users as $user) {
            if ($user['email'] === 'aman.warr@gmai.com') {
                DB::table('users')->updateOrInsert(['email' => $user['email']], $user);
                continue;
            }

            // Never overwrite credentials of existing live users.
            DB::table('users')->insertOrIgnore($user);
        }
    }
}
