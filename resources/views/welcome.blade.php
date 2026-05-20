<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Tour Du Lịch & Khách Sạn - HKT TRAVEL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @keyframes kenBurns {
            0% { transform: scale(1); }
            50% { transform: scale(1.04); }
            100% { transform: scale(1); }
        }
        .animate-bg-zoom { animation: kenBurns 20s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gradient-to-b from-[#ecfeff] via-[#f0f9ff] to-[#ffffff] text-slate-800 antialiased min-h-screen">
{{-- ========================================= --}}
{{-- TẦNG 1 : TOPBAR SEA THEME --}}
{{-- ========================================= --}}

<div class="bg-gradient-to-r from-cyan-300 via-sky-300 to-blue-300 border-b border-white/30 shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex flex-col sm:flex-row justify-between items-center gap-2">

        {{-- Hotline --}}
        <div class="flex items-center gap-2 text-sky-950 font-extrabold text-sm tracking-wide">

            <div class="w-8 h-8 rounded-full bg-white/40 backdrop-blur-md flex items-center justify-center shadow-sm animate-pulse">
                📞
            </div>

            <span>
                Hotline:
            </span>

            <span class="bg-white/50 backdrop-blur-md px-3 py-1 rounded-xl border border-white/40 shadow-sm tracking-widest">
                19006868
            </span>

        </div>

        {{-- Menu --}}
        <div class="flex items-center gap-3 text-sm font-bold text-sky-950">

            <a href="{{ route('pages.tintuc') }}"
               class="px-4 py-2 rounded-xl hover:bg-white/40 transition-all duration-300 hover:scale-105">
                📰 Tin tức
            </a>

            <a href="{{ route('pages.gioithieu') }}"
               class="px-4 py-2 rounded-xl hover:bg-white/40 transition-all duration-300 hover:scale-105">
                🌊 Giới thiệu
            </a>

            <a href="{{ route('pages.lienhe') }}"
               class="px-4 py-2 rounded-xl hover:bg-white/40 transition-all duration-300 hover:scale-105">
                📞 Liên hệ
            </a>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- TẦNG 2 : NAVBAR SEA LUXURY --}}
{{-- ========================================= --}}

<nav class="bg-gradient-to-r from-sky-50 via-cyan-50 to-blue-50 backdrop-blur-md border-b border-sky-100 sticky top-0 z-50 shadow-md">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="h-20 flex items-center justify-between">

            {{-- LOGO --}}
            <a href="/"
               class="flex items-center bg-white/70 backdrop-blur-md px-5 py-2.5 rounded-2xl border border-sky-100 shadow-sm hover:shadow-lg transition-all duration-300 hover:scale-[1.02]">

                <span class="text-2xl font-black tracking-wide text-blue-600 drop-shadow-sm">
                    HKT
                </span>

                <span class="text-2xl font-black text-orange-500 border-b-4 border-orange-400 pb-0.5 ml-1 drop-shadow-sm">
                    TRAVEL
                </span>

            </a>

            {{-- RIGHT MENU --}}
            <div class="flex items-center gap-4">

                @if (Route::has('login'))

                    @auth

                        @if(auth()->user()->role === 'admin')

                            <a href="{{ route('admin.dashboard') }}"
                               class="text-sm font-extrabold text-slate-700 hover:text-sky-600 transition">
                                Trang Admin
                            </a>

                        @elseif(auth()->user()->role === 'partner')

                            <a href="{{ route('partner.dashboard') }}"
                               class="text-sm font-extrabold text-slate-700 hover:text-sky-600 transition">
                                Trang Đối Tác
                            </a>

                        @else

                            <a href="{{ route('dashboard') }}"
                               class="text-sm font-extrabold text-slate-700 hover:text-sky-600 transition">
                                Hồ sơ của tôi
                            </a>

                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white text-sm font-bold px-5 py-2.5 rounded-xl shadow-md transition-all duration-300 hover:scale-105">
                                Đăng xuất
                            </button>

                        </form>

                    @else

                        <a href="{{ route('login') }}"
                           class="text-sm font-extrabold text-slate-700 hover:text-sky-600 transition">
                            Đăng nhập
                        </a>

                        <a href="{{ route('register') }}"
                           class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white text-sm font-black px-5 py-2.5 rounded-xl shadow-lg transition-all duration-300 hover:-translate-y-0.5 uppercase tracking-wide">
                            Đăng ký
                        </a>

                    @endauth

                @endif

            </div>

        </div>

    </div>

