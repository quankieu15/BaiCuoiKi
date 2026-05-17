<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Tour Du Lịch & Khách Sạn - HKT TRAVEL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        @keyframes kenBurns {
            0% {
                transform: scale(1) translate(0, 0);
            }
            50% {
                transform: scale(1.08) translate(-0.5%, -0.5%);
            }
            100% {
                transform: scale(1) translate(0, 0);
            }
        }
        .animate-bg-zoom {
            animation: kenBurns 25s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 font-sans">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center py-2">
    <a href="/" class="text-2xl tracking-wider font-sans select-none flex items-center group">
        <span class="font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 drop-shadow-sm transition-all duration-300 group-hover:from-blue-700 group-hover:to-indigo-700">HKT</span>
        <span class="font-black text-orange-500 ml-1.5 relative pb-0.5 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-full after:h-[3px] after:bg-orange-500 after:rounded-full after:transition-all after:duration-300 group-hover:text-orange-600 group-hover:after:bg-orange-600">TRAVEL</span>
    </a>
</div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600">Vào Trang Admin</a>
                            @elseif(auth()->user()->role === 'partner')
                                <a href="{{ route('partner.dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600">Vào Trang Đối Tác</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600">Hồ Sơ Của Tôi</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm font-semibold text-red-500 hover:text-red-700">Đăng xuất</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600">Đăng nhập</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-md shadow">Đăng ký</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="relative py-28 px-4 text-center overflow-hidden min-h-[480px] flex items-center justify-center">
        
        <div class="absolute inset-0 z-0 overflow-hidden">
            <div class="w-full h-full bg-cover bg-center animate-bg-zoom transform" 
                 style="background-image: url('https://file.hstatic.net/200000851795/article/du-lich-viet-nam_a5b5777f771c44a89aee7f59151e7f95.jpg');">
            </div>
        </div>
        
        <div class="absolute inset-0 bg-slate-900/50 z-10 backdrop-blur-[1px]"></div>

        <div class="relative z-20 max-w-4xl mx-auto space-y-6 w-full">
           <h1 class="text-4xl md:text-6xl font-black tracking-tight text-white drop-shadow-[0_4px_8px_rgba(0,0,0,0.5)]">
    Chào mừng đến với <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-teal-300">HKT</span> <span class="text-orange-400">TRAVEL</span>
</h1>
            <p class="text-base md:text-xl text-gray-200 max-w-2xl mx-auto font-medium drop-shadow-sm">
                Tìm kiếm các tour du lịch trọn gói và phòng khách sạn giá tốt nhất dành cho chuyến đi của bạn
            </p>
            
            <div class="bg-white p-4 rounded-2xl shadow-2xl text-gray-800 max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-4 border border-gray-100 mt-8">
    
    <div class="text-left px-3 flex flex-col justify-center group relative">
        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5 flex items-center gap-1">
            📍 Địa điểm đến
        </label>
        <input type="text" name="search" placeholder="Hạ Long, Sapa, Đà Nẵng..." class="w-full bg-transparent focus:outline-none font-bold text-gray-700 placeholder-gray-400 py-1 text-sm border-b border-transparent focus:border-blue-500 transition">
    </div>
    
    <div class="text-left px-4 border-t md:border-t-0 md:border-l border-gray-200 pt-3 md:pt-0 flex flex-col justify-center">
        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5 flex items-center gap-1">
            ✨ Bạn muốn đặt gì?
        </label>
        <select name="type" class="w-full bg-transparent focus:outline-none font-bold text-gray-700 py-1 text-sm cursor-pointer border-b border-transparent focus:border-blue-500 transition">
            <option value="">Tất cả dịch vụ</option>
            <option value="tour">✈️ Tour du lịch trọn gói</option>
            <option value="hotel">🏨 Khách sạn & Khu nghỉ dưỡng</option>
            <option value="homestay">🏡 Homestay / Villa nguyên căn</option>
        </select>
    </div>
    
    <div class="flex items-center pt-2 md:pt-0 pl-2">
        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-extrabold py-3.5 px-6 rounded-xl transition shadow-md active:scale-[0.98] flex items-center justify-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.603 10.603z" />
            </svg>
            <span class="tracking-wide">Tìm kiếm ngay</span>
        </button>
    </div>
    
</div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-xl transition shadow-md whitespace-nowrap w-full md:w-auto">
                        Tìm kiếm
                    </button>
                </form>

                @if(request('search') || request('price_range'))
                    <p class="text-sm text-gray-200 mt-4 bg-slate-900/60 inline-block px-4 py-1.5 rounded-full backdrop-blur-md border border-white/10 shadow-sm">
                        <div class="flex flex-wrap items-center gap-3 bg-gray-100/80 p-3.5 rounded-2xl border border-gray-200/60 max-w-7xl mx-auto my-6 px-5 shadow-sm">
    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider flex items-center gap-1.5 animate-pulse">
        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span> Đang lọc theo:
    </span>
    
    <div class="flex items-center gap-2 bg-white border border-gray-200 shadow-sm px-3 py-1.5 rounded-xl text-sm font-medium text-gray-700 transition hover:border-gray-300">
        <span class="text-gray-400">Từ khóa:</span> 
        <span class="text-orange-500 font-bold">"2000000"</span>
    </div>

    <a href="/" class="ml-auto flex items-center gap-1.5 bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 font-bold text-xs py-2 px-3.5 rounded-xl transition shadow-sm border border-red-100">
        <span>Xóa bộ lọc</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </a>
</div>
                    </p>
                @endif
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 text-center font-semibold shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 text-center font-semibold shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="text-2xl font-extrabold mb-8 text-gray-900 tracking-tight flex items-center gap-2">
            <span></span> Dịch vụ du lịch nổi bật cập nhật mới nhất
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($services as $service)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="relative overflow-hidden aspect-video bg-gray-100">
                            @if($service->image)
                                <img src="{{ asset($service->image) }}" class="h-full w-full object-cover group-hover:scale-105 transition duration-500 animate-fade-in">
                            @else
                                <div class="h-full w-full bg-gray-200 flex items-center justify-center text-gray-400 text-sm font-medium">Không có hình ảnh</div>
                            @endif
                            <span class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-gray-900 text-xs px-2.5 py-1 rounded-full font-bold shadow-sm">
                                 {{ $service->location }}
                            </span>
                        </div>

                        <div class="p-5 space-y-2">
                            <h3 class="font-extrabold text-lg text-gray-900 line-clamp-2 leading-snug group-hover:text-blue-600 transition" title="{{ $service->title }}">
                                {{ $service->title }}
                            </h3>
                            <p class="text-gray-500 text-sm line-clamp-3 leading-relaxed">
                                {{ $service->description }}
                            </p>
                        </div>
                    </div>

                    <div class="p-5 pt-4 border-t border-gray-50 bg-gray-50/50">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-xs text-gray-400 font-medium">Giá trọn gói từ</span>
                            <span class="text-xl font-black text-red-500">{{ number_format($service->price) }} đ</span>
                        </div>

                        <a href="{{ route('services.show', $service->id) }}" class="block text-center w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-xl text-sm transition-all shadow-sm shadow-blue-200">
                            Xem chi tiết lịch trình
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-white rounded-2xl border border-dashed border-gray-300 p-8">
                    <div class="text-4xl mb-3">🍃</div>
                    <div class="text-gray-500 font-medium text-lg">Không tìm thấy dịch vụ du lịch phù hợp.</div>
                    <p class="text-gray-400 text-sm mt-1">Vui lòng thử lại với từ khóa khác hoặc điều chỉnh bộ lọc mức giá.</p>
                </div>
            @endforelse
        </div>
    </main>

   <footer class="bg-gray-100 text-gray-600 py-12 text-center border-t border-gray-200/80 relative w-full mt-24">
        <div class="max-w-4xl mx-auto px-6 space-y-4">
            
            <div class="text-2xl animate-bounce inline-block opacity-80">✈️</div>
            
            <p class="text-base md:text-lg text-gray-700 italic font-medium leading-relaxed max-w-2xl mx-auto tracking-wide">
                "Đừng để những lo toan giữ chân bạn. Thế giới ngoài kia có muôn vàn điều kỳ diệu đang chờ đón. Đi thôi, ngại ngần chi!"
            </p>
            
            <div class="w-12 h-[1px] bg-gray-300 mx-auto my-3"></div>
            
            <div class="space-y-1">
                <p class="font-black text-gray-400 text-sm tracking-widest uppercase flex items-center justify-center gap-1">
                    <span class="text-slate-600">HKT</span> <span class="text-gray-600">TRAVEL SYSTEM</span>
                </p>
                <p class="text-xs text-gray-400 font-medium">
                    © 2026 HKT TRAVEL. Nền tảng đặt tour trực tuyến hàng đầu của bạn.
                </p>
            </div>
            
        </div>
    </footer>

</body>
</html>