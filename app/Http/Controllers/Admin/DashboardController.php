<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        // Thống kê số lượng để hiển thị lên các thẻ số liệu (Thống kê tổng quan)
        $totalCustomers = User::where('role', 'customer')->count();
        $totalPartners = User::where('role', 'partner')->count();
        $totalServices = Service::count();
        $totalOrders = Order::count();

        // Lấy 5 đơn hàng mới nhất toàn hệ thống để hiển thị bảng theo dõi
        $recentOrders = Order::with(['user', 'service'])->latest()->take(5)->get();

        return view('admin-dashboard', compact(
            'totalCustomers', 
            'totalPartners', 
            'totalServices', 
            'totalOrders', 
            'recentOrders'
        ));
    }
}