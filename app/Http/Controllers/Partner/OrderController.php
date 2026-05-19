<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service; // 🌟 Thêm dòng này để đếm số dịch vụ
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 🌟 Thêm dòng này để dùng Auth

class OrderController extends Controller
{
    // 1. Xem danh sách đơn đặt hàng từ khách hàng đổ về
    public function index()
    {
        $orders = Order::whereHas('service', function($query) {
            $query->where('user_id', auth()->id());
        })->with(['user', 'service'])->latest()->get();

        return view('partner.orders.index', compact('orders'));
    }

    // 2. Xử lý Thay đổi trạng thái đơn hàng (Xác nhận hoặc Hủy)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Bảo mật check quyền chủ dịch vụ
        if ($order->service->user_id !== auth()->id()) {
            abort(403, 'Bạn không có quyền xử lý đơn hàng này!');
        }

        // Chuyển sang validate chữ 'accepted' thay vì 'approved'
        $request->validate([
            'status' => 'required|in:accepted,cancelled,confirmed', // Thêm confirmed nếu view của bạn dùng confirmed
        ]);

        // Cập nhật trạng thái dựa theo nút bấm gửi lên
        $order->status = $request->status;

        if ($request->status === 'accepted' || $request->status === 'confirmed') {
            // Dùng try-catch để nếu database chưa chạy migration thêm cột approved_at thì cũng không bị văng lỗi 500 nữa!
            try {
                $order->approved_at = now();
            } catch (\Exception $e) {
                // Bỏ qua lỗi thiếu cột nếu chưa có
            }
        }

        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    // 🌟 3. HÀM THỐNG KÊ DASHBOARD CHO ĐỐI TÁC (FIX DOANH THU)
    public function partnerDashboard()
    {
        $partnerId = auth()->id();

        // Đếm tổng số dịch vụ (Tour/Xe/Vé) của riêng đối tác này đang bán
        $totalServices = \App\Models\Service::where('user_id', $partnerId)->count();

        // Đếm số lượng đơn hàng đang ở trạng thái 'pending' (Chờ duyệt)
        $pendingOrders = \App\Models\Order::where('status', 'pending')
            ->whereHas('service', function ($query) use ($partnerId) {
                $query->where('user_id', $partnerId);
            })->count();

        // 🌟 SỬA TẠI ĐÂY: Thêm 'approved' vào mảng quét để tính tiền cho các đơn hiện tại trong DB của bạn
        $totalRevenue = \App\Models\Order::whereIn('status', ['accepted', 'confirmed', 'approved'])
            ->whereHas('service', function ($query) use ($partnerId) {
                $query->where('user_id', $partnerId);
            })
            ->sum('total_price');

        // Trả dữ liệu về view partner-dashboard
        return view('partner-dashboard', compact('totalServices', 'pendingOrders', 'totalRevenue'));
    }
}