</nav>

{{-- II. HERO BANNER SANG TRỌNG HOÀNH TRÁNG --}}
   <div class="relative pt-32 pb-44 px-4 text-center overflow-hidden min-h-[650px] flex items-center justify-center">

    {{-- Background image --}}
    <div class="absolute inset-0 z-0 overflow-hidden">

        <div
            class="w-full h-full bg-cover bg-center scale-105 animate-bg-zoom"
            style="background-image:url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2070&auto=format&fit=crop');">
        </div>

    </div>

    {{-- Overlay biển --}}
    <div class="absolute inset-0 bg-gradient-to-b from-sky-900/50 via-cyan-700/30 to-[#ecfeff] z-10"></div>

    {{-- Nội dung --}}
    <div class="relative z-20 max-w-5xl mx-auto space-y-6">

        <span class="inline-block bg-white/20 backdrop-blur-md text-white text-xs md:text-sm font-black uppercase tracking-[4px] px-5 py-2 rounded-full border border-white/30 shadow-lg">
            🌊 Explore The World
        </span>

        <h1 class="text-4xl md:text-7xl font-black tracking-tight text-white uppercase leading-tight drop-shadow-lg">

            Khám phá thiên đường
            <span class="text-yellow-300">
                du lịch biển
            </span>

        </h1>

        <p class="text-base md:text-xl text-white/90 max-w-3xl mx-auto leading-relaxed font-medium">
            Hệ thống đặt tour, khách sạn, nghỉ dưỡng và trải nghiệm du lịch hiện đại dành cho thế hệ yêu khám phá.
        </p>

    </div>

</div>

{{-- III. KHU VỰC BỘ LỌC CHUẨN XỊN SÒ --}}
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-30">
        <div class="bg-white/80 backdrop-blur-xl p-6 md:p-8 rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.06)] border border-slate-100">
            
            {{-- Tabs Icon thiết kế --}}
            <div class="flex flex-wrap items-center justify-center gap-3 md:gap-4 mb-8 pb-6 border-b border-slate-100">
                <a href="/?category=trong_nuoc" 
                   class="flex items-center gap-2 px-5 py-3 rounded-2xl text-xs font-bold uppercase tracking-wider transition-all duration-300 {{ request('category') == 'trong_nuoc' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 scale-105' : 'bg-slate-50 text-slate-600 hover:bg-slate-100' }}">
                    🏝️ Tour Trong Nước
                </a>
                <a href="/?category=nuoc_ngoai" 
                   class="flex items-center gap-2 px-5 py-3 rounded-2xl text-xs font-bold uppercase tracking-wider transition-all duration-300 {{ request('category') == 'nuoc_ngoai' ? 'bg-rose-600 text-white shadow-lg shadow-rose-600/30 scale-105' : 'bg-slate-50 text-slate-600 hover:bg-slate-100' }}">
                    ✈️ Tour Nước Ngoài
                </a>
                <a href="/?type=hotel" 
                   class="flex items-center gap-2 px-5 py-3 rounded-2xl text-xs font-bold uppercase tracking-wider transition-all duration-300 {{ request('type') == 'hotel' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30 scale-105' : 'bg-slate-50 text-slate-600 hover:bg-slate-100' }}">
                    🏨 Khách Sạn & Resort
                </a>
                <a href="/?type=ticket" 
                   class="flex items-center gap-2 px-5 py-3 rounded-2xl text-xs font-bold uppercase tracking-wider transition-all duration-300 {{ request('type') == 'ticket' ? 'bg-amber-500 text-white shadow-lg shadow-amber-500/30 scale-105' : 'bg-slate-50 text-slate-600 hover:bg-slate-100' }}">
                    🎟️ Vé & Visa
                </a>
                <a href="/?type=car" 
                   class="flex items-center gap-2 px-5 py-3 rounded-2xl text-xs font-bold uppercase tracking-wider transition-all duration-300 {{ request('type') == 'car' ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/30 scale-105' : 'bg-slate-50 text-slate-600 hover:bg-slate-100' }}">
                    🚗 Xe Tự Lái
                </a>
            </div>

            {{-- Form tìm kiếm thông minh (ĐÃ THAY MÀU Ô ĐỊA ĐIỂM XANH NHẠT - Ô DỊCH VỤ VÀNG NHẠT CÁT BIỂN) --}}
            <form action="/" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                {{-- Ô ĐỊA ĐIỂM: XANH NHẠT MÀU NƯỚC BIỂN ĐẸP --}}
                <div class="text-left px-4 flex flex-col justify-center bg-[#e0f2fe] hover:bg-[#bae6fd] p-3.5 rounded-2xl transition border border-sky-200">
                    <label class="block text-[10px] font-bold text-sky-700 uppercase tracking-widest mb-1 select-none">📍 Địa điểm đến</label>
                    <input type="text" name="location" value="{{ request('location') }}" placeholder="Hạ Long, Phú Quốc, Sapa..." class="w-full bg-transparent focus:outline-none font-bold text-sky-950 placeholder-sky-400 py-0.5 text-sm">
                </div>
                
                {{-- Ô LOẠI HÌNH: VÀNG NHẠT VÀNG CỦA CÁT BIỂN --}}
                <div class="text-left px-4 flex flex-col justify-center bg-[#fef9c3] hover:bg-[#fef08a] p-3.5 rounded-2xl transition border border-yellow-200">
                    <label class="block text-[10px] font-bold text-yellow-700 uppercase tracking-widest mb-1 select-none">✨ Loại hình dịch vụ</label>
                    <select name="type" class="w-full bg-transparent focus:outline-none font-bold text-yellow-950 py-0.5 text-sm cursor-pointer appearance-none">
                        <option value="">Tất cả dịch vụ</option>
                        <option value="tour" {{ request('type') == 'tour' ? 'selected' : '' }}>✈️ Tour du lịch trọn gói</option>
                        <option value="hotel" {{ request('type') == 'hotel' ? 'selected' : '' }}>🏨 Khách sạn & Homestay</option>
                        <option value="car" {{ request('type') == 'car' ? 'selected' : '' }}>🚗 Thuê xe tự lái</option>
                        <option value="ticket" {{ request('type') == 'ticket' ? 'selected' : '' }}>🎟️ Vé tham quan vui chơi</option>
                    </select>
                </div>
                
                <div class="h-full flex items-center">
                    <button type="submit" class="w-full h-full py-4 px-6 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl transition shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 active:scale-[0.99] flex items-center justify-center space-x-2 uppercase text-xs tracking-widest cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.603 10.603z" />
                        </svg>
                        <span>Tìm kiếm hành trình</span>
                    </button>
                </div>
            </form>

            {{-- Đang bật bộ lọc --}}
            @if(request('location') || request('type') || request('category'))
                <div class="flex flex-wrap items-center justify-between gap-3 mt-6 text-xs text-slate-500 font-medium bg-slate-50 p-4 rounded-2xl border border-slate-100">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="font-bold text-slate-700 uppercase tracking-wider">Đang lọc theo:</span>
                        @if(request('location')) <span class="bg-white px-3 py-1 rounded-lg border border-slate-200">Vị trí: <strong class="text-blue-600">"{{ request('location') }}"</strong></span> @endif
                        @if(request('type')) <span class="bg-white px-3 py-1 rounded-lg border border-slate-200">Loại: <strong class="text-blue-600">"{{ request('type') }}"</strong></span> @endif
                        @if(request('category')) <span class="bg-white px-3 py-1 rounded-lg border border-slate-200">Tuyến: <strong class="text-blue-600">{{ request('category') == 'nuoc_ngoai' ? 'Nước Ngoài' : 'Trong Nước' }}</strong></span> @endif
                    </div>
                    <a href="/" class="bg-slate-200 hover:bg-red-500 hover:text-white text-slate-700 px-3 py-1.5 rounded-xl transition-all font-bold">Xóa bộ lọc ✕</a>
                </div>
            @endif
        </div>
    </div>

    {{-- IV. GRID SẢN PHẨM THIẾT KẾ ĐA TẦNG CAO CẤP --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 bg-gradient-to-b from-transparent to-cyan-50/50">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-4 rounded-2xl mb-8 text-center font-bold shadow-sm max-w-2xl mx-auto">
                ✨ {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-end mb-10 border-b border-slate-200/60 pb-5">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight uppercase">
                    ✨ Đề xuất hành trình dành cho bạn
                </h2>
                <p class="text-slate-400 text-xs mt-1 font-medium">Danh sách dịch vụ được tuyển chọn và cập nhật liên tục</p>
            </div>
            <span class="text-xs font-bold text-blue-600 bg-blue-50 px-4 py-1.5 rounded-full uppercase tracking-wider">Mùa du lịch 2026</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($services as $service)
                <div class="bg-white rounded-[24px] shadow-[0_10px_40px_rgba(14,165,233,0.08)] hover:shadow-[0_25px_60px_rgba(14,165,233,0.18)] border border-slate-100 overflow-hidden transition-all duration-300 flex flex-col justify-between group transform hover:-translate-y-1">
                    <div>
                        {{-- Khung Ảnh Tỉ Lệ Chuẩn --}}
                        <div class="relative overflow-hidden aspect-[16/10] bg-slate-100">
                            @if($service->image)
                                <img src="{{ Str::startsWith($service->image, ['http://', 'https://']) ? $service->image : asset($service->image) }}" class="h-full w-full object-cover group-hover:scale-105 transition duration-500 pointer-events-none select-none">
                            @else
                                <div class="h-full w-full bg-slate-100 flex items-center justify-center text-slate-400 text-xs font-semibold">Không có hình ảnh</div>
                            @endif
                            
                            {{-- Vị trí gắn tag --}}
                            <span class="absolute top-4 left-4 bg-slate-950/70 backdrop-blur-md text-white text-[10px] px-3 py-1.5 rounded-xl font-bold tracking-wider shadow-sm">
                                📍 {{ $service->location }}
                            </span>

                            {{-- Tự động hiển thị tag phân loại xịn sò --}}
                            <span class="absolute top-4 right-4 text-[10px] px-3 py-1.5 rounded-xl font-extrabold tracking-wider uppercase shadow-md
                                @if($service->category === 'trong_nuoc') bg-blue-500 text-white
                                @elseif($service->category === 'nuoc_ngoai') bg-rose-500 text-white
                                @elseif($service->category === 'hotel') bg-emerald-500 text-white
                                @elseif($service->category === 'ticket') bg-amber-500 text-white
                                @else bg-purple-500 text-white
                                @endif">
                                @if($service->category === 'trong_nuoc') Tour Nội Địa
                                @elseif($service->category === 'nuoc_ngoai') Tour Quốc Tế
                                @elseif($service->category === 'hotel') 🏨 Khách Sạn
                                @elseif($service->category === 'ticket') 🎟️ Vé Tham Quan
                                @else 🚗 Xe Tự Lái
                                @endif
                            </span>
                        </div>

                       {{-- Nội Dung Card --}}
<div class="p-6 space-y-4 bg-gradient-to-b from-white to-sky-50/40">

    {{-- TIÊU ĐỀ --}}
    <h3 
        class="font-extrabold text-base md:text-lg text-slate-800 line-clamp-2 leading-snug 
               group-hover:text-sky-600 transition duration-300 h-[56px]"
        title="{{ $service->title }}"
    >
        {{ $service->title }}
    </h3>

    {{-- ĐÁNH GIÁ --}}
    <div class="flex items-center gap-2 text-xs font-bold text-left">
        @php 
            $avgRating = round($service->averageRating(), 1); 
            $approvedCount = $service->reviews 
                ? $service->reviews->where('is_approved', 1)->count() 
                : 0;
        @endphp
        
        @if($avgRating > 0)

            <div class="flex items-center bg-gradient-to-r from-yellow-100 to-amber-100 
                        text-amber-700 px-3 py-1 rounded-xl border border-amber-200 shadow-sm">
                <span>⭐</span>

                <span class="ml-1 font-extrabold text-slate-700">
                    {{ $avgRating }}
                </span>
            </div>

            <span class="text-slate-500 font-semibold">
                ({{ $approvedCount }} đánh giá)
            </span>

        @else

            <span class="text-slate-500 font-medium italic 
                         bg-slate-100 px-3 py-1 rounded-xl border border-slate-200">
                Chưa có đánh giá
            </span>

        @endif
    </div>

    {{-- MÔ TẢ --}}
    <p class="text-slate-600 text-xs line-clamp-2 leading-relaxed min-h-[42px]">
        {!! strip_tags($service->description) !!}
    </p>

    {{-- TAG MINI --}}
    <div class="flex items-center gap-2 pt-1 flex-wrap">

        <span class="bg-sky-100 text-sky-700 text-[10px] 
                     px-3 py-1 rounded-full font-bold tracking-wide">
            🌊 Du lịch biển
        </span>

        <span class="bg-cyan-100 text-cyan-700 text-[10px] 
                     px-3 py-1 rounded-full font-bold tracking-wide">
            ✈️ Premium Tour
        </span>

    </div>

</div> {{-- ĐÓNG CARD CONTENT --}}

</div> {{-- ĐÓNG DIV TRÊN CÙNG --}}
                    {{-- Phần Giá và Nút Bấm cuối card --}}
                    <div class="p-6 pt-4 border-t border-slate-50 bg-slate-50/40">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Giá tham khảo</span>
                            <span class="text-lg font-black text-red-500">{{ number_format($service->price) }} <span class="text-xs font-bold">đ</span></span>
                        </div>

                        <a href="{{ route('services.show', $service->id) }}" class="block text-center w-full bg-slate-900 hover:bg-blue-600 text-white font-bold py-3.5 px-4 rounded-xl text-xs transition-all duration-300 uppercase tracking-widest shadow-sm">
                            Xem chi tiết dịch vụ
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-gradient-to-br from-cyan-50 to-sky-100 rounded-[24px] border border-dashed border-slate-200 p-8 shadow-sm">
                    <div class="text-4xl mb-3">🌊</div>
                    <div class="text-slate-700 font-bold text-base">Không tìm thấy dịch vụ du lịch phù hợp.</div>
                    <p class="text-slate-400 text-xs mt-1">Vui lòng thử lại với địa điểm khác hoặc bấm nút xóa bộ lọc phía trên ông nhé.</p>
                </div>
            @endforelse
        </div>
    </main>

  {{{-- FOOTER SEA THEME TƯƠI SÁNG --}}
<footer class="bg-gradient-to-br from-cyan-400 via-sky-500 to-blue-500 text-white pt-16 pb-8 relative overflow-hidden">

    {{-- Background bubbles --}}
    <div class="absolute inset-0 overflow-hidden opacity-20 pointer-events-none">
        <div class="absolute -top-10 -left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-200 rounded-full blur-3xl"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">

        {{-- GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-white/20">

            {{-- LOGO --}}
            <div class="space-y-5">

                <div class="text-3xl font-black tracking-wider">
                    <span class="text-white drop-shadow">
                        HKT
                    </span>

                    <span class="text-yellow-200 border-b-4 border-yellow-200 pb-1">
                        TRAVEL
                    </span>
                </div>

                <p class="text-sm leading-relaxed text-white/90">
                    HKT TRAVEL mang đến trải nghiệm du lịch hiện đại,
                    trẻ trung và tiện lợi với hệ thống đặt tour,
                    khách sạn và nghỉ dưỡng thông minh.
                </p>

                <div class="flex gap-3 pt-2">

                    <div class="w-11 h-11 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center hover:bg-white hover:text-sky-600 transition-all duration-300 cursor-pointer text-lg shadow-lg">
                        🌍
                    </div>

                    <div class="w-11 h-11 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center hover:bg-white hover:text-sky-600 transition-all duration-300 cursor-pointer text-lg shadow-lg">
                        ✈️
                    </div>

                    <div class="w-11 h-11 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center hover:bg-white hover:text-sky-600 transition-all duration-300 cursor-pointer text-lg shadow-lg">
                        🏖️
                    </div>

                </div>

            </div>

            {{-- DỊCH VỤ --}}
            <div>

                <h4 class="text-white font-extrabold uppercase tracking-widest text-sm mb-5">
                    Dịch vụ
                </h4>

                <ul class="space-y-3 text-sm text-white/90">

                    <li class="hover:text-yellow-200 transition cursor-pointer">
                        ✈️ Tour trong nước
                    </li>

                    <li class="hover:text-yellow-200 transition cursor-pointer">
                        🌏 Tour quốc tế
                    </li>

                    <li class="hover:text-yellow-200 transition cursor-pointer">
                        🏨 Resort & khách sạn
                    </li>

                    <li class="hover:text-yellow-200 transition cursor-pointer">
                        🚗 Thuê xe du lịch
                    </li>

                    <li class="hover:text-yellow-200 transition cursor-pointer">
                        🎟️ Vé tham quan
                    </li>

                </ul>

            </div>

            {{-- THÔNG TIN --}}
            <div>

                <h4 class="text-white font-extrabold uppercase tracking-widest text-sm mb-5">
                    Thông tin
                </h4>

                <ul class="space-y-3 text-sm text-white/90">

                    <li class="hover:text-yellow-200 transition cursor-pointer">
                        📰 Tin tức du lịch
                    </li>

                    <li class="hover:text-yellow-200 transition cursor-pointer">
                        🔒 Chính sách bảo mật
                    </li>

                    <li class="hover:text-yellow-200 transition cursor-pointer">
                        💳 Thanh toán online
                    </li>

                    <li class="hover:text-yellow-200 transition cursor-pointer">
                        📑 Điều khoản dịch vụ
                    </li>

                    <li class="hover:text-yellow-200 transition cursor-pointer">
                        🤝 Hợp tác doanh nghiệp
                    </li>

                </ul>

            </div>

            {{-- LIÊN HỆ --}}
            <div>

                <h4 class="text-white font-extrabold uppercase tracking-widest text-sm mb-5">
                    Liên hệ
                </h4>

                <div class="space-y-4 text-sm text-white/90 leading-relaxed">

                    <p>
                        📍 Phenikaa Tower, Hà Đông, Hà Nội
                    </p>

                    <p>
                        📞 Hotline: 1900 6868
                    </p>

                    <p>
                        📧 support@hkttravel.vn
                    </p>

                    <p>
                        🕒 Hỗ trợ khách hàng 24/7
                    </p>

                </div>

            </div>

        </div>

        {{-- BOTTOM --}}
        <div class="pt-8 text-center space-y-3">

            <p class="text-sm italic text-white/90">
                “Explore The World — Trải nghiệm hành trình tuyệt vời cùng HKT TRAVEL.”
            </p>

            <p class="text-[11px] uppercase tracking-[3px] text-white/70 font-bold">
                © 2026 HKT TRAVEL — PHENIKAA UNIVERSITY
            </p>

        </div>

    </div>

</footer>

</body>
</html>