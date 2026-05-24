<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // 1. Trang chủ quản trị (Tổng quan hệ thống + Biểu đồ)
    public function index()
    {
        // Thống kê số lượng để hiển thị lên các thẻ số liệu (Thống kê tổng quan)
        $totalCustomers = User::where('role', 'customer')->count();
        $totalPartners = User::where('role', 'partner')->count();
        $totalServices = Service::where('status', 'active')->count();
        $totalOrders = Order::count();
        
        // Tính tổng doanh thu hệ thống từ các đơn hàng đã được duyệt (approved)
        $totalRevenue = Order::whereIn('status', [
    'approved',
    'confirmed',
    'accepted'
])->sum('total_price');

        // Thống kê doanh thu theo từng tháng trong năm hiện tại (Dùng cho biểu đồ Line Chart)
        $revenueMonthly = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as total')
        )
->whereIn('status', [
    'approved',
    'confirmed',
    'accepted'
])
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total', 'month')
        ->toArray();

        // Tạo mảng chuẩn 12 tháng, tháng nào không có tiền thì tự gán bằng 0 tránh lỗi biểu đồ
        $chartRevenueData = [];
        for ($m = 1; $m <= 12; $m++) {
            $chartRevenueData[] = $revenueMonthly[$m] ?? 0;
        }

        // Thống kê số lượng trạng thái đơn hàng (Dùng cho biểu đồ tròn Pie Chart)
        $statusCounts = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

       $chartStatusData = [
    'pending' => $statusCounts['pending'] ?? 0,

    'approved' =>
        ($statusCounts['approved'] ?? 0)
        + ($statusCounts['confirmed'] ?? 0)
        + ($statusCounts['accepted'] ?? 0),

    'cancelled' => $statusCounts['cancelled'] ?? 0,
];

        // Trả về file view admin.dashboard chuẩn cấu trúc
        return view('admin.dashboard', compact(
            'totalCustomers', 
            'totalPartners', 
            'totalServices', 
            'totalOrders', 
            'totalRevenue',
            'chartRevenueData',
            'chartStatusData'
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

    $order->status = 'approved';

    $order->save();

    return redirect()->back()
        ->with('success', 'Đã phê duyệt đơn đặt lịch thành công!');
}

    // 4. Xử lý hủy đơn hàng
    public function orderCancel($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelled'; 
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