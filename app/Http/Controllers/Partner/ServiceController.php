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

        return view('partner.services.index', compact('services'));
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
}