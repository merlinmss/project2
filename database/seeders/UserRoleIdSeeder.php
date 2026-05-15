<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_role_ids')->insert([
            [
                'user_id' => 1, // Super Admin User
                'role_id' => 1, // Super Admin
                'created_at' => now(),
            ],
            [
                'user_id' => 1, // Super Admin User
                'role_id' => 2, // Admin Admin
                'created_at' => now(),
            ],
            [
                'user_id' => 2, // Admin User
                'role_id' => 2, // Admin
                'created_at' => now(),
            ],
            [
                'user_id' => 2, // Admin User
                'role_id' => 3, // Staff
                'created_at' => now(),
            ],
            [
                'user_id' => 3, // Staff User
                'role_id' => 3, // Staff
                'created_at' => now(),
            ],
        ]);
    }
}
