<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    // Cho phép lưu tất cả các trường dữ liệu (Giải quyết triệt để lỗi MassAssignment)
    protected $guarded = []; 
}