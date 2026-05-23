<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HKT TRAVEL PARTNER</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-cyan-50 via-sky-50 to-blue-100 text-slate-900 min-h-screen">

<div class="flex min-h-screen">

    {{-- SIDEBAR - TÔNG MÀU CYAN/SLATE SANG TRỌNG CHO PARTNER --}}
    <aside class="w-64 bg-gradient-to-b from-cyan-700 via-sky-700 to-slate-800 text-white fixed h-full z-50 shadow-2xl">

        {{-- LOGO --}}
        <div class="p-5 border-b border-white/10 bg-white/10 backdrop-blur-md">
            <div class="flex items-center">
                <span class="text-2xl font-black tracking-wider">
                    <span class="text-white">HKT</span>
                    <span class="text-yellow-200">TRAVEL</span>
                </span>
                <span class="ml-2 px-3 py-1 rounded-lg bg-emerald-500 text-white text-[10px] font-black uppercase tracking-wider shadow-sm">
                    Partner
                </span>
            </div>
        </div>

        {{-- MENU DÀNH RIÊNG CHO ĐỐI TÁC --}}
        <nav class="p-4 space-y-2 text-sm font-bold">
            <p class="text-white/60 uppercase text-[10px] font-black tracking-widest px-3 pb-2">
                Kênh Nhà Cung Cấp
            </p>

            {{-- 🟢 ĐÃ ĐỔI LINK VỀ TRANG TỔNG QUAN PARTNER --}}
            <a href="{{ route('partner.dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('partner.dashboard') ? 'bg-white text-cyan-800 shadow-lg font-black' : 'hover:bg-white/10 text-white/90' }}">
                <i class="fa-solid fa-chart-pie w-5"></i>
                <span>Tổng quan Partner</span>
            </a>

            {{-- QUẢN LÝ DỊCH VỤ --}}
            <a href="{{ route('partner.services.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('partner.services.*') && !request()->routeIs('partner.analytics') ? 'bg-white text-cyan-800 shadow-lg font-black' : 'hover:bg-white/10 text-white/90' }}">
                <i class="fa-solid fa-cubes w-5"></i>
                <span>Quản lý dịch vụ</span>
            </a>

            {{-- DOANH THU & THỐNG KÊ --}}
            <a href="{{ route('partner.analytics') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('partner.analytics') ? 'bg-white text-cyan-800 shadow-lg font-black' : 'hover:bg-white/10 text-white/90' }}">
                <i class="fa-solid fa-wallet w-5"></i>
                <span>Doanh thu & Thống kê</span>
            </a>
        </nav>

        {{-- USER INFO FOOTER --}}
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/10 bg-black/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center font-black text-white border border-white/10 uppercase shadow-inner">
                    {{ Str::substr(auth()->user()->name ?? 'P', 0, 1) }}
                </div>
                <div>
                    <p class="text-[10px] uppercase text-white/50 font-black tracking-wider">Đối tác</p>
                    <p class="font-black text-white text-sm truncate max-w-[150px]">
                        {{ auth()->user()->name ?? 'Đối tác' }}
                    </p>
                </div>
            </div>
        </div>

    </aside>

    {{-- MAIN CONTENT AREA --}}
    <main class="flex-1 pl-64">

        {{-- TOPBAR HEADER --}}
        <header class="h-16 bg-white/70 backdrop-blur-xl border-b border-white/40 sticky top-0 z-40 shadow-sm flex items-center justify-between px-8">
            <h1 class="text-sm font-black uppercase tracking-wider text-slate-700 flex items-center gap-2">
                <i class="fa-solid fa-building-shield text-cyan-600"></i> HKT TRAVEL PARTNER WORKSPACE
            </h1>
        </header>

        {{-- TRUYỀN NỘI DUNG BLADE VÀO ĐÂY --}}
        <div class="p-8">
            @yield('content')
        </div>

    </main>

</div>

</body>
</html>