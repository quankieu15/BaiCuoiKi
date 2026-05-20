<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    // 1. Khách gửi dữ liệu từ Form trang Liên Hệ
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|string'
        ]);

        Feedback::create($request->all());

        return redirect()->back()->with('success', 'Gửi góp ý thành công! Hệ thống đã ghi nhận phản hồi của bạn.');
    }

    // 2. Admin xem danh sách góp ý chung
    public function adminIndex()
    {
        $feedbacks = Feedback::where('type', 'general')->latest()->get();
        
        // ĐÃ SỬA: Gọi đúng file admin/feedbacks/feedbacks.blade.php
        return view('admin.feedbacks.feedbacks', compact('feedbacks'));
    }

    // 3. Partner xem danh sách góp ý dịch vụ của mình
    public function partnerIndex()
    {
        $feedbacks = Feedback::where('type', 'partner')->latest()->get();
        
        // ĐÃ SỬA: Gọi đúng file partner/feedbacks/feedbacks.blade.php
        return view('partner.feedbacks.feedbacks', compact('feedbacks'));
    }

    // 4. Xóa góp ý (dùng chung cho cả Admin & Partner)
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        return redirect()->back()->with('success', 'Đã xóa phản hồi thành công.');
    }
}