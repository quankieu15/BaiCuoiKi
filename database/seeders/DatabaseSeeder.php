<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. CHẠY CÁC SEEDER ĐỘC LẬP TRƯỚC (User & Category)
        // ==========================================
        $this->call([
            UserSeeder::class,      // Tạo tài khoản admin, partner, customer
            CategorySeeder::class,  // Tạo 5 danh mục gốc (Xe, Vé, Tour Trong Nước, Tour Quốc Tế, Khách Sạn)
        ]);

        // ==========================================
        // 2. CHẠY CÁC SEEDER DỊCH VỤ CON ĐỂ ĐỔ DATA RA GIAO DIỆN
        // ==========================================
        $this->call([
            CarServiceSeeder::class,         // Bơm data cho tab "XE TỰ LÁI" (category: car)
            TicketServiceSeeder::class,      // Bơm data cho tab "VÉ & VISA" (category: ticket)
            DomesticTourSeeder::class,      // Bơm data cho tab "TOUR TRONG NƯỚC" (category: domestic_tour)
            InternationalTourSeeder::class, // Bơm data cho tab "TOUR NƯỚC NGOÀI" (category: international_tour)
            HotelSeeder::class,             // Bơm 1-2 cái mẫu cho tab "KHÁCH SẠN" (category: hotel)
        ]);

        // ==========================================
        // 3. TỰ ĐỘNG TẠO ĐƠN HÀNG MẪU ĐỂ TEST TÍNH NĂNG
        // ==========================================
        $customerId = DB::table('users')->where('role', 'customer')->value('id') ?? 1;
        $sampleService = DB::table('services')->first();

        if ($sampleService) {
            DB::table('orders')->updateOrInsert(
                [
                    'user_id' => $customerId,
                    'service_id' => $sampleService->id,
                    'booking_date' => now()->addDays(3)->format('Y-m-d')
                ],
                [
                    'quantity' => 1,
                    'total_price' => $sampleService->price,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}