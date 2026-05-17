<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'quantity',
        'total_price',
        'status',
    ];

    // Mối quan hệ tới người đặt (Khách hàng)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mối quan hệ tới Dịch vụ (Tour / Khách sạn) - Viết thường, số ít để ăn khớp với Controller
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}