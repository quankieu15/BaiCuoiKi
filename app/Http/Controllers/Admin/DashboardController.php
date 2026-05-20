<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // 1. Trang chủ quản trị (Tổng quan hệ thống)
    public function index()
    {
        // Thống kê số lượng để hiển thị lên các thẻ số liệu (Thống kê tổng quan)
        $totalCustomers = User::where('role', 'customer')->count();
        $totalPartners = User::where('role', 'partner')->count();
       $totalServices = Service::where('status', 'active')->count();
        $totalOrders = Order::count();

        // Lấy 5 đơn hàng mới nhất toàn hệ thống để hiển thị bảng theo dõi nhanh
        $recentOrders = Order::with(['user', 'service'])->latest()->take(5)->get();

        // Trả về view admin-dashboard kèm dữ liệu
        return view('admin-dashboard', compact(
            'totalCustomers', 
            'totalPartners', 
            'totalServices', 
            'totalOrders', 
            'recentOrders'
        ));
    }

    // 2. Trang danh sách quản lý đơn hàng chi tiết
    public function orderIndex()
    {
        // Lấy tất cả đơn hàng, kèm thông tin user và service liên kết để tránh lỗi N+1 query
        $orders = Order::with(['user', 'service'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // 3. Xử lý phê duyệt đơn hàng
    public function orderApprove($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'approved'; // Đảm bảo trường này khớp với cột trạng thái trong DB (ví dụ: approved/success)
        $order->save();

        return redirect()->back()->with('success', 'Đã phê duyệt đơn đặt lịch thành công!');
    }

    // 4. Xử lý hủy đơn hàng
    public function orderCancel($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelled'; // Đảm bảo trường này khớp với cột trạng thái trong DB (ví dụ: cancelled/failed)
        $order->save();

        return redirect()->back()->with('success', 'Đã hủy bỏ đơn đặt lịch thành công!');
    }

    // 5. Xử lý xóa vĩnh viễn đơn hàng khỏi hệ thống
    public function orderDestroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Đã xóa vĩnh viễn đơn đặt lịch khỏi hệ thống!');
    }
}