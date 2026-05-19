<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // 🌟 ĐÃ CẬP NHẬT: Thêm đầy đủ các trường để không bị lỗi bảo mật Mass Assignment của Laravel
    protected $fillable = [
        'user_id',
        'service_id',
        'quantity',
        'booking_date',    // Cần cho hàm book()
        'total_price',
        'status',
        'payment_method',  // Cần để check hình thức thanh toán (COD / Chuyển khoản)
        'payment_proof',   // Cần để lưu đường dẫn ảnh hóa đơn quét QR
        'note',            // Ghi chú của khách hàng khi đặt đơn
    ];

    // Mối quan hệ tới người đặt (Khách hàng)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mối quan hệ tới Dịch vụ (Tour / Khách sạn)
    public function service()
    {
       return $this->belongsTo(Service::class, 'service_id');
    }
}