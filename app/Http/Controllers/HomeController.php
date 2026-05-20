<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    // 1. Hiển thị danh sách dịch vụ ra trang chủ (Phân tách Độc lập: Tour, Vé, Xe, Khách sạn)
    public function index(Request $request)
    {
        // 🟢 Nạp sẵn mối quan hệ reviews và CHỈ LẤY ĐÁNH GIÁ ĐÃ DUYỆT (is_approved = 1) để tính số sao
        $query = Service::with(['reviews' => function($q) {
            $q->where('is_approved', 1);
        }]);

        // Lấy dữ liệu bộ lọc từ URL lên
        $location = $request->input('location');
        $type = $request->input('type');         // Tham số từ tab xe/vé/khách sạn (?type=car, ?type=ticket, ?type=hotel)
        $category = $request->input('category'); // Tham số từ tab tour (?category=trong_nuoc, ?category=nuoc_ngoai)

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
       // =========================================================================
        // BỘ LỌC 2: PHÂN LOẠI DỊCH VỤ TUYỆT ĐỐI - CHỐNG LẪN LỘN KHÁCH SẠN
        // =========================================================================
        
        // 1. Nếu người dùng chọn Tab Xe tự lái
        if ($type === 'car') {
    $query->where('category_id', 4);
}

elseif ($type === 'ticket') {
    $query->where('category_id', 3);
}

elseif ($type === 'tour') {
    $query->where('category_id', 1)
          ->whereDoesntHave('hotels');
}

elseif ($type === 'hotel') {
    $query->whereHas('hotels');
}

        // 4. Nếu người dùng bấm vào Tab "Tour Trong Nước" hoặc "Tour Nước Ngoài"
        elseif ($category && $category != '') {
            // Bảo vệ nghiêm ngặt: Đảm bảo chỉ lấy đúng category được truyền và loại trừ các nhóm khác
            $query->where('category', $category)
                  ->whereNotIn('category', ['hotel', 'car', 'ticket']);
        }
        
        // 5. Nếu tìm kiếm chung loại hình "Tour du lịch trọn gói" ở thanh tìm kiếm
        elseif ($type === 'tour') {
            $query->whereIn('category', ['trong_nuoc', 'nuoc_ngoai']);
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

        return view('service-detail', compact('service', 'approvedReviews'));
    }

    // 3. Xử lý đặt dịch vụ (Đã cập nhật lưu Ngày và Ghi chú)
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