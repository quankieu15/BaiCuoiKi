<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'service_id', 'rating', 'comment', 'is_approved'];

    // Liên kết ngược lại với Khách hàng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Liên kết với Dịch vụ được đánh giá
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}