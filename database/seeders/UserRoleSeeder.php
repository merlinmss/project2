<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->insert([
            ['role_name' => 'Super Admin', 'identifier' => 'super_admin', 'active' => 1],
            ['role_name' => 'Admin', 'identifier' => 'admin', 'active' => 1],
            ['role_name' => 'Staff', 'identifier' => 'staff', 'active' => 1],
        ]);
    }
}
