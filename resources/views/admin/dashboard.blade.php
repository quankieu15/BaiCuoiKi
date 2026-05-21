@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    
    {{-- HÀNG THẺ SỐ LIỆU TỔNG QUAN --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Khách Hàng</p>
                <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $totalCustomers }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-xl"><i class="fa-solid fa-users"></i></div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Đối Tác</p>
                <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $totalPartners }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl"><i class="fa-solid fa-handshake"></i></div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Dịch Vụ Active</p>
                <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $totalServices }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl"><i class="fa-solid fa-map-location-dot"></i></div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Tổng Đơn Hàng</p>
                <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $totalOrders }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl"><i class="fa-solid fa-clipboard-list"></i></div>
        </div>

        <div class="p-6 rounded-2xl shadow-sm flex items-center justify-between bg-gradient-to-br from-sky-500 to-blue-600 text-white">
            <div>
                <p class="text-xs text-white/80 font-bold uppercase tracking-wider">Tổng Doanh Thu</p>
                <h3 class="text-xl font-black mt-1">{{ number_format($totalRevenue) }}đ</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-white/20 text-white flex items-center justify-center text-xl"><i class="fa-solid fa-wallet"></i></div>
        </div>
        
    </div>

    {{-- KHU VỰC CHỨA BIỂU ĐỒ NÂNG CAO --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Biểu đồ Doanh thu (Line Chart) --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h3 class="text-sm font-black text-slate-700 mb-4 uppercase tracking-wider">Biểu đồ thống kê doanh thu năm {{ date('Y') }}</h3>
            <div class="h-80 relative">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        {{-- Biểu đồ Trạng thái Đơn hàng (Pie Chart) --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h3 class="text-sm font-black text-slate-700 mb-4 uppercase tracking-wider">Tỷ lệ trạng thái đơn hàng</h3>
            <div class="h-80 relative flex items-center justify-center">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
        
    </div>
</div>

{{-- SCRIPT KHỞI TẠO CHART.JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Line Chart Doanh Thu
    const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctxRevenue, {
        type: 'line',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: @json($chartRevenueData),
                borderColor: '#0ea5e9',
                backgroundColor: 'rgba(14, 165, 233, 0.05)',
                borderWidth: 3,
                fill: true,
                tension: 0.3,
                pointBackgroundColor: '#0ea5e9'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    // 2. Pie Chart Trạng Thái Đơn
    const ctxStatus = document.getElementById('statusChart').getContext('2d');
    new Chart(ctxStatus, {
        type: 'pie',
        data: {
            labels: ['Chờ duyệt (Pending)', 'Thành công (Approved)', 'Đã hủy (Cancelled)'],
            datasets: [{
                data: [
                    {{ $chartStatusData['pending'] }},
                    {{ $chartStatusData['approved'] }},
                    {{ $chartStatusData['cancelled'] }}
                ],
                backgroundColor: ['#f59e0b', '#10b981', '#ef4444'],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection