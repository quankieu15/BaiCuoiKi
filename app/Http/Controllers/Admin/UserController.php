<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 1. Hiển thị danh sách thành viên
    public function index()
    {
        // Lấy tất cả user, phân trang mỗi trang 10 người (hoặc dùng get())
        $users = User::latest()->paginate(10); 
        return view('admin.users.index', compact('users'));
    }

    // 2. Cập nhật vai trò (Role) trực tiếp
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role; // Giả định DB mày có cột 'role'
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật vai trò thành công!');
    }

    // 3. Khóa hoặc Mở khóa tài khoản
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        // Giả định DB mày có cột 'is_active' hoặc 'status'
        $user->is_active = !$user->is_active; 
        $user->save();

        $statusMessage = $user->is_active ? 'Kích hoạt tài khoản thành công!' : 'Đã khóa tài khoản thành công!';
        return redirect()->back()->with('success', $statusMessage);
    }
}