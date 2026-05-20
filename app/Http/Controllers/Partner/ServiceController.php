<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category;
use App\Models\Hotel; 
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    // 1. Giao diện danh sách dịch vụ (Tách biệt Tuyệt Đối Tour và Khách Sạn)
    public function index(Request $request)
    {
        // Lấy tham số loại bộ lọc từ URL (Mặc định không truyền là 'all')
        $type = $request->query('type', 'all');

        // Khởi tạo query lấy dịch vụ của riêng đối tác đang đăng nhập
        $query = Service::where('user_id', auth()->id())->latest();
        
        // Tiến hành phân loại rạch ròi theo cấu trúc dữ liệu thực tế
        if ($type !== 'all') {
            if ($type === 'car') {
                // Thuê xe tự lái & Trung chuyển -> ID danh mục = 4
                $query->where('category_id', 4); 
            } 
            elseif ($type === 'hotel') {
                // TAB KHÁCH SẠN: Cứ dịch vụ nào CÓ liên kết với bảng hotels ở bảng trung gian thì gom hết về đây
                $query->whereHas('hotels'); 
            } 
            elseif ($type === 'tour') {
                // TAB TOUR: Thuộc danh mục Tour (ID 1) nhưng KHÔNG ĐƯỢC dính dáng đến Khách sạn
                $query->where('category_id', 1)->whereDoesntHave('hotels'); 
            } 
            elseif ($type === 'ticket') {
                // Vé tham quan & Vui chơi -> ID danh mục = 3
                $query->where('category_id', 3); 
            }
        }

        $services = $query->get();
        
        return view('partner.services.index', compact('services'));
    }

    // 2. Giao diện thêm mới dịch vụ
    public function create()
    {
        $categories = Category::all();
        $hotels = Hotel::all(); 
        
        return view('partner.services.create', compact('categories', 'hotels'));
    }

    // 3. Xử lý lưu dịch vụ mới vào Database
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'hotel_ids'   => 'nullable|array', // Để tương thích nếu truyền mảng
            'hotel_id'    => 'nullable|exists:hotels,id', // Đón đầu nếu form truyền dạng số đơn lẻ
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'location'    => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();

        // Xử lý upload ảnh dịch vụ
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/services'), $imageName);
            $data['image'] = 'uploads/services/' . $imageName;
        }

        // Tạo mới dịch vụ
        $service = Service::create($data);

        // XỬ LÝ ĐỒNG BỘ BẢNG TRUNG GIAN HOTEL_SERVICE
        // Cách 1: Nếu form của mày gửi lên dạng mảng hotel_ids[]
        if ($request->has('hotel_ids') && !empty($request->hotel_ids)) {
            $service->hotels()->sync($request->hotel_ids);
        } 
        // Cách 2: Nếu form gửi lên dạng ô select đơn lẻ tên là hotel_id
        elseif ($request->has('hotel_id') && !empty($request->hotel_id)) {
            $service->hotels()->sync([$request->hotel_id]);
        }

        return redirect()->route('partner.services.index')->with('success', 'Thêm dịch vụ thành công!');
    }

    // 4. Giao diện chỉnh sửa dịch vụ
    public function edit(Service $service)
    {
        if ($service->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        $hotels = Hotel::all(); 
        
        return view('partner.services.edit', compact('service', 'categories', 'hotels'));
    }

    // 5. Xử lý cập nhật dữ liệu sửa đổi
    public function update(Request $request, Service $service)
    {
        if ($service->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'hotel_ids'   => 'nullable|array',
            'hotel_id'    => 'nullable|exists:hotels,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'location'    => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Xử lý ảnh cũ / ảnh mới
        if ($request->hasFile('image')) {
            if ($service->image && file_exists(public_path($service->image))) {
                @unlink(public_path($service->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/services'), $imageName);
            $data['image'] = 'uploads/services/' . $imageName;
        }

        $service->update($data);

        // CẬP NHẬT LẠI LIÊN KẾT KHÁCH SẠN Ở BẢNG TRUNG GIAN
        if ($request->has('hotel_ids') && !empty($request->hotel_ids)) {
            $service->hotels()->sync($request->hotel_ids);
        } elseif ($request->has('hotel_id') && !empty($request->hotel_id)) {
            $service->hotels()->sync([$request->hotel_id]);
        } else {
            // Nếu không chọn khách sạn nào thì gỡ liên kết ra (trở thành Tour thuần túy)
            $service->hotels()->detach();
        }

        return redirect()->route('partner.services.index')->with('success', 'Cập nhật dịch vụ thành công!');
    }

    // 6. Xử lý xóa đơn lẻ dịch vụ
    public function destroy(Service $service)
    {
        if ($service->user_id !== auth()->id()) {
            abort(403);
        }

        if ($service->image && file_exists(public_path($service->image))) {
            @unlink(public_path($service->image));
        }

        // Tự động gỡ liên kết bảng trung gian trước khi xóa dịch vụ
        $service->hotels()->detach();
        $service->delete();

        return redirect()->route('partner.services.index')->with('success', 'Xóa dịch vụ thành công!');
    }

    // 7. Xử lý xóa hàng loạt
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Vui lòng tích chọn ít nhất một dịch vụ để xóa!');
        }

        $services = Service::whereIn('id', $ids)->where('user_id', auth()->id())->get();

        foreach ($services as $service) {
            if ($service->image && file_exists(public_path($service->image))) {
                @unlink(public_path($service->image));
            }
            $service->hotels()->detach();
            $service->delete();
        }

        return redirect()->back()->with('success', 'Đã xóa toàn bộ các dịch vụ được chọn thành công!');
    }
}