<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    // 1. Hiển thị danh sách dịch vụ ra trang chủ công cộng (Đã tích hợp Reviews + Bộ lọc thông minh)
    public function index(Request $request)
    {
        // 🟢 Nạp sẵn mối quan hệ reviews và CHỈ LẤY ĐÁNH GIÁ ĐÃ DUYỆT (is_approved = 1) để tính số sao
        $query = Service::with(['reviews' => function($q) {
            $q->where('is_approved', 1);
        }]);

        // Lấy dữ liệu từ bộ lọc gửi lên
        $location = $request->input('location');
        $type = $request->input('type');

        // BỘ LỌC 1: Ép chặt tìm kiếm chuẩn xác theo cột location (Không quét cột Title/Description)
        if ($location && trim($location) != '') {
            $cleanLocation = mb_strtolower(trim($location), 'UTF-8');
            
            $query->where(function($q) use ($cleanLocation) {
                // Sử dụng LOWER của SQL để ép Database so khớp chữ thường, không lo lệch bộ mã hóa (Collation)
                $q->whereRaw('LOWER(location) LIKE ?', ['%' . $cleanLocation . '%']);
                
                // Dự phòng trường hợp khách gõ không dấu "ha noi" vẫn quét trúng "Hà Nội"
                $noSignLocation = \Illuminate\Support\Str::slug($cleanLocation, ' ');
                $q->orWhereRaw('LOWER(location) LIKE ?', ['%' . $noSignLocation . '%']);
            });
        }

        // BỘ LỌC 2: Phân loại thông minh (Dành cho Xe, Vé, Tour)
        if ($type && $type != '') {
            if ($type === 'car') {
                $query->where(function($q) {
                    $q->where('title', 'LIKE', '%xe%')
                      ->orWhere('title', 'LIKE', '%ô tô%')
                      ->orWhere('description', 'LIKE', '%thông tin xe%');
                });
            } elseif ($type === 'ticket') {
                $query->where(function($q) {
                    $q->where('title', 'LIKE', '%vé%')
                      ->orWhere('title', 'LIKE', '%vào cổng%')
                      ->orWhere('title', 'LIKE', '%vào cửa%')
                      ->orWhere('title', 'LIKE', '%vinwonders%');
                });
            } elseif ($type === 'tour') {
                $query->where('title', 'NOT LIKE', '%xe%')
                  ->where('title', 'NOT LIKE', '%ô tô%')
                  ->where('title', 'NOT LIKE', '%vé%');
            }
        }

        // Thực thi lấy dữ liệu sau khi đã đi qua hết các bộ lọc trên
        $services = $query->latest()->get();

        // Trả về view 'welcome' ở cuối hàm để tránh lỗi Exception trace
        return view('welcome', compact('services'));
    }

    // 2. Xem chi tiết một Tour/Dịch vụ cụ thể
    public function show($id)
    {
        // Tìm dịch vụ
        $service = Service::findOrFail($id);

        // Bốc riêng các bình luận ĐÃ ĐƯỢC DUYỆT (is_approved = 1) kèm thông tin User viết
        $approvedReviews = \App\Models\Review::where('service_id', $id)
                                             ->where('is_approved', 1)
                                             ->with('user')
                                             ->latest()
                                             ->get();

        // Bắn cả 2 biến này sang file giao diện chi tiết
        return view('service-detail', compact('service', 'approvedReviews'));
    }

    // 3. Xử lý đặt dịch vụ (Đã cập nhật lưu Ngày và Ghi chú)
    public function book(Request $request, $id)
    {
        if (auth()->user()->role !== 'customer') {
            return redirect()->back()->with('error', 'Chỉ tài khoản Khách hàng mới có thể đặt dịch vụ này.');
        }

        $service = Service::findOrFail($id);

        // Kiểm tra validation cho ngày đặt lịch
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'booking_date' => 'required|date|after_or_equal:today', // Ngày đặt phải từ hôm nay trở đi
        ]);

        $totalPrice = $service->price * $request->quantity;

        // Tiến hành tạo đơn hàng mới với đầy đủ thông tin
        Order::create([
            'user_id' => auth()->id(),
            'service_id' => $service->id,
            'quantity' => $request->quantity,
            'booking_date' => $request->input('booking_date'), 
            'total_price' => $totalPrice,
            'status' => 'pending', 
            'payment_method' => 'cod', 
            'note' => $request->input('note'), 
        ]);

        return redirect()->to('/dashboard')->with('success', 'Đặt dịch vụ thành công! Vui lòng chờ đối tác xác nhận liên hệ.');
    }

    // 4. Xem danh sách lịch sử đặt tour tại Bảng điều khiển
    public function myOrders()
    {
        // Lấy danh sách đơn hàng của User
        $orders = Order::where('user_id', auth()->id())->with('service')->latest()->get();
        
        // Lấy thêm danh sách dịch vụ dự phòng tránh lỗi Undefined variable ngoài view
        $services = Service::latest()->get(); 

        return view('dashboard', compact('orders', 'services')); 
    }
    // 🌟 5. HÀM XỬ LÝ UPLOAD ẢNH HÓA ĐƠN CHUYỂN KHOẢN VÀ LƯU DATABASE
    public function uploadProof(Request $request, $id)
    {
        // Kiểm tra xem đơn hàng đó có đúng là của ông đang đăng nhập không
        $order = \App\Models\Order::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Kiểm tra file ảnh truyền lên (Tối đa 2MB)
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            // Lưu file ảnh vào thư mục public/storage/payment_proofs
            $filePath = $request->file('payment_proof')->store('payment_proofs', 'public');
            
            // Cập nhật đường dẫn file vào database
            $order->update([
                'payment_proof' => $filePath
            ]);

            return redirect()->back()->with('success', 'Tải lên hóa đơn thanh toán thành công! Vui lòng chờ đối tác xác thực.');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra, không thể tải lên tệp ảnh.');
    }
}