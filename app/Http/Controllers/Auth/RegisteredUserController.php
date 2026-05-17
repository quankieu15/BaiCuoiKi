<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Thêm luật kiểm tra dữ liệu đầu vào cho phone và avatar
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:20'], // Thêm kiểm tra số điện thoại
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Thêm kiểm tra file ảnh
        ]);

        // 2. Xử lý upload file ảnh đại diện nếu người dùng có chọn ảnh
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        // 3. Tạo user mới và lưu vào bảng users trong database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'phone' => $request->phone,   // Lưu số điện thoại
            'role' => $request->role ?? 'customer', // Lưu vai trò (Khách hàng/Đối tác)
            'avatar' => $avatarPath,      // Lưu đường dẫn file ảnh
        ]);

        event(new \Illuminate\Auth\Events\Registered($user));

        \Illuminate\Support\Facades\Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}