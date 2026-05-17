<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tạo tài khoản Admin tổng quản trị
        User::create([
            'name' => 'Quản trị viên Hệ thống',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '0911223344'
        ]);

        // 2. Tạo tài khoản Đối tác dịch vụ mẫu
        User::create([
            'name' => 'Công ty Lữ hành Saigontourist',
            'email' => 'partner@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'partner',
            'phone' => '0988776655'
        ]);

        // 3. Tạo tài khoản Khách hàng mẫu
        User::create([
            'name' => 'Nguyễn Văn Khách',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '0905123456'
        ]);
    }
}