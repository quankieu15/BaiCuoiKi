<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng cho Admin hoặc Đối tác
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            // Admin tối cao: Thấy toàn bộ đơn hàng của hệ thống
            $orders = Order::with(['user', 'service'])->latest()->get();
        } elseif ($user->role === 'partner') {
            // Đối tác: Chỉ thấy những đơn đặt dịch vụ do chính họ tạo ra
            $orders = Order::whereHas('service', function ($query) use ($user) {
                $query->where('user_id', $user->id); // Giả định bảng services có user_id của partner
            })->with(['user', 'service'])->latest()->get();
        } else {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        return view('admin.orders.index', compact('orders'));
    }

    // Xử lý cập nhật trạng thái đơn hàng (Xác nhận / Hủy)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $status = $request->input('status'); // nhận vào 'confirmed' hoặc 'cancelled' hoặc 'completed'

        // Kiểm tra hợp lệ của trạng thái
        if (!in_array($status, ['pending', 'confirmed', 'cancelled', 'completed'])) {
            return redirect()->back()->with('error', 'Trạng thái không hợp lệ.');
        }

        // Cập nhật vào DB
        $order->update([
            'status' => $status
        ]);

        return redirect()->back()->with('success', 'Đã cập nhật trạng thái đơn hàng thành công!');
    }
}