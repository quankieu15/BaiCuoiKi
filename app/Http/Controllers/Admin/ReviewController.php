<?php

namespace App\Http\Controllers\Admin; // 🌟 Phải thêm chữ \Admin vào đây thì mới đúng chuẩn PSR-4

use App\Http\Controllers\Controller;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * 1. Khách hàng gửi đánh giá từ trang chi tiết dịch vụ
     */
    public function store(Request $request, $serviceId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'service_id' => $serviceId,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => false, // Mặc định là false (Chờ duyệt), chưa hiển thị công khai
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá! Bình luận đang chờ kiểm duyệt.');
    }

    /**
     * 2. Admin xem danh sách toàn bộ đánh giá cần kiểm duyệt
     */
    public function adminIndex()
    {
        // Lấy toàn bộ đánh giá, nạp trước (Eager Load) user và service để tối ưu
        $reviews = Review::with(['user', 'service'])->latest()->get();
        
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * 3. Admin phê duyệt đánh giá
     */
    public function approve($id)
    {
        $review = Review::findOrFail($id);
        
        // Chuyển trạng thái từ false (0) sang true (1) để kích hoạt hiển thị
        $review->update([
            'is_approved' => true
        ]);

        return redirect()->back()->with('success', '✅ Đã phê duyệt và cho phép hiển thị bình luận công khai!');
    }

    /**
     * 4. Admin xóa bỏ đánh giá (Spam, tiêu cực)
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', '🗑️ Đã xóa bỏ đánh giá thành công khỏi hệ thống!');
    }
    public function toggle($id)
{
    $review = Review::findOrFail($id);

    $review->is_visible = !$review->is_visible;

    $review->save();

    return back()->with('success', 'Đã cập nhật trạng thái đánh giá!');
}
}