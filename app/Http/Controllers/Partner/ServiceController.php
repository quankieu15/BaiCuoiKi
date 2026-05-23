<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category;
use App\Models\Hotel;
use App\Models\Order; // 🟢 ĐÃ ĐƯA LÊN ĐẦU FILE CHUẨN CHỈ
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; // 🟢 ĐÃ ĐƯA LÊN ĐẦU FILE CHUẨN CHỈ

class ServiceController extends Controller
{
    // 1. Giao diện danh sách dịch vụ
    public function index(Request $request)
    {
        // Lấy tham số loại bộ lọc từ URL
        $type = $request->query('type', 'all');

        // LOAD ĐÁNH GIÁ + TÍNH TRUNG BÌNH SAO
        $query = Service::withAvg([
                'reviews' => function ($q) {
                    $q->where('is_approved', 1);
                }
            ], 'rating')
            ->withCount([
                'reviews' => function ($q) {
                    $q->where('is_approved', 1);
                }
            ])
            ->where(function ($q) {
                $q->where('user_id', auth()->id())
                  ->orWhere('user_id', 1);
            })
            ->latest();

        // Bộ lọc loại dịch vụ
        if ($type !== 'all') {

            if ($type === 'car') {

                $query->where(function ($q) {
                    $q->where('category', 'car')
                      ->orWhereIn(
                          'category_id',
                          Category::where('name', 'like', '%Xe%')->pluck('id')
                      );
                });

            } elseif ($type === 'ticket') {

                $query->where(function ($q) {
                    $q->where('category', 'ticket')
                      ->orWhereIn(
                          'category_id',
                          Category::where('name', 'like', '%Vé%')
                              ->orWhere('name', 'like', '%Visa%')
                              ->pluck('id')
                      );
                });

            } elseif ($type === 'domestic_tour') {

                $query->where(function ($q) {
                    $q->where('category', 'trong_nuoc')
                      ->orWhereIn(
                          'category_id',
                          Category::where('name', 'like', '%trong nước%')
                              ->orWhere('name', 'like', '%nội địa%')
                              ->pluck('id')
                      );
                });

            } elseif ($type === 'international_tour') {

                $query->where(function ($q) {
                    $q->where('category', 'nuoc_ngoai')
                      ->orWhereIn(
                          'category_id',
                          Category::where('name', 'like', '%nước ngoài%')
                              ->orWhere('name', 'like', '%quốc tế%')
                              ->orWhere('name', 'like', '%International%')
                              ->pluck('id')
                      );
                });

            } elseif ($type === 'hotel') {

                $query->where(function ($q) {
                    $q->where('category', 'hotel')
                      ->orWhereNotNull('hotel_id');
                });

            }
        }

        $services = $query->get();

        return view('partner.services.index', compact('services', 'type'));
    }

    // 2. Giao diện thêm mới dịch vụ
    public function create()
    {
        $categories = Category::all();
        $hotels = Hotel::all();

        return view('partner.services.create', compact('categories', 'hotels'));
    }

    // 3. Lưu dịch vụ mới
    public function store(Request $request)
    {
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
        $data['user_id'] = auth()->id();

        // Upload ảnh
        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('uploads/services'),
                $imageName
            );

