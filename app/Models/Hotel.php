<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Hotel extends Model
{
    use HasFactory;

    // Cho phép lưu tất cả các trường dữ liệu (Giải quyết triệt để lỗi MassAssignment)
    protected $guarded = []; 

    /**
     * 🔥 THÊM HÀM NÀY: Một khách sạn có thể liên kết với nhiều Tour/Dịch vụ du lịch
     * Kết nối ngược lại với Model Service qua bảng trung gian hotel_service
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'hotel_service', 'hotel_id', 'service_id');
    }
}