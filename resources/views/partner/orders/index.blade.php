<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Đơn đặt lịch - HKT PARTNER</title>
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

              @php
    $partnerPendingOrders = \App\Models\Order::where('status', 'pending')
        ->whereHas('service', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->count();
@endphp

<a href="{{ route('partner.orders.index') }}"
   class="relative bg-white text-[#125ba7] px-3 py-2.5 rounded-xl 
          flex items-center justify-between text-xs font-black shadow-md">

    <div class="flex items-center gap-2.5">
        <i class="fa-solid fa-clipboard-list w-4"></i>
        <span>Đơn đặt lịch đổ về</span>
    </div>

    @if($partnerPendingOrders > 0)
        <span class="min-w-[22px] h-[22px] px-1
                     flex items-center justify-center
                     bg-red-500 text-white text-[10px]
                     rounded-full font-black shadow
                     animate-pulse">
            {{ $partnerPendingOrders }}
        </span>
    @endif

</a>
                
                <a href="{{ route('partner.feedbacks.index') }}" class="text-white/80 hover:text-white hover:bg-white/10 px-3 py-2.5 rounded-xl transition flex items-center gap-2.5 text-xs font-bold">
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
                <h1 class="text-xs font-bold text-slate-700 tracking-wide uppercase flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    Hệ thống xử lý giao dịch & booking du lịch
                </h1>
                <div class="text-[10px] font-extrabold uppercase tracking-widest text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-200">
                    Thời gian thực
                </div>
            </header>

            <div class="p-8">
                <div class="max-w-7xl mx-auto space-y-6">

                    @if(session('success'))
                        <div class="p-4 text-xs font-bold tracking-wide uppercase text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center gap-2 shadow-sm">
                            <i class="fa-solid fa-circle-check text-sm"></i> {{ session('success') }}
                        </div>
                    @endif

                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                        
                        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-50/50">
                            <div>
                                <div class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-rectangle-list"></i> Danh sách giao dịch
                                </div>
                                <h2 class="text-xl font-black text-slate-800 tracking-tight uppercase">
                                    Quản lý Đơn đặt lịch (Bookings)
                                </h2>
                            </div>
                            <div class="text-xs font-bold bg-white text-slate-600 px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
                                Tổng đơn đổ về: <span class="text-blue-600 font-mono text-sm ml-1">{{ count($orders) }}</span>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="text-[11px] text-slate-400 uppercase bg-slate-50 font-bold tracking-widest border-b border-slate-100">
                                    <tr>
                                        <th class="px-6 py-4">Khách hàng</th>
                                        <th class="px-6 py-4">Dịch vụ yêu cầu</th>
                                        <th class="px-6 py-4 text-center">Số lượng</th>
                                        <th class="px-6 py-4">Tổng tiền</th>
                                        <th class="px-6 py-4 text-center">Trạng thái</th>
                                        <th class="px-6 py-4 text-right">Hành động duyệt đơn</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                                    @forelse($orders as $order)
                                        <tr class="hover:bg-slate-50/50 transition-colors group">
                                            <td class="px-6 py-4">
                                                <div class="font-bold text-slate-800 text-sm mb-0.5 group-hover:text-blue-600 transition-colors">{{ $order->user->name }}</div>
                                                <div class="text-xs font-semibold text-slate-400 flex items-center gap-1">
                                                    <i class="fa-solid fa-phone text-[10px] text-slate-400"></i> {{ $order->user->phone ?? 'Chưa cập nhật' }}
                                                </div>
                                            </td>
                                            
                                            <td class="px-6 py-4">
                                                <div class="font-bold text-slate-700 max-w-xs truncate group-hover:text-blue-600 transition-colors">
                                                    {{ $order->service->title }}
                                                </div>
                                            </td>
                                            
                                            <td class="px-6 py-4 text-center whitespace-nowrap font-bold text-slate-700 font-mono text-xs">
                                                <span class="bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-200/60 shadow-sm">
                                                    {{ $order->quantity }} 
                                                    <span class="text-[10px] font-bold text-slate-400 uppercase ml-0.5">
                                                        @if(\Illuminate\Support\Str::contains(\Illuminate\Support\Str::lower($order->service->title), ['xe', 'ô tô', 'tự lái']))
                                                            xe
                                                        @elseif(\Illuminate\Support\Str::contains(\Illuminate\Support\Str::lower($order->service->title), ['vé', 'vinwonders', 'cổng', 'vào']))
                                                            vé
                                                        @else
                                                            khách
                                                        @endif
                                                    </span>
                                                </span>
                                            </td>
                                            
                                            <td class="px-6 py-4 font-extrabold text-red-600 whitespace-nowrap font-mono text-sm">
                                                {{ number_format($order->total_price) }}đ
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                @if($order->status === 'pending')
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-amber-50 border border-amber-200 text-amber-700 shadow-sm">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                        Chờ duyệt đơn
                                                    </span>
                                                @elseif($order->status === 'approved' || $order->status === 'accepted')
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 border border-emerald-200 text-emerald-700 shadow-sm">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                                                        Đã xác nhận
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-rose-50 border border-rose-200 text-rose-700 shadow-sm">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                        Đã hủy bỏ
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                                @if($order->status === 'pending')
                                                    <div class="inline-flex items-center gap-2">
                                                        <form action="{{ route('partner.orders.updateStatus', $order->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT') 
                                                            <input type="hidden" name="status" value="accepted">
                                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-1.5 px-3.5 rounded-lg shadow-sm transition-all cursor-pointer">
                                                                Duyệt nhận
                                                            </button>
                                                        </form>

                                                        <form action="{{ route('partner.orders.updateStatus', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn từ chối đơn đặt lịch này?')">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="cancelled">
                                                            <button type="submit" class="bg-white hover:bg-rose-50 text-slate-500 hover:text-rose-600 text-xs font-bold py-1.5 px-3.5 rounded-lg border border-slate-200 hover:border-rose-200 transition-all cursor-pointer">
                                                                Từ chối
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <div class="inline-flex flex-col items-end gap-0.5">
                                                        <span class="text-slate-400 text-xs font-bold flex items-center gap-1">
                                                            <i class="fa-solid fa-circle-check text-slate-400 text-[10px]"></i> Xử lý xong
                                                        </span>
                                                        <span class="text-[10px] text-slate-400 font-mono bg-slate-50 px-1.5 py-0.5 rounded-md border border-slate-200/60 shadow-sm">
                                                            {{ $order->updated_at->format('H:i d/m/Y') }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                                                <div class="text-3xl mb-3 text-slate-300">
                                                    <i class="fa-regular fa-folder-open"></i>
                                                </div>
                                                <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Danh sách trống</div>
                                                <p class="text-xs text-slate-400/80 mt-1">Hiện tại chưa có khách hàng nào đặt dịch vụ của bạn.</p>
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