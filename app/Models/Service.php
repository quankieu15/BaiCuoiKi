<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    protected $fillable = [
        'category_id', 
        'user_id', 
        'hotel_id', 
        'title', 
        'description', 
        'price', 
        'location', 
        'image'
    ];

    /**
     * Định nghĩa mối quan hệ: Một Tour/Dịch vụ thuộc về một Khách sạn lưu trú (Cột hotel_id đơn lẻ)
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    /**
     * Định nghĩa mối quan hệ: Một dịch vụ thuộc về một Đối tác (Người tạo)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Định nghĩa mối quan hệ: Một dịch vụ có thể có nhiều đơn đặt lịch (Orders)
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'service_id');
    }

    /**
     * Mối quan hệ nhiều - nhiều với bảng Hotels qua bảng trung gian hotel_service
     */
    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class, 'hotel_service', 'service_id', 'hotel_id');
    }

    /**
     * Một dịch vụ có thể có nhiều đánh giá/bình luận
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(\App\Models\Review::class, 'service_id');
    }

    /**
     * 🌟 HÀM TỰ ĐỘNG TÍNH ĐIỂM SỐ SAO TRUNG BÌNH (ĐÃ CẬP NHẬT CHỈ TÍNH REVIEW ĐÃ DUYỆT)
     */
    public function averageRating()
    {
        // Chỉ tính trung bình cộng của những đánh giá có is_approved = 1
        return $this->reviews()->where('is_approved', 1)->avg('rating') ?: 0;
    }
}