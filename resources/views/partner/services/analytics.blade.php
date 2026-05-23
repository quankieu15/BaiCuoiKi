@extends('layouts.partner')

@section('content')
<div class="max-w-7xl mx-auto">
    
    {{-- 🟢 NÚT QUAY LẠI TRANG QUẢN LÝ DỊCH VỤ --}}
    <div class="mb-4">
        <a href="{{ route('partner.services.index') }}" class="inline-flex items-center gap-2 text-xs font-black text-cyan-700 hover:text-cyan-900 bg-cyan-50 hover:bg-cyan-100/80 px-4 py-2 rounded-xl transition shadow-sm border border-cyan-100">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Quay lại Quản lý dịch vụ</span>
        </a>
    </div>
    
    <div class="mb-8">
        <h1 class="text-2xl font-black text-slate-800">📊 Thống kê & Báo cáo doanh thu</h1>
        <p class="text-xs text-slate-500 font-medium mt-1">Xem hiệu quả kinh doanh và dòng tiền thực tế từ các dịch vụ của ông.</p>
    </div>

    {{-- KHU VỰC THẺ STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-[24px] p-6 text-white shadow-xl shadow-emerald-500/10 relative overflow-hidden">
            <div class="absolute right-4 top-4 text-white/20 text-5xl font-black">
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
            <p class="text-xs font-bold uppercase tracking-wider text-emerald-100">Doanh thu thực tế</p>
            <h3 class="text-3xl font-black mt-2">
                {{ number_format($totalRevenue) }} <span class="text-sm font-bold text-emerald-200">đ</span>
            </h3>
            <p class="text-[11px] text-emerald-100/80 mt-4 flex items-center gap-1">
                <i class="fa-solid fa-circle-check"></i> Tính từ các đơn đặt lịch đã hoàn thành
            </p>
        </div>

        <div class="bg-gradient-to-br from-blue-500 to-sky-600 rounded-[24px] p-6 text-white shadow-xl shadow-blue-500/10 relative overflow-hidden">
            <div class="absolute right-4 top-4 text-white/20 text-5xl font-black">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <p class="text-xs font-bold uppercase tracking-wider text-blue-100">Đơn đặt thành công</p>
            <h3 class="text-3xl font-black mt-2">
                {{ number_format($totalOrders) }} <span class="text-sm font-bold text-blue-200">lượt</span>
            </h3>
            <p class="text-[11px] text-blue-100/80 mt-4 flex items-center gap-1">
                <i class="fa-solid fa-chart-line"></i> Khách hàng đã thanh toán & trải nghiệm
            </p>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-indigo-600 rounded-[24px] p-6 text-white shadow-xl shadow-purple-500/10 relative overflow-hidden">
            <div class="absolute right-4 top-4 text-white/20 text-5xl font-black">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <p class="text-xs font-bold uppercase tracking-wider text-purple-100">Sản phẩm cung cấp</p>
            <h3 class="text-3xl font-black mt-2">
                {{ number_format($totalServices) }} <span class="text-sm font-bold text-purple-200">dịch vụ</span>
            </h3>
            <p class="text-[11px] text-purple-100/80 mt-4 flex items-center gap-1">
                <i class="fa-solid fa-box"></i> Tổng số dịch vụ đang hoạt động trên web
            </p>
        </div>

    </div>

    {{-- BẢNG LỊCH SỬ GIAO DỊCH --}}
    <div class="bg-white/70 backdrop-blur-md rounded-[24px] border border-cyan-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <div>
                <h2 class="font-black text-slate-800 text-sm uppercase tracking-wider flex items-center gap-2">
                    <i class="fa-solid fa-clock-rotate-left text-cyan-600"></i> Lịch sử đặt dịch vụ gần đây
                </h2>
                <p class="text-[11px] text-slate-400 font-medium mt-0.5">Top 5 lượt đặt dịch vụ mới nhất của nhà cung cấp này.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-cyan-50/40 text-cyan-900 border-b border-cyan-100 text-xs font-black uppercase tracking-wider">
                        <th class="p-4">Mã đơn</th>
                        <th class="p-4">Tên dịch vụ</th>
                        <th class="p-4">Ngày đặt</th>
                        <th class="p-4">Thành tiền</th>
                        <th class="p-4 text-center">Trạng thái</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-100 bg-white">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-cyan-50/10 transition font-medium text-slate-600">
                            <td class="p-4 font-bold text-slate-800">#{{ $order->id }}</td>
                            <td class="p-4 text-slate-700 font-bold">{{ $order->service_title }}</td>
                            <td class="p-4 text-xs text-slate-400">{{ date('d/m/Y H:i', strtotime($order->created_at)) }}</td>
                            <td class="p-4 font-black text-rose-500">{{ number_format($order->total_price) }} đ</td>
                            <td class="p-4 text-center">
                                @php
                                    // 1. Chuẩn hóa chuỗi dữ liệu trạng thái để tránh lỗi khoảng trắng hay viết hoa
                                    $currentStatus = trim(strtolower($order->status ?? ''));

                                    // 2. Định nghĩa tập hợp các từ khóa thành công và đang xử lý
                                    $isSuccess = in_array($currentStatus, ['completed', 'hoan_thanh', 'success', 'approved', 'đã duyệt', 'da_duyet', 'thành công']);
                                    $isPending = in_array($currentStatus, ['pending', 'dang_xu_ly', 'processing', 'chờ duyệt', 'cho_duyet', 'chờ xử lý']);
                                @endphp

                                @if($isSuccess)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-black rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <i class="fa-solid fa-circle-check text-[10px]"></i> Thành công
                                    </span>
                                @elseif($isPending)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-black rounded-xl bg-amber-50 text-amber-700 border border-amber-200">
                                        <i class="fa-solid fa-spinner fa-spin text-[10px]"></i> Đang xử lý
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-black rounded-xl bg-rose-50 text-rose-700 border border-rose-200">
                                        {{ $order->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-slate-400 font-medium bg-slate-50/30">
                                <div class="text-3xl mb-2">📥</div>
                                Chưa có phát sinh bất kỳ giao dịch đặt dịch vụ nào.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection