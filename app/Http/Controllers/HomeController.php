<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    // 1. Hiển thị danh sách dịch vụ ra trang chủ (Xử lý lọc MAP chuẩn khít theo ID Database của ông Đức)
    public function index(Request $request)
    {
        // 🟢 Nạp sẵn mối quan hệ reviews và CHỈ LẤY ĐÁNH GIÁ ĐÃ DUYỆT (is_approved = 1) để tính số sao
       $query = Service::with(['reviews' => function($q) {
    $q->where('is_visible', 1);
}]);

        // Lấy dữ liệu bộ lọc từ URL lên
        $location = $request->input('location');
        $type = $request->input('type'); 

        // =========================================================================
        // BỘ LỌC 1: Tìm kiếm chính xác theo địa điểm (Location)
        // =========================================================================
        if ($location && trim($location) != '') {
            $cleanLocation = mb_strtolower(trim($location), 'UTF-8');
            
            $query->where(function($q) use ($cleanLocation) {
                $q->whereRaw('LOWER(location) LIKE ?', ['%' . $cleanLocation . '%']);
                
                $noSignLocation = \Illuminate\Support\Str::slug($cleanLocation, ' ');
                $q->orWhereRaw('LOWER(location) LIKE ?', ['%' . $noSignLocation . '%']);
            });
        }

        // =========================================================================
        // BỘ LỌC 2: PHÂN LOẠI DỊCH VỤ - MAP CHUẨN KHÍT 100% THEO ID ẢNH DATABASE
        // =========================================================================
        if ($type && trim($type) != '') {
            switch ($type) {
                case 'domestic_tour':
                    // Theo ảnh DB: ID số 3 chính là Tour trong nước (Tây Bắc, Phú Quốc...)
                    $query->where('category_id', 3);
                    break;

                case 'international_tour':
                    // Theo ảnh DB: ID số 4 chính là Tour nước ngoài (Singapore, Hàn, Nhật...)
                    $query->where('category_id', 4);
                    break;

                case 'hotel':
                    // Theo ảnh DB: ID số 5 chính là Khách sạn & Resort (Amanoi, Six Senses...)
                    $query->where('category_id', 5);
                    break;

                case 'ticket':
                    // Theo ảnh DB: ID số 2 chính là Vé (Sun World, VinWonders...)
                    $query->where('category_id', 2);
                    break;

                case 'car':
                    // Theo ảnh DB: ID số 1 chính là Thuê xe tự lái (VinFast, Toyota...)
                    $query->where('category_id', 1);
                    break;
            }
        }

        // Thực thi lấy dữ liệu sắp xếp mới nhất sau khi đi qua màng lọc chuẩn
        $services = $query->latest()->get();

        // Trả dữ liệu ra ngoài view 'welcome'
        return view('welcome', compact('services'));
    }

    // 2. Xem chi tiết một Tour/Dịch vụ cụ thể
    public function show($id)
    {
        $service = Service::findOrFail($id);

        $approvedReviews = \App\Models\Review::where('service_id', $id)
                                             ->where('is_approved', 1)
                                             ->with('user')
                                             ->latest()
                                             ->get();

        // Tính điểm trung bình của các review đã duyệt để hiển thị ở trang chi tiết
        $avgRating = $approvedReviews->count() > 0 ? round($approvedReviews->avg('rating'), 1) : 0;

        return view('service-detail', compact('service', 'approvedReviews', 'avgRating'));
    }

    // 3. Xử lý đặt dịch vụ
    public function book(Request $request, $id)
    {
        if (auth()->user()->role !== 'customer') {
            return redirect()->back()->with('error', 'Chỉ tài khoản Khách hàng mới có thể đặt dịch vụ này.');
        }

        $service = Service::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1',
            'booking_date' => 'required|date|after_or_equal:today', 
        ]);

        $totalPrice = $service->price * $request->quantity;

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
        $orders = Order::where('user_id', auth()->id())->with('service')->latest()->get();
        $services = Service::latest()->get(); 

        return view('dashboard', compact('orders', 'services')); 
    }

    // 5. Hàm xử lý upload ảnh hóa đơn chuyển khoản và lưu Database
    public function uploadProof(Request $request, $id)
    {
        $order = \App\Models\Order::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            $filePath = $request->file('payment_proof')->store('payment_proofs', 'public');
            
            $order->update([
                'payment_proof' => $filePath
            ]);

            return redirect()->back()->with('success', 'Tải lên hóa đơn thanh toán thành công! Vui lòng chờ đối tác xác thực.');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra, không thể tải lên tệp ảnh.');
    }
}