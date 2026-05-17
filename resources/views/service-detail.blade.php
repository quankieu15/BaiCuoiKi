<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service->title }} - HKT TRAVEL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* CSS Layout 3 cột cố định bằng Flexbox */
        .hkt-main-container {
            display: flex;
            flex-wrap: wrap;
            gap: 28px;
            width: 100%;
            padding: 0 32px;
            box-sizing: border-box;
        }
        .hkt-col-left {
            flex: 0 0 calc(30% - 19px);
            max-width: calc(30% - 19px);
        }
        .hkt-col-center {
            flex: 0 0 calc(42% - 19px);
            max-width: calc(42% - 19px);
        }
        .hkt-col-right {
            flex: 0 0 calc(28% - 19px);
            max-width: calc(28% - 19px);
        }

        @media (max-width: 1024px) {
            .hkt-col-left, .hkt-col-center, .hkt-col-right {
                flex: 0 0 100% !important;
                max-width: 100% !important;
            }
        }

        /* Nghệ thuật Timeline Lịch trình */
        .tour-schedule h4 {
            font-size: 1.1rem;
            font-weight: 800;
            color: #0f172a;
            margin-top: 1.75rem;
            margin-bottom: 1rem;
            padding-left: 0.85rem;
            border-left: 4px solid #f97316;
        }
        .tour-schedule ul {
            list-style-type: none;
            padding-left: 0;
            margin-bottom: 1.5rem;
            position: relative;
        }
        .tour-schedule ul::after {
            content: "";
            position: absolute;
            left: 28px;
            top: 10px;
            bottom: 10px;
            width: 2px;
            background: #e2e8f0;
            z-index: 1;
        }
        .tour-schedule li {
            position: relative;
            padding-left: 4.5rem;
            margin-bottom: 1rem;
            line-height: 1.6;
            color: #475569;
            font-size: 0.925rem;
        }
        .tour-schedule li b {
            position: absolute;
            left: 0;
            top: 2px;
            width: 55px;
            text-align: center;
            background: #f1f5f9;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 2px 0;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            z-index: 2;
        }
        .tour-schedule li:first-child b {
            background: #fff7ed;
            color: #ea580c;
            border-color: #ffedd5;
        }
        
        .tour-schedule .day-title {
            margin-top: 2rem;
            margin-bottom: 1.25rem;
            color: #ffffff;
            font-weight: 800;
            font-size: 0.95rem;
            background: linear-gradient(135deg, #ea580c, #f97316);
            padding: 0.6rem 1.25rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(234, 88, 12, 0.15);
            display: inline-block;
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    <header class="sticky top-0 z-50 backdrop-blur-xl bg-white/80 border-b border-white/20 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
    <div class="w-full px-8 py-4 flex items-center justify-between">

        <!-- LOGO -->
        <a href="/" class="group flex items-center gap-4">

            <div class="relative">
                <div class="absolute inset-0 bg-orange-500 blur-xl opacity-20 group-hover:opacity-40 transition duration-500 rounded-full"></div>

                <div class="relative w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-500 via-amber-500 to-yellow-400 flex items-center justify-center shadow-lg shadow-orange-500/20 group-hover:scale-110 group-hover:rotate-6 transition duration-500">
                    
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2.2"
                        stroke="currentColor"
                        class="w-7 h-7 text-white">
                        
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.25 19.5 9 12.75m0 0 2.25 2.25L15 11.25m-6 1.5V6.75m0 6h6.75m0 0L21.75 6"/>
                    </svg>

                </div>
            </div>

            <div class="flex flex-col leading-none">

                <h1 class="text-2xl font-black tracking-tight text-slate-900">
                    HKT 
                    <span class="bg-gradient-to-r from-orange-500 to-amber-500 bg-clip-text text-transparent">
                        TRAVEL
                    </span>
                </h1>

                <span class="text-[10px] uppercase tracking-[0.35em] text-slate-400 font-bold mt-1">
                    Luxury Travel Platform
                </span>

            </div>
        </a>

        <!-- BUTTON -->
       <a href="/"
class="flex items-center gap-2 px-5 py-3 rounded-2xl 
bg-slate-900 hover:bg-orange-500 
text-black font-bold text-xs uppercase tracking-widest 
shadow-lg transition-all duration-300">

    <svg xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="2.5"
        stroke="currentColor"
        class="w-4 h-4">

        <path stroke-linecap="round"
            stroke-linejoin="round"
            d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
    </svg>

    <span class="text-black">
        Quay lại trang chủ
    </span>

</a>

    </div>
</header>

    <main class="w-full flex-grow mb-16">
        <div class="hkt-main-container">
            
            <div class="hkt-col-left space-y-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                    <div class="flex items-center gap-1.5 text-xs font-bold text-orange-600 bg-orange-50 px-3 py-1.5 rounded-lg w-fit border border-orange-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        {{ $service->location }}
                    </div>
                    
                    <h1 class="text-xl md:text-2xl font-black text-slate-900 leading-snug tracking-tight">
                        {{ $service->title }}
                    </h1>
                    
                    <div class="flex items-center gap-2 border-t border-slate-50 pt-3 text-[11px] text-slate-400 font-medium">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                        <span>Đại lý chính thức của HKT Travel</span>
                    </div>
                </div>

                <div class="w-full h-[300px] md:h-[360px] overflow-hidden rounded-2xl shadow-md border border-slate-200/60 bg-slate-100 group">
                    @if($service->image)
                        <img src="{{ Str::startsWith($service->image, ['http://', 'https://']) ? $service->image : asset($service->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-out" alt="{{ $service->title }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e" class="w-full h-full object-cover" alt="Default image">
                    @endif
                </div>
            </div>

            <div class="hkt-col-center bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100">
                <h3 class="text-base font-black text-slate-900 border-b border-slate-100 pb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-orange-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.03 0 1.9.693 2.166 1.638m-7.377 0A48.536 48.536 0 0 1 12 3m0 0c2.917 0 5.747.294 8.5.862m-8.5-.862A48.394 48.394 0 0 0 3.81 5.41a1.98 1.98 0 0 0-1.56 1.96V18.75A2.25 2.25 0 0 0 4.5 21h8.25" />
                    </svg>
                    Kế Hoạch & Hành Trình Trải Nghiệm Chi Tiết
                </h3>

                @if($service->description)
                    <div class="tour-schedule">
                        <h4>Sơ lược điểm sáng giá</h4>
                        <ul class="!after:hidden">
                            <li class="!pl-6"><b class="!hidden">•</b> ✨ <b>Phương tiện:</b> Xe du lịch Limousine đưa đón cao cấp đời mới.</li>
                            <li class="!pl-6"><b class="!hidden">•</b> ✨ <b>Lưu trú:</b> Resort/Khách sạn tiêu chuẩn 4-5 sao ưu đãi liên kết.</li>
                            <li class="!pl-6"><b class="!hidden">•</b> ✨ <b>Ẩm thực:</b> Menu đặc sản vùng miền, buffet hải sản thượng hạng.</li>
                        </ul>

                        <div class="day-title">HÀNH TRÌNH NGÀY 1: KHỞI HÀNH & NGHỈ DƯỠNG</div>
                        <ul>
                            <li><b>Buổi Sáng</b> Xe đón quý khách tại điểm hẹn khởi hành, đoàn giao lưu trò chơi hoạt náo viên náo nhiệt.</li>
                            <li><b>Buổi Trưa</b> Thưởng thức bữa trưa đậm đà bản sắc, sau đó làm thủ tục check-in nhận phòng khách sạn.</li>
                            <li><b>Buổi Chiều</b> Tự do check-in các địa điểm danh lam nổi tiếng xung quanh khu nghỉ dưỡng.</li>
                        </ul>

                        <div class="day-title">HÀNH TRÌNH NGÀY 2: KHÁM PHÁ KỲ QUAN THIÊN NHIÊN</div>
                        <ul>
                            <li><b>Buổi Sáng</b> Thưởng thức điểm tâm sáng, khởi hành đi tham quan chuỗi kỳ quan thắng cảnh độc đáo.</li>
                            <li><b>Buổi Trưa</b> Bữa trưa đại tiệc hải sản tươi sống vô cùng chất lượng ngay tại nhà hàng view biển.</li>
                            <li><b>Buổi Chiều</b> Trải nghiệm chèo thuyền kayak mạo hiểm, tắm biển hoang sơ, teambuilding gắn kết.</li>
                        </ul>

                        <div class="day-title">HÀNH TRÌNH NGÀY 3: ĐÓN BÌNH MINH - MUA SẮM QUÀ LƯU NIỆM</div>
                        <ul>
                            <li><b>Buổi Sáng</b> Dậy sớm đón bình minh tuyệt đẹp, dạo chợ hải sản mua quà lưu niệm cho người thân.</li>
                            <li><b>Buổi Trưa</b> Ăn trưa nhẹ nhàng, làm thủ tục trả phòng (Check-out) khách sạn theo quy định.</li>
                            <li><b>Buổi Chiều</b> Xe đưa đoàn trở về điểm đón ban đầu an toàn. Hẹn gặp lại quý khách!</li>
                        </ul>
                    </div>
                @else
                    <div class="text-center py-12 text-slate-400">
                        <p class="text-sm italic">Hệ thống đang đồng bộ dữ liệu lịch trình...</p>
                    </div>
                @endif
            </div>

            <div class="hkt-col-right space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 space-y-5 relative overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-[4px] bg-gradient-to-r from-orange-500 to-amber-500"></div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Chi phí trọn gói</span>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-black text-red-500 tracking-tight">{{ number_format($service->price) }} ₫</span>
                            <span class="text-xs font-bold text-slate-400">/ hành khách</span>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 pt-4">
                        @auth
                            @if(auth()->user()->role === 'customer')
                                <form action="{{ route('services.book', $service->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Số lượng người tham gia:</label>
                                        <input type="number" name="quantity" min="1" value="1" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sm focus:outline-none focus:border-orange-500 transition">
                                    </div>
                                    <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-amber-500 text-white font-black py-3.5 px-4 rounded-xl text-center text-xs uppercase tracking-wider shadow-md shadow-orange-500/10 transition transform active:scale-[0.98]">
                                        Xác nhận đặt tour ngay
                                    </button>
                                </form>
                            @else
                                <div class="bg-slate-50 border border-slate-100 p-3.5 rounded-xl text-center text-[11px] text-slate-400 font-bold uppercase tracking-wide">
                                    Chức năng dành cho tài khoản khách hàng.
                                </div>
                            @endif
                        @else
                            <div class="space-y-3">
                                <p class="text-xs font-medium text-slate-400 text-center leading-relaxed">Bạn cần đăng nhập tài khoản thành viên để đặt lịch hành trình này.</p>
                                <a href="{{ route('login') }}" class="block w-full bg-slate-900 text-white font-bold py-3 px-4 rounded-xl text-center text-xs uppercase tracking-widest transition-colors shadow-sm">
                                    Đăng nhập hệ thống
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 space-y-3">
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest flex items-center gap-1.5">Mã khuyến mãi áp dụng</h4>
                    <div class="p-3 bg-gradient-to-br from-orange-500/5 to-amber-500/5 border border-dashed border-orange-200 rounded-xl flex items-center justify-between gap-2">
                        <div>
                            <p class="text-xs font-black text-orange-600 tracking-wide">HKTNEWMEMBER</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">Tặng ngay 100k vào tài khoản</p>
                        </div>
                        <button onclick="alert('Đã lưu mã khuyến mãi thành công!')" class="bg-orange-500 text-white font-bold text-[10px] px-3 py-2 rounded-lg transition-colors shadow-sm flex-shrink-0">
                            Nhận mã
                        </button>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 space-y-4">
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest border-b border-slate-100 pb-2.5">Đối tác lưu trú liên kết</h4>
                    @if($service->hotel)
                        <div class="group block cursor-pointer">
                            <div class="w-full h-32 overflow-hidden rounded-xl border border-slate-100 bg-slate-50 mb-3">
                                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover" alt="{{ $service->hotel->name }}">
                            </div>
                            <div class="space-y-0.5">
                                <h5 class="text-xs font-black text-slate-900 group-hover:text-orange-500 transition-colors truncate">{{ $service->hotel->name }}</h5>
                                <p class="text-[10px] text-slate-400 flex items-center gap-0.5 truncate">📍 {{ $service->hotel->address ?? $service->hotel->location }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-xs text-slate-400 italic py-2 text-center">Phương án lưu trú đang được sắp xếp...</p>
                    @endif
                </div>
            </div>

        </div>
    </main>

    <footer class="bg-slate-900 text-slate-400 py-10 text-center border-t border-slate-800 w-full">
        <div class="max-w-4xl mx-auto px-6 space-y-3">
            <p class="text-xs md:text-sm text-slate-400 italic font-medium max-w-xl mx-auto leading-relaxed">
                "Đừng để những lo toan giữ chân bạn. Thế giới ngoài kia có muôn vàn điều kỳ diệu đang chờ đón."
            </p>
            <div class="w-6 h-[1px] bg-slate-800 mx-auto my-2"></div>
            <div class="space-y-0.5">
                <p class="font-black text-slate-500 text-[9px] tracking-widest uppercase">HKT TRAVEL SYSTEM</p>
                <p class="text-[9px] text-slate-600 font-medium">© 2026 HKT TRAVEL. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>