<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class OrderController extends Controller
{
    /**
     * 1. Xem danh sách đơn đặt hàng từ khách hàng đổ về
     * Đã sửa lỗi dùng whereIn để gom chính xác đơn theo ID dịch vụ của Partner
     */
    public function index()
    {
        // Bước 1: Lấy sạch sành sanh ID các dịch vụ do chính Partner này tạo ra
        $myServiceIds = Service::where('user_id', auth()->id())->pluck('id')->toArray();

        // Bước 2: Hốt tất cả các đơn hàng có service_id nằm trong danh sách trên
        $orders = Order::whereIn('service_id', $myServiceIds)
            ->with(['user', 'service']) // Nạp thông tin khách hàng đặt đơn và thông tin dịch vụ
            ->latest()
            ->get();

        return view('partner.orders.index', compact('orders'));
    }

    /**
     * 2. Xử lý Thay đổi trạng thái đơn hàng (Xác nhận hoặc Hủy)
     */
    public function updateStatus(Request $request, $id)
    {
        // Lấy danh sách ID dịch vụ của Partner để bảo mật đầu vào
        $myServiceIds = Service::where('user_id', auth()->id())->pluck('id')->toArray();

        // Tìm đúng đơn hàng thuộc quyền sở hữu của dịch vụ bên Partner này
        $order = Order::whereIn('service_id', $myServiceIds)->findOrFail($id);

        // Kiểm tra dữ liệu nút bấm gửi lên từ view
        $request->validate([
            'status' => 'required|in:accepted,cancelled,confirmed,pending,approved', 
        ]);

        // Cập nhật trạng thái mới
        $order->status = $request->status;

        if (in_array($request->status, ['accepted', 'confirmed', 'approved'])) {
            try {
                $order->approved_at = now();
            } catch (\Exception $e) {
                // Bỏ qua nếu database chưa chạy migration cột approved_at
            }
        }

        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    /**
     * 3. HÀM THỐNG KÊ DASHBOARD CHO ĐỐI TÁC (FIX DOANH THU)
     */
    public function partnerDashboard()
    {
        $partnerId = auth()->id();

        // 1. Gom danh sách ID dịch vụ của đối tác này để tính toán cho chuẩn, tránh lỗi whereHas
        $myServiceIds = Service::where('user_id', $partnerId)->pluck('id')->toArray();

        // Đếm tổng số dịch vụ (Tour/Xe/Vé) của riêng đối tác này đang bán
        $totalServices = count($myServiceIds);

        // Đếm số lượng đơn hàng đang ở trạng thái 'pending' (Chờ duyệt) của riêng đối tác này
        $pendingOrders = Order::whereIn('service_id', $myServiceIds)
            ->where('status', 'pending')
            ->count();

        // Tính tiền tổng doanh thu cho các đơn đã thành công hoặc xác nhận
        $totalRevenue = Order::whereIn('service_id', $myServiceIds)
            ->whereIn('status', ['accepted', 'confirmed', 'approved'])
            ->sum('total_price');

        // Trả dữ liệu về view partner-dashboard
        return view('partner-dashboard', compact('totalServices', 'pendingOrders', 'totalRevenue'));
    }
}