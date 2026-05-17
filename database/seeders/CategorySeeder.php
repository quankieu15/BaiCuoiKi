<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Tour du lịch trọn gói',
            'Đặt phòng khách sạn',
            'Vé tham quan & Vui chơi',
            'Thuê xe tự lái & Trung chuyển'
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat)
            ]);
        }
    }
}