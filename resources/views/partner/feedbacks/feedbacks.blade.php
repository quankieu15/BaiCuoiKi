<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hộp thư Phản hồi - HKT PARTNER</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased min-h-screen">

    <div class="flex min-h-screen">
        
        <aside class="w-64 bg-gradient-to-b from-[#2587ce] to-[#125ba7] text-white flex flex-col fixed h-full z-50 shadow-xl">
            <div class="p-5 flex items-center border-b border-white/10">
                <span class="text-xl font-extrabold tracking-wider text-white">
                    <span class="text-sky-200">HKT</span> <span class="text-orange-400">TRAVEL</span>
                </span>
                <span class="ml-2 px-2 py-0.5 text-[10px] bg-white text-[#125ba7] rounded-md font-bold uppercase tracking-wider">Partner</span>
            </div>

            <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto">
                <p class="text-xs font-bold text-sky-200/60 uppercase tracking-wider px-3 mb-2">Kênh Nhà Cung Cấp</p>
                
                <a href="/" class="text-white/80 hover:text-white hover:bg-white/10 px-3 py-2.5 rounded-xl transition flex items-center gap-2.5 text-xs font-bold">
                    <i class="fa-solid fa-house w-4"></i> Xem Trang Chủ
                </a>
                
                <a href="{{ route('partner.dashboard') }}" class="text-white/80 hover:text-white hover:bg-white/10 px-3 py-2.5 rounded-xl transition flex items-center gap-2.5 text-xs font-bold">
                    <i class="fa-solid fa-chart-pie w-4"></i> Tổng quan Partner
                </a>
                
                <a href="{{ route('partner.services.index') }}" class="text-white/80 hover:text-white hover:bg-white/10 px-3 py-2.5 rounded-xl transition flex items-center gap-2.5 text-xs font-bold">
                    <i class="fa-solid fa-suitcase-rolling w-4"></i> Quản lý dịch vụ
                </a>

                <a href="{{ route('partner.orders.index') }}" class="text-white/80 hover:text-white hover:bg-white/10 px-3 py-2.5 rounded-xl transition flex items-center gap-2.5 text-xs font-bold">
                    <i class="fa-solid fa-clipboard-list w-4"></i> Đơn đặt lịch đổ về
                </a>
                
                <a href="{{ route('partner.feedbacks.index') }}" class="bg-white text-[#125ba7] px-3 py-2.5 rounded-xl flex items-center gap-2.5 text-xs font-black shadow-md">
                    <i class="fa-solid fa-envelope-open-text w-4"></i> Hòm thư phản hồi
                </a>
            </nav>

            <div class="p-4 border-t border-white/10 bg-black/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-white/70 hover:text-red-200 px-3 py-2 rounded-xl transition flex items-center gap-2.5 text-xs font-bold">
                        <i class="fa-solid fa-right-from-bracket w-4"></i> Đăng xuất
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 pl-64 min-h-screen">
            
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 sticky top-0 z-40 shadow-sm">
                <h1 class="text-xs font-bold text-slate-700 tracking-wide uppercase">Hệ thống tiếp nhận & xử lý đóng góp ý kiến</h1>
                <div class="text-[10px] font-extrabold uppercase tracking-widest text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-200">
                    Dữ liệu lưu trữ
                </div>
            </header>

            <div class="p-8">
                <div class="max-w-7xl mx-auto space-y-6">
                    
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <div>
                            <div class="flex items-center gap-2 text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">
                                <span>🤝 Kênh đối tác dịch vụ</span>
                                <span>•</span>
                                <span class="text-slate-400">Ý kiến phản hồi</span>
                            </div>
                            <h1 class="text-xl font-black text-slate-800 tracking-tight flex items-center gap-2 uppercase">
                                <i class="fa-regular fa-envelope text-blue-500"></i> Hộp thư Phản hồi Dịch vụ
                            </h1>
                        </div>
                        <div>
                            <a href="{{ route('partner.dashboard') }}" class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl transition-all border border-slate-200/60 shadow-sm">
                                <i class="fa-solid fa-arrow-left"></i> Quay lại bảng điều khiển
                            </a>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                        
                        @if(session('success'))
                            <div class="m-6 p-4 text-xs font-bold tracking-wide uppercase text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center gap-2 shadow-sm">
                                <i class="fa-solid fa-circle-check text-sm"></i> {{ session('success') }}
                            </div>
                        @endif

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50 text-slate-400 text-[11px] font-bold uppercase tracking-widest border-b border-slate-100">
                                        <th class="px-6 py-4 text-center w-16">STT</th>
                                        <th class="px-6 py-4 w-56">Khách hàng liên hệ</th>
                                        <th class="px-6 py-4">Nội dung phản hồi dịch vụ</th>
                                        <th class="px-6 py-4 w-44 text-center">Thời gian nhận</th>
                                        <th class="px-6 py-4 w-28 text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                                    @forelse($feedbacks as $index => $item)
                                        <tr class="hover:bg-slate-50/50 transition-colors group">
                                            <td class="px-6 py-5 text-center">
                                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-md bg-blue-50 text-blue-600 text-xs font-bold font-mono border border-blue-100/40">
                                                    {{ $index + 1 }}
                                                </span>
                                            </td>
                                            
                                            <td class="px-6 py-5">
                                                <div class="font-bold text-slate-800 text-sm mb-0.5">{{ $item->name }}</div>
                                                <div class="text-xs text-slate-400 font-semibold flex items-center gap-1">
                                                    <i class="fa-solid fa-address-book text-[10px] text-slate-400"></i> Contact: {{ $item->contact }}
                                                </div>
                                            </td>
                                            
                                            <td class="px-6 py-5 max-w-md">
                                                <div class="bg-slate-50/80 p-3.5 rounded-xl border border-slate-200/50 text-slate-700 leading-relaxed text-xs font-medium group-hover:bg-white group-hover:border-blue-200/80 group-hover:shadow-sm transition-all">
                                                    {{ $item->message }}
                                                </div>
                                            </td>
                                            
                                            <td class="px-6 py-5 text-center whitespace-nowrap">
                                                <div class="text-[11px] font-bold text-blue-600 font-mono bg-blue-50 px-2.5 py-1 rounded-lg inline-block border border-blue-100/40 shadow-sm">
                                                    <i class="fa-regular fa-clock mr-0.5"></i> {{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : 'N/A' }}
                                                </div>
                                            </td>
                                            
                                            <td class="px-6 py-5 text-center whitespace-nowrap">
                                                <form action="{{ route('partner.feedbacks.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có muốn xóa thư phản hồi này không?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center gap-1 text-xs font-bold text-rose-600 hover:bg-rose-50 px-3 py-1.5 rounded-lg border border-transparent hover:border-rose-100 transition-all cursor-pointer">
                                                        <i class="fa-regular fa-trash-can"></i> Xóa bỏ
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-16 text-center text-slate-400">
                                                <div class="text-3xl mb-3 text-slate-300">
                                                    <i class="fa-regular fa-folder-open"></i>
                                                </div>
                                                <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Hộp thư trống</div>
                                                <p class="text-xs text-slate-400/80 mt-1">Chưa có thông tin phản hồi nào từ phía khách hàng trải nghiệm dịch vụ.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>