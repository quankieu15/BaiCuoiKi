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
     * Mối quan hệ liên kết dịch vụ thuộc về một danh mục
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

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
     * Hàm tự động tính điểm số sao trung bình (Chỉ tính review đã duyệt)
     */
    public function averageRating()
    {
        return $this->reviews()->where('is_approved', 1)->avg('rating') ?: 0;
    }

    /**
     * 🌟 HÀM MỚI THÊM: TỰ ĐỘNG CHUYỂN SLUG THÀNH TIẾNG VIỆT ĐẸP
     * Khi ông gọi $service->category_name ngoài giao diện (Blade View), 
     * nó sẽ tự động trả về "Tour trong nước", "Xe tự lái"... thay vì chuỗi thô.
     */
    public function getCategoryNameAttribute()
    {
        // Cách 1: Ưu tiên lấy tên trực tiếp từ bảng categories nếu có quan hệ liên kết
        if ($this->category && !empty($this->category->name)) {
            return $this->category->name;
        }

        // Cách 2: Phương án dự phòng nếu DB của ông đang lưu chuỗi thô ở cột `category`
        $slug = $this->attributes['category'] ?? '';
        
        $vietnameseNames = [
            'car'                 => 'Xe tự lái',
            'ticket'              => 'Vé & Visa',
            'domestic_tour'       => 'Tour trong nước',
            'international_tour'  => 'Tour nước ngoài',
            'hotel'               => 'Khách sạn & Resort',
        ];

        return $vietnameseNames[$slug] ?? 'Dịch vụ khác';
    }
}