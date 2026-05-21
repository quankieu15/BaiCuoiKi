<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ADMIN
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Quản trị viên Hệ thống',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '0911223344',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // 2. PARTNER
        DB::table('users')->updateOrInsert(
            ['email' => 'partner@gmail.com'],
            [
                'name' => 'HKT TRAVEL',
                'password' => Hash::make('password'),
                'role' => 'partner',
                'phone' => '0988776655',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // 3. CUSTOMER
        DB::table('users')->updateOrInsert(
            ['email' => 'customer@gmail.com'],
            [
                'name' => 'Nguyễn Văn Khách',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'phone' => '0905123456',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}