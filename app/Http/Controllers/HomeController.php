<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // 1. Hiển thị danh sách dịch vụ ra trang chủ công cộng (Đã thêm bộ lọc tìm kiếm)
    public function index(Request $request)
    {
        $query = Service::query();

        // Nếu có gõ từ khóa tìm kiếm (theo Tên tour hoặc Địa điểm)
        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                  ->orWhere('location', 'like', $searchTerm);
            });
        }

        $services = $query->latest()->get();
        return view('welcome', compact('services'));
    }

    // TÍNH NĂNG MỚI: Xem chi tiết một Tour/Dịch vụ cụ thể
    public function show($id)
{
    // Sử dụng load() hoặc with() để lấy kèm danh sách khách sạn kết nối qua bảng trung gian
    $service = Service::with('hotel')->findOrFail($id);
    
    return view('service-detail', compact('service'));
}

    // 2. Xử lý đặt tour/dịch vụ (Bắt buộc đăng nhập mới đặt được)
    public function book(Request $request, $id)
    {
        // Chặn nếu người đặt không phải là khách hàng thông thường (Tránh admin/partner tự đặt)
        if (auth()->user()->role !== 'customer') {
            return redirect()->back()->with('error', 'Chỉ tài khoản Khách hàng mới có thể đặt dịch vụ này.');
        }

        $service = Service::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Tính toán tổng tiền
        $totalPrice = $service->price * $request->quantity;

        // Lưu đơn hàng vào bảng orders
        Order::create([
            'user_id' => auth()->id(),
            'service_id' => $service->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'pending', // Trạng thái chờ duyệt
            'payment_method' => 'cod', // Thanh toán khi khởi hành/nhận phòng
        ]);

        // Thay vì ở lại trang chi tiết, đặt xong ép nhảy thẳng về Dashboard để xem hóa đơn luôn cho chuyên nghiệp
        return redirect()->route('dashboard')->with('success', 'Đặt dịch vụ thành công! Vui lòng chờ đối tác xác nhận liên hệ.');
    }

    // 3. Xem danh sách lịch sử đặt tour của chính khách hàng đăng nhập
    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())->with('service')->latest()->get();
        return view('dashboard', compact('orders')); 
    }
}