            $data['image'] = 'uploads/services/' . $imageName;
        }

        // Tạo dịch vụ
        $service = Service::create($data);

        // Đồng bộ khách sạn
        if ($request->has('hotel_ids') && !empty($request->hotel_ids)) {

            $service->hotels()->sync($request->hotel_ids);

        } elseif ($request->has('hotel_id') && !empty($request->hotel_id)) {

            $service->hotels()->sync([$request->hotel_id]);

        }

        return redirect()
            ->route('partner.services.index')
            ->with('success', 'Thêm dịch vụ thành công!');
    }

    // 4. Form sửa
    public function edit(Service $service)
    {
        if ($service->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        $hotels = Hotel::all();

        return view(
            'partner.services.edit',
            compact('service', 'categories', 'hotels')
        );
    }

    // 5. Cập nhật dịch vụ
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

        // Upload ảnh mới
        if ($request->hasFile('image')) {

            if ($service->image && file_exists(public_path($service->image))) {
                @unlink(public_path($service->image));
            }

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('uploads/services'),
                $imageName
            );

            $data['image'] = 'uploads/services/' . $imageName;
        }

        $service->update($data);

        // Đồng bộ khách sạn
        if ($request->has('hotel_ids') && !empty($request->hotel_ids)) {

            $service->hotels()->sync($request->hotel_ids);

        } elseif ($request->has('hotel_id') && !empty($request->hotel_id)) {

            $service->hotels()->sync([$request->hotel_id]);

        } else {

            $service->hotels()->detach();

        }

        return redirect()
            ->route('partner.services.index')
            ->with('success', 'Cập nhật dịch vụ thành công!');
    }

    // 6. Xóa dịch vụ
    public function destroy(Service $service)
    {
        if ($service->user_id !== auth()->id()) {
            abort(403);
        }

        if ($service->image && file_exists(public_path($service->image))) {
            @unlink(public_path($service->image));
        }

        $service->hotels()->detach();
        $service->delete();

        return redirect()
            ->route('partner.services.index')
            ->with('success', 'Xóa dịch vụ thành công!');
    }

    // 7. Xóa hàng loạt
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return redirect()
                ->back()
                ->with('error', 'Vui lòng tích chọn ít nhất một dịch vụ để xóa!');
        }

        $services = Service::whereIn('id', $ids)
            ->where('user_id', auth()->id())
            ->get();

        foreach ($services as $service) {

            if ($service->image && file_exists(public_path($service->image))) {
                @unlink(public_path($service->image));
            }

            $service->hotels()->detach();
            $service->delete();
        }

        return redirect()
            ->back()
            ->with('success', 'Đã xóa toàn bộ các dịch vụ được chọn thành công!');
    }

  // 8. Thống kê & Doanh thu dành riêng cho Đối tác (Đã chuẩn hóa font chữ DB)
    public function analytics()
    {
        $userId = auth()->id();

        // 1. Lấy danh sách ID dịch vụ thuộc quyền sở hữu của đối tác này
        $partnerServiceIds = Service::where('user_id', $userId)->pluck('id')->toArray();

        // 2. MẢNG TRẠNG THÁI THÀNH CÔNG: Bao quát toàn bộ trường hợp chữ hoa, chữ thường, tiếng Việt có dấu
        $successStatuses = [
            'completed', 'hoan_thanh', 'success', 'approved', 
            'Đã duyệt', 'đã duyệt', 'da_duyet', 'DA_DUYET', 'Đfont ĐÃ DUYỆT', 'Thành công', 'thành công'
        ];

        // 3. Tổng doanh thu từ các đơn hàng thành công của đối tác này
        $totalRevenue = DB::table('orders')
            ->whereIn('service_id', $partnerServiceIds)
            ->whereIn('status', $successStatuses)
            ->sum('total_price');

        // 4. Tổng số đơn đặt thành công
        $totalOrders = DB::table('orders')
            ->whereIn('service_id', $partnerServiceIds)
            ->whereIn('status', $successStatuses)
            ->count();

        // 5. Tổng số dịch vụ đang sở hữu
        $totalServices = count($partnerServiceIds);

        // 6. Lấy danh sách 5 đơn hàng mới nhất của đối tác
        $recentOrders = DB::table('orders')
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->select('orders.*', 'services.title as service_title')
            ->whereIn('orders.service_id', $partnerServiceIds)
            ->orderBy('orders.created_at', 'desc')
            ->limit(5)
            ->get();

        return view('partner.services.analytics', compact(
            'totalRevenue', 
            'totalOrders', 
            'totalServices', 
            'recentOrders'
        ));
    }
}