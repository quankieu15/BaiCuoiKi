<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HKT TRAVEL ADMIN</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-cyan-50 via-sky-50 to-blue-100 text-slate-900 min-h-screen">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gradient-to-b from-sky-600 via-cyan-600 to-blue-700 text-white fixed h-full z-50 shadow-2xl">

        {{-- LOGO --}}
        <div class="p-5 border-b border-white/10 bg-white/10 backdrop-blur-md">

            <div class="flex items-center">

                <span class="text-2xl font-black tracking-wider">

                    <span class="text-white">
                        HKT
                    </span>

                    <span class="text-yellow-200">
                        TRAVEL
                    </span>

                </span>

                <span class="ml-2 px-3 py-1 rounded-lg bg-white text-sky-700 text-[10px] font-black uppercase">
                    Admin
                </span>

            </div>

        </div>

        {{-- MENU --}}
        <nav class="p-4 space-y-2 text-sm font-bold">

            <p class="text-white/70 uppercase text-[11px] tracking-widest px-3 pb-2">
                Hệ thống quản trị
            </p>

            <a href="/"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-white/20 transition">

                <i class="fa-solid fa-house text-white"></i>

                <span class="text-white">
                    Xem Trang Chủ
                </span>

            </a>

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-white/20 transition">

                <i class="fa-solid fa-chart-pie text-white"></i>

                <span class="text-white">
                    Tổng quan hệ thống
                </span>

            </a>

   <a href="{{ route('admin.orders.index') }}"
   class="relative flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-white/20 transition">

    <div class="relative">
        <i class="fa-solid fa-clipboard-list text-white text-[15px]"></i>

        {{-- Badge thông báo --}}
        @php
            $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
        @endphp

        @if($pendingOrders > 0)
            <span class="absolute -top-2 -right-2 min-w-[20px] h-5 px-1 flex items-center justify-center 
                         bg-red-500 text-white text-[10px] font-black rounded-full 
                         border-2 border-white shadow animate-pulse">
                {{ $pendingOrders }}
            </span>
        @endif
    </div>

    <span class="text-white font-semibold">
        Quản lý đặt lịch
    </span>

</a>
            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-white/20 transition">

                <i class="fa-solid fa-users text-white"></i>

                <span class="text-white">
                    Quản lý Thành viên
                </span>

            </a>

            <a href="{{ route('admin.reviews.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-white/20 transition">

                <i class="fa-solid fa-comments text-white"></i>

                <span class="text-white">
                    Kiểm duyệt Đánh giá
                </span>

            </a>

            <a href="{{ route('admin.feedbacks.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-white/20 transition">

                <i class="fa-solid fa-inbox text-white"></i>

                <span class="text-white">
                    Quản lý góp ý
                </span>

            </a>

        </nav>

        {{-- FOOTER --}}
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/10 bg-white/10">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-full bg-white text-sky-700 flex items-center justify-center font-black">
                    A
                </div>

                <div>

                    <p class="text-[11px] uppercase text-white/70 font-bold">
                        Xin chào
                    </p>

                    <p class="font-black text-white">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </p>

                </div>

            </div>

        </div>

    </aside>

    {{-- MAIN --}}
    <main class="flex-1 pl-64">

        {{-- HEADER --}}
        <header class="h-16 bg-white/70 backdrop-blur-xl border-b border-white/40 sticky top-0 z-40 shadow-sm flex items-center justify-between px-8">

            <h1 class="text-sm font-black uppercase tracking-wider text-slate-700">
                HKT TRAVEL ADMIN SYSTEM
            </h1>

        </header>

        {{-- CONTENT --}}
        <div class="p-8">

            @yield('content')

        </div>

    </main>

</div>

</body>
</html>