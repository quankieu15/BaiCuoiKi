<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    // ==========================================
    // 1. DÀNH CHO ADMIN VÀ PARTNER
    // ==========================================
    
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
                $query->where('user_id', $user->id); // Bảng services có user_id của partner
            })->with(['user', 'service'])->latest()->get();
        } else {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        return view('admin.orders.index', compact('orders'));
    }

    // Xử lý cập nhật trạng thái đơn hàng (Xác nhận / Hủy)
    public function updateStatus(Request $request, $id)
    {
        $user = auth()->user();
        $order = Order::findOrFail($id);
        $status = $request->input('status'); // nhận vào 'pending', 'confirmed', 'cancelled', 'completed'

        // Bảo mật: Nếu là Partner, chỉ được quyền duyệt đơn thuộc dịch vụ của mình
        if ($user->role === 'partner') {
            $isOwner = \DB::table('services')->where('id', $order->service_id)->where('user_id', $user->id)->exists();
            if (!$isOwner) {
                abort(403, 'Bạn không có quyền xử lý đơn hàng này.');
            }
        } elseif ($user->role !== 'admin') {
            abort(403, 'Hành động không được phép.');
        }

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

    // ==========================================
    // 2. DÀNH CHO USER (KHÁCH HÀNG THƯỜNG)
    // ==========================================

    /**
     * Hiển thị lịch sử đặt tour/khách sạn của chính User
     */
    public function userOrders()
    {
        // Lấy toàn bộ đơn hàng của user đang đăng nhập kèm thông tin dịch vụ
        $orders = Order::where('user_id', auth()->id())
                       ->with('service')
                       ->latest()
                       ->get();

        // Trả về trang dashboard của user
        return view('dashboard', compact('orders'));
    }

    /**
     * Xử lý User upload ảnh hóa đơn chuyển khoản (Payment Proof)
     */
    public function uploadProof(Request $request, $id)
    {
        // Validate file tải lên (định dạng ảnh, tối đa 2MB)
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'payment_proof.required' => 'Vui lòng chọn một hình ảnh hóa đơn.',
            'payment_proof.image'    => 'Tệp tải lên phải là hình ảnh.',
            'payment_proof.mimes'    => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'payment_proof.max'      => 'Kích thước ảnh không được vượt quá 2MB.',
        ]);

        // Tìm đơn hàng và kiểm tra xem có đúng là của User này không
        $order = Order::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        if ($request->hasFile('payment_proof')) {
            // Tối ưu: Nếu trước đó đã có ảnh cũ, xóa đi để tránh rác bộ nhớ server
            if ($order->payment_proof && Storage::disk('public')->exists($order->payment_proof)) {
                Storage::disk('public')->delete($order->payment_proof);
            }

            // Lưu file ảnh mới vào thư mục: storage/app/public/proofs
            $path = $request->file('payment_proof')->store('proofs', 'public');

            // Cập nhật đường dẫn vào database
            $order->update([
                'payment_proof' => $path
            ]);

            return redirect()->back()->with('success', 'Gửi hóa đơn thanh toán thành công! Vui lòng chờ đối tác xác nhận.');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra khi tải ảnh lên, vui lòng thử lại.');
    }
}