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
    // 1. Trang danh sách dịch vụ của riêng đối tác đó
    public function index()
    {
        $services = Service::where('user_id', auth()->id())->latest()->get();
        
        // 🔥 ĐÃ FIX: Đổi từ 'partner.services.index' thành 'partner-dashboard' 
        // (Vì file thực tế của bạn là resources/views/partner-dashboard.blade.php)
       return view('partner.services.index', compact('services'));
    }

    // 2. Giao diện thêm mới dịch vụ
    public function create()
    {
        $categories = Category::all();
        $hotels = Hotel::all(); 
        
        // 🔥 ĐÃ FIX: Đổi từ 'partner.services.create' thành 'partner.create'
        // (Vì file thực tế của bạn là resources/views/partner/create.blade.php)
       return view('partner.services.create', compact('categories', 'hotels'));
    }

    // 3. Xử lý lưu dịch vụ mới vào Database (Đã cập nhật lưu bảng trung gian)
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'hotel_ids'   => 'nullable|array', // Khai báo dạng mảng cho phép chọn nhiều khách sạn
            'hotel_ids.*' => 'exists:hotels,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'location'    => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id(); // Lưu ID của đối tác đang đăng nhập

        // Xử lý upload ảnh nếu có
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/services'), $imageName);
            $data['image'] = 'uploads/services/' . $imageName;
        }

        // Tạo dịch vụ trước
        $service = Service::create($data);

        // Đồng bộ liên kết khách sạn nếu dịch vụ là Tour
        $category = Category::find($request->category_id);
        if ($category && Str::contains(Str::slug($category->name), 'tour') && $request->has('hotel_ids')) {
            $service->hotels()->sync($request->hotel_ids);
        }

        return redirect()->route('partner.services.index')->with('success', 'Thêm dịch vụ thành công!');
    }

    // 4. Giao diện chỉnh sửa dịch vụ (Nhiều - Nhiều)
    public function edit(Service $service)
    {
        // Bảo mật: Nếu đối tác này cố tình sửa dịch vụ của đối tác khác thì chặn lại
        if ($service->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        $hotels = Hotel::all(); 
        
        return view('partner.services.edit', compact('service', 'categories', 'hotels'));
    }

    // 5. Xử lý cập nhật dữ liệu sửa đổi (Đã cập nhật đồng bộ bảng trung gian)
    public function update(Request $request, Service $service)
    {
        if ($service->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'hotel_ids'   => 'nullable|array', // Xác thực dạng mảng cho phần cập nhật
            'hotel_ids.*' => 'exists:hotels,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'location'    => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có để tránh nặng máy
            if ($service->image && file_exists(public_path($service->image))) {
                @unlink(public_path($service->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/services'), $imageName);
            $data['image'] = 'uploads/services/' . $imageName;
        }

        // Cập nhật thông tin cơ bản của dịch vụ
        $service->update($data);

        // Xử lý đồng bộ lại bảng trung gian khi sửa đổi
        $category = Category::find($request->category_id);
        if ($category && Str::contains(Str::slug($category->name), 'tour')) {
            // Nếu người dùng bỏ tích toàn bộ khách sạn, gửi mảng rỗng [] vào sync() để xóa sạch liên kết cũ
            $hotelIds = $request->input('hotel_ids', []);
            $service->hotels()->sync($hotelIds);
        } else {
            // Nếu đổi từ danh mục Tour sang danh mục khác (như thuê xe), xóa toàn bộ liên kết khách sạn cũ
            $service->hotels()->detach();
        }

        return redirect()->route('partner.services.index')->with('success', 'Cập nhật dịch vụ thành công!');
    }

    // 6. Xử lý xóa dịch vụ (Bảng trung gian tự động xóa nhờ cascade cài ở Migration)
    public function destroy(Service $service)
    {
        if ($service->user_id !== auth()->id()) {
            abort(403);
        }

        if ($service->image && file_exists(public_path($service->image))) {
            @unlink(public_path($service->image));
        }

        $service->delete();

        return redirect()->route('partner.services.index')->with('success', 'Xóa dịch vụ thành công!');
    }
}