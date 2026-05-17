<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 1. Xem danh sách đơn đặt hàng từ khách hàng đổ về
    public function index()
    {
        // Lấy các đơn hàng thuộc về các dịch vụ do Đối tác này đăng bán
        $orders = Order::whereHas('service', function ($query) {
            $query->where('user_id', auth()->id());
        })->with(['user', 'service'])->latest()->get();

        return view('partner.orders.index', compact('orders'));
    }

    // 2. Xử lý Thay đổi trạng thái đơn hàng (Xác nhận hoặc Hủy)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Bảo mật: Đảm bảo đơn hàng này thuộc về dịch vụ của chính đối tác đang đăng nhập
        if ($order->service->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:accepted,cancelled',
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}