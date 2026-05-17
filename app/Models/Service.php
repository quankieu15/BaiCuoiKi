<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * Định nghĩa mối quan hệ: Một Tour/Dịch vụ thuộc về một Khách sạn lưu trú
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}