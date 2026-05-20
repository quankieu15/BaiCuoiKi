<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng Điều Khiển Đối Tác - HKT TRAVEL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-cyan-50 via-sky-50 to-blue-100 text-slate-900 antialiased min-h-screen">

    <div class="flex min-h-screen">
        
        {{-- ================= SIDEBAR (SUPREME STYLE) ================= --}}
        <aside class="w-64 bg-gradient-to-b from-sky-600 via-cyan-600 to-blue-700 text-gray-300 flex flex-col fixed h-full z-50 shadow-xl">
            <div class="p-5 flex items-center bg-white/10 backdrop-blur-md border-b border-white/10">
                <span class="text-xl font-extrabold tracking-wider text-white">
                    <span class="text-blue-500">HKT</span> <span class="text-orange-500">TRAVEL</span>
                </span>
                <span class="ml-2 px-3 py-1 text-[10px] bg-white text-sky-700 rounded-md font-bold uppercase tracking-wider">Partner</span>
            </div>

            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <p class="text-xs font-bold text-white/60 uppercase tracking-wider px-3 mb-2">Kênh Nhà Cung Cấp</p>
                
                <a href="/" class="text-white/80 hover:text-white hover:bg-white/20 px-3 py-2.5 rounded-xl transition flex items-center gap-3 text-xs font-bold">
                    <i class="fa-solid fa-house w-5 text-center text-white/80"></i> Xem Trang Chủ
                </a>
                
                <a href="{{ route('partner.dashboard') }}" class="bg-white text-sky-700 shadow-xl px-3 py-2.5 rounded-xl flex items-center gap-3 text-xs font-bold shadow-md shadow-blue-900/30">
                    <i class="fa-solid fa-chart-pie w-5 text-center text-sky-700"></i> Tổng quan Partner
                </a>
                
                <a href="{{ route('partner.services.index') }}" class="text-white/80 hover:text-white hover:bg-white/20 px-3 py-2.5 rounded-xl transition flex items-center gap-3 text-xs font-bold">
                    <i class="fa-solid fa-suitcase-rolling w-5 text-center text-white/80"></i> Quản lý dịch vụ
                </a>

                <a href="{{ route('partner.orders.index') }}" class="text-white/80 hover:text-white hover:bg-white/20 px-3 py-2.5 rounded-xl transition flex items-center gap-3 text-xs font-bold">
                    <i class="fa-solid fa-clipboard-list w-5 text-center text-white/80"></i> Đơn đặt lịch đổ về
                </a>
                
                <a href="{{ route('partner.feedbacks.index') }}" class="text-white/80 hover:text-white hover:bg-white/20 px-3 py-2.5 rounded-xl transition flex items-center gap-3 text-xs font-bold">
                    <i class="fa-solid fa-envelope-open-text w-5 text-center text-white/80"></i> Hòm thư phản hồi
                </a>
            </nav>

            <div class="p-4 border-t border-white/10 bg-white/5 backdrop-blur-md">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-white/80 hover:text-rose-300 px-3 py-2 rounded-xl transition flex items-center gap-2.5 text-xs font-bold">
                        <i class="fa-solid fa-right-from-bracket w-4"></i> Đăng xuất
                    </button>
                </form>
            </div>
        </aside>

        {{-- ================= MAIN CONTENT ================= --}}
        <main class="flex-1 pl-64 min-h-screen">
            
            {{-- Header (Glassmorphism) --}}
            <header class="h-16 bg-white/70 backdrop-blur-xl border-b border-white/40 flex items-center justify-between px-8 sticky top-0 z-40 shadow-sm">
                <h1 class="text-xs font-bold text-slate-700 tracking-wide uppercase">Trung tâm quản lý dịch vụ nhà cung cấp chính thức</h1>
                <div class="text-[10px] font-extrabold uppercase tracking-widest text-sky-700 bg-white/80 px-3 py-1.5 rounded-lg border border-white/40 shadow-inner flex items-center gap-1.5">
                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-sky-500 animate-pulse"></span> Đối tác chiến lược
                </div>
            </header>

            {{-- Page Body --}}
            <div class="p-8 space-y-6">
                
                {{-- Info Block --}}
                <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl border border-white/50 shadow-lg">
                    <div class="flex items-center gap-2 text-[10px] font-extrabold text-blue-600 uppercase tracking-wider mb-1">
                        <span>🤝 KÊNH NHÀ CUNG CẤP</span>
                    </div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight flex items-center gap-2">
                        🚀 Xin chào, {{ auth()->user()->name }}!
                    </h2>
                    <p class="text-xs text-slate-500 mt-1 font-semibold leading-relaxed">Chào mừng bạn đến với hệ thống quản lý và tối ưu hóa dành cho đối tác cung cấp dịch vụ du lịch.</p>
                </div>

                {{-- Stats Widgets --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    
                    {{-- Widget 1 --}}
                    <div class="bg-white/80 backdrop-blur-xl p-5 rounded-3xl border border-white/50 shadow-lg flex items-center justify-between group hover:border-orange-500/30 transition-all duration-300">
                        <div class="space-y-1">
                            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Tổng doanh thu nhận về</p>
                            <p class="text-2xl font-black text-orange-600 font-mono tracking-tight">
                                {{ number_format($totalRevenue ?? 0) }}đ
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center text-xl font-bold shadow-sm group-hover:scale-110 transition-transform">
                            💰
                        </div>
                    </div>

                    {{-- Widget 2 --}}
                    <div class="bg-white/80 backdrop-blur-xl p-5 rounded-3xl border border-white/50 shadow-lg flex items-center justify-between group hover:border-amber-500/30 transition-all duration-300">
                        <div class="space-y-1">
                            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Đơn đặt lịch chờ duyệt</p>
                            <p class="text-2xl font-black text-slate-800 font-mono tracking-tight">
                                {{ $pendingOrders ?? 0 }} <span class="text-xs font-bold text-slate-400 uppercase">Đơn</span>
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold shadow-sm group-hover:scale-110 transition-transform">
                            ⏳
                        </div>
                    </div>

                    {{-- Widget 3 --}}
                    <div class="bg-white/80 backdrop-blur-xl p-5 rounded-3xl border border-white/50 shadow-lg flex items-center justify-between group hover:border-blue-500/30 transition-all duration-300">
                        <div class="space-y-1">
                            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Dịch vụ đang hoạt động</p>
                            <p class="text-2xl font-black text-blue-600 font-mono tracking-tight">
                                {{ $totalServices ?? 0 }} <span class="text-xs font-bold text-slate-400 uppercase">Gói</span>
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold shadow-sm group-hover:scale-110 transition-transform">
                            📦
                        </div>
                    </div>
                </div>

                {{-- Feature Navigation Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                    
                    {{-- Card 1 --}}
                    <div class="bg-white/80 backdrop-blur-xl border border-white/50 rounded-[32px] p-6 shadow-xl flex flex-col justify-between hover:border-blue-500/30 transition-all duration-300 group">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xl mb-4 shadow-sm group-hover:scale-105 transition-transform">📦</div>
                            <h4 class="text-base font-black text-slate-800 tracking-tight uppercase mb-1">Quản lý bài đăng dịch vụ</h4>
                            <p class="text-xs text-slate-500 font-semibold leading-relaxed mb-6">Thêm mới, sửa đổi thông tin lịch trình, giá cả hoặc tạm dừng hiển thị các gói Tour và phòng Khách sạn của bạn.</p>
                        </div>
                        <a href="{{ route('partner.services.index') }}" class="w-full text-center bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white text-xs font-bold tracking-wider uppercase py-3 rounded-xl transition-all shadow-md">
                            Truy cập kho sản phẩm ➔
                        </a>
                    </div>

                    {{-- Card 2 --}}
                    <div class="bg-white/80 backdrop-blur-xl border border-white/50 rounded-[32px] p-6 shadow-xl flex flex-col justify-between hover:border-orange-500/30 transition-all duration-300 group">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center font-bold text-xl mb-4 shadow-sm group-hover:scale-105 transition-transform">📋</div>
                            <h4 class="text-base font-black text-slate-800 tracking-tight uppercase mb-1">Quản lý đơn đặt hàng (Booking)</h4>
                            <p class="text-xs text-slate-500 font-semibold leading-relaxed mb-6">Xem nhanh danh sách khách hàng đã đặt lịch, duyệt nhanh trạng thái đơn hàng và lấy thông tin liên hệ đón trả khách.</p>
                        </div>
                        <a href="{{ route('partner.orders.index') }}" class="w-full text-center bg-orange-600 hover:bg-orange-700 text-white text-xs font-bold tracking-wider uppercase py-3 rounded-xl transition-all shadow-md shadow-orange-500/20">
                            Xử lý đơn đặt lịch ➔
                        </a>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>