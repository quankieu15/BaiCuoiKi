<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // 1. Khách hàng gửi đánh giá (Yêu cầu có đăng nhập)
    public function store(Request $request, $serviceId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ], [
            'rating.required' => 'Vui lòng chọn số sao đánh giá.',
            'comment.required' => 'Vui lòng viết nội dung bình luận.',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'service_id' => $serviceId,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => 0, // Chờ Admin kiểm duyệt theo đúng yêu cầu đồ án
        ]);

        return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi và đang chờ kiểm duyệt!');
    }

    // 2. Trang quản lý đánh giá dành cho Admin
    public function adminIndex()
    {
        $reviews = Review::with(['user', 'service'])->latest()->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    // 3. Admin phê duyệt bình luận hợp lệ
    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['is_approved' => 1]);
        return redirect()->back()->with('success', 'Đã phê duyệt đánh giá này hiển thị công khai.');
    }

    // 4. Admin xóa bình luận (nếu chứa từ ngữ thô tục, spam)
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->back()->with('success', 'Đã xóa bỏ đánh giá thành công.');
    }
}