<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@email.com',
                'password' => bcrypt('password123'),
                // 'role' => 'Super Admin',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('password123'),
                // 'role' => 'Admin',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@email.com',
                'password' => bcrypt('password123'),
                // 'role' => 'Manager',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Reporter',
                'email' => 'reporter@email.com',
                'password' => bcrypt('password123'),
                // 'role' => 'Reporter',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('users')->insert([
            // User
            [
                'name' => 'User 1',
                'email' => 'user1@email.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'last_active' => Carbon::now(),
            ]
        ]);
    }
}
