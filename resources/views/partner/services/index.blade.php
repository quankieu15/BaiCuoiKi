<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Gói dịch vụ - HKT PARTNER</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .selection-area-container {
            position: relative;
        }
        /* Hiệu ứng màu nền xanh cyan sữa pastel cực nịnh mắt khi lướt trúng đồng bộ tone Supreme */
        .selected-row {
            background-color: rgba(6, 182, 212, 0.08) !important;
            border-left: 4px solid #06b6d4 !important;
        }
        /* Đổi cursor đặc thù báo hiệu chế độ lướt chọn đang chạy */
        .swiping-active tbody tr {
            cursor: cell !important;
            user-select: none;
        }
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
                
                <a href="{{ route('partner.dashboard') }}" class="text-white/80 hover:text-white hover:bg-white/20 px-3 py-2.5 rounded-xl transition flex items-center gap-3 text-xs font-bold">
                    <i class="fa-solid fa-chart-pie w-5 text-center text-white/80"></i> Tổng quan Partner
                </a>
                
                <a href="{{ route('partner.services.index') }}" class="bg-white text-sky-700 shadow-xl px-3 py-2.5 rounded-xl flex items-center gap-3 text-xs font-bold shadow-md shadow-blue-900/30">
                    <i class="fa-solid fa-suitcase-rolling w-5 text-center text-sky-700"></i> Quản lý dịch vụ
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
                <h1 class="text-xs font-bold text-slate-700 tracking-wide uppercase">Trung tâm quản lý sản phẩm du lịch công khai</h1>
                <div class="text-[10px] font-extrabold uppercase tracking-widest text-sky-700 bg-white/80 px-3 py-1.5 rounded-lg border border-white/40 shadow-inner">
                    Sản phẩm trực tuyến
                </div>
            </header>

            {{-- Page Body --}}
            <div class="p-8 space-y-6">

                {{-- Alert Thông báo --}}
                @if(session('success'))
                    <div class="bg-emerald-50/80 backdrop-blur-md border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-center font-bold text-xs shadow-sm">
                        🎉 {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-rose-50/80 backdrop-blur-md border border-rose-200 text-rose-700 px-4 py-3 rounded-xl text-center font-bold text-xs shadow-sm">
                        ⚠️ {{ session('error') }}
                    </div>
                @endif

                {{-- Khối Main Card chứa bộ lọc & bảng biểu --}}
                <div class="bg-white/80 backdrop-blur-xl rounded-[32px] border border-white/50 shadow-xl p-6">
                    
                    {{-- Thanh tiêu đề & Nút bấm hành động --}}
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                        <div>
                            <h3 class="text-lg font-black text-slate-800 tracking-tight uppercase flex items-center gap-2">
                                <i class="fa-solid fa-boxes-stacked text-sky-500"></i> Sản phẩm & Gói dịch vụ của bạn
                            </h3>
                            <p class="text-xs text-slate-500 font-semibold mt-1 leading-relaxed">
                                💡 <span class="text-sky-600">Mẹo:</span> Nhấn nút "Bật lướt chọn", đè chuột trái rồi kéo qua các dòng để chọn nhanh hàng loạt!
                            </p>
                        </div>
                        
                        <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                            <button type="button" id="btn-toggle-swipe" class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-slate-800 hover:bg-sky-600 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-sm transition-all cursor-pointer">
                                <i class="fa-solid fa-bolt"></i> Bật lướt chọn
                            </button>

                            <button type="submit" form="bulk-delete-form" id="btn-delete-multiple" class="hidden inline-flex items-center gap-1.5 px-4 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md transition-all cursor-pointer">
                                <i class="fa-regular fa-trash-can"></i> Xóa hàng loạt (<span id="select-count" class="font-mono">0</span>)
                            </button>

                            <a href="{{ route('partner.services.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md shadow-blue-500/20 transition-all">
                                <i class="fa-solid fa-plus"></i> Thêm dịch vụ mới
                            </a>
                        </div>
                    </div>

                    {{-- Thanh Tabs Danh Mục Lọc --}}
                    <div class="flex flex-wrap items-center gap-2 pb-5 mb-5 border-b border-slate-100/80">
                        @php
                            $currentType = request('type', 'all');
                        @endphp
                        
                        <a href="{{ route('partner.services.index', ['type' => 'all']) }}" 
                           class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-xl border transition-all
                           {{ $currentType == 'all' ? 'bg-gradient-to-r from-sky-500 to-blue-600 border-transparent text-white shadow-md shadow-blue-500/10' : 'bg-white/60 border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-border-all"></i> Tất cả
                        </a>

                        <a href="{{ route('partner.services.index', ['type' => 'car']) }}" 
                           class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-xl border transition-all
                           {{ $currentType == 'car' ? 'bg-gradient-to-r from-sky-500 to-blue-600 border-transparent text-white shadow-md shadow-blue-500/10' : 'bg-white/60 border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-car-side"></i> Thuê Xe
                        </a>

                        <a href="{{ route('partner.services.index', ['type' => 'hotel']) }}" 
                           class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-xl border transition-all
                           {{ $currentType == 'hotel' ? 'bg-gradient-to-r from-sky-500 to-blue-600 border-transparent text-white shadow-md shadow-blue-500/10' : 'bg-white/60 border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-hotel"></i> Khách sạn
                        </a>

                        <a href="{{ route('partner.services.index', ['type' => 'tour']) }}" 
                           class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-xl border transition-all
                           {{ $currentType == 'tour' ? 'bg-gradient-to-r from-sky-500 to-blue-600 border-transparent text-white shadow-md shadow-blue-500/10' : 'bg-white/60 border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-route"></i> Tour du lịch
                        </a>

                        <a href="{{ route('partner.services.index', ['type' => 'ticket']) }}" 
                           class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-xl border transition-all
                           {{ $currentType == 'ticket' ? 'bg-gradient-to-r from-sky-500 to-blue-600 border-transparent text-white shadow-md shadow-blue-500/10' : 'bg-white/60 border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-ticket"></i> Vé tham quan
                        </a>
                    </div>

                    {{-- Form & Bảng danh sách dịch vụ --}}
                    <form id="bulk-delete-form" action="{{ route('partner.services.bulkDelete') }}" method="POST" onsubmit="return confirm('Hệ thống sẽ xóa vĩnh viễn toàn bộ các gói dịch vụ du lịch đang được tích chọn. Xác nhận tiếp tục?')">
                        @csrf
                        @method('DELETE')

                        <div id="table-wrapper" class="overflow-x-auto bg-white/60 rounded-2xl border border-white/60 shadow-inner selection-area-container">
                            <table class="min-w-full divide-y divide-slate-100 text-left text-sm">
                                <thead class="bg-slate-50/70 text-slate-400 uppercase text-[11px] font-bold tracking-widest select-none border-b border-slate-100">
                                    <tr>
                                        <th class="px-6 py-4 w-12 text-center">
                                            <input type="checkbox" id="select-all-checkbox" class="rounded border-slate-300 text-sky-600 focus:ring-sky-500 cursor-pointer w-4 h-4 transition-all">
                                        </th>
                                        <th class="px-6 py-4 w-32">Hình ảnh</th>
                                        <th class="px-6 py-4">Tên dịch vụ / Tour</th>
                                        <th class="px-6 py-4 w-48">Địa điểm</th>
                                        <th class="px-6 py-4 w-44">Giá công khai</th>
                                        <th class="px-6 py-4 w-40 text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="selectable-tbody" class="divide-y divide-slate-100 text-slate-600">
                                    @forelse($services as $service)
                                        <tr class="hover:bg-sky-500/5 transition-colors row-item group">
                                            <td class="px-6 py-5 text-center">
                                                <input type="checkbox" name="ids[]" value="{{ $service->id }}" class="service-checkbox rounded border-slate-300 text-sky-600 focus:ring-sky-500 cursor-pointer w-4 h-4 transition-all">
                                            </td>
                                            
                                            <td class="px-6 py-5">
                                                <div class="w-20 h-12 rounded-xl overflow-hidden shadow-sm border border-slate-200/60 bg-slate-50">
                                                    <img src="{{ $service->image ? asset($service->image) : 'https://placehold.co/600x400?text=No+Image' }}" class="w-full h-full object-cover pointer-events-none select-none group-hover:scale-105 transition-transform duration-300">
                                                </div>
                                            </td>
                                            
                                            <td class="px-6 py-5 font-bold text-slate-800 select-none group-hover:text-sky-600 transition-colors text-sm">
                                                {{ $service->title }}
                                            </td>
                                            
                                            <td class="px-6 py-5 select-none font-semibold text-xs text-slate-500 whitespace-nowrap">
                                                <span class="inline-flex items-center gap-1 bg-white text-slate-600 px-2.5 py-1 rounded-lg border border-slate-200/60 shadow-sm">
                                                    <i class="fa-solid fa-location-dot text-rose-500 text-[10px]"></i> {{ $service->location }}
                                                </span>
                                            </td>
                                            
                                            <td class="px-6 py-5 font-black text-orange-600 select-none font-mono text-base whitespace-nowrap">
                                                {{ number_format($service->price) }}<span class="text-xs font-bold ml-0.5">đ</span>
                                            </td>
                                            
                                            <td class="px-6 py-5 text-center space-x-2 whitespace-nowrap text-xs font-bold">
                                                <a href="{{ route('partner.services.edit', $service->id) }}" class="inline-flex items-center gap-1 text-blue-600 hover:bg-blue-50 px-2.5 py-1.5 rounded-lg border border-transparent hover:border-blue-100 transition-all">
                                                    <i class="fa-regular fa-pen-to-square"></i> Sửa
                                                </a>
                                                
                                                <form action="{{ route('partner.services.destroy', $service->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn gỡ bỏ hoàn toàn bài đăng dịch vụ này không?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center gap-1 text-rose-600 hover:bg-rose-50 px-2.5 py-1.5 rounded-lg border border-transparent hover:border-rose-100 transition-all cursor-pointer">
                                                        <i class="fa-regular fa-trash-can"></i> Xóa
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                                                <div class="text-3xl mb-2 text-slate-300">
                                                    <i class="fa-solid fa-boxes-stacked"></i>
                                                </div>
                                                <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Kho hàng trống</div>
                                                <p class="text-xs text-slate-400/80 mt-1">Không tìm thấy dịch vụ nào thuộc danh mục này.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>

                </div>
            </div>
        </main>
    </div>

    {{-- Script giữ nguyên logic của bạn --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAll = document.getElementById('select-all-checkbox');
            const checkboxes = document.querySelectorAll('.service-checkbox');
            const btnDelete = document.getElementById('btn-delete-multiple');
            const selectCount = document.getElementById('select-count');
            
            const btnToggleSwipe = document.getElementById('btn-toggle-swipe');
            const tableWrapper = document.getElementById('table-wrapper');
            const rows = document.querySelectorAll('.row-item');

            let isSwipeMode = false;
            let isMouseDown = false;

            function updateDeleteButton() {
                const checkedCount = document.querySelectorAll('.service-checkbox:checked').length;
                selectCount.innerText = checkedCount;
                
                if (checkedCount > 0) {
                    btnDelete.classList.remove('hidden'); 
                } else {
                    btnDelete.classList.add('hidden'); 
                }
            }

            btnToggleSwipe.addEventListener('click', function() {
                isSwipeMode = !isSwipeMode;
                if (isSwipeMode) {
                    this.innerHTML = "<i class='fa-solid fa-ban'></i> Tắt lướt chọn";
                    this.classList.replace('bg-slate-800', 'bg-rose-600');
                    this.classList.replace('hover:bg-sky-600', 'hover:bg-rose-700');
                    tableWrapper.classList.add('swiping-active');
                } else {
                    this.innerHTML = "<i class='fa-solid fa-bolt'></i> Bật lướt chọn";
                    this.classList.replace('bg-rose-600', 'bg-slate-800');
                    this.classList.replace('hover:bg-rose-700', 'hover:bg-sky-600');
                    tableWrapper.classList.remove('swiping-active');
                }
            });

            document.addEventListener('mousedown', function(e) {
                if (!isSwipeMode) return;
                if (e.target.closest('a') || e.target.closest('button')) return;
                isMouseDown = true;
                
                const row = e.target.closest('.row-item');
                if (row) {
                    toggleRowSelection(row);
                }
            });

            document.addEventListener('mouseup', function() {
                isMouseDown = false;
            });

            rows.forEach(row => {
                row.addEventListener('mouseenter', function(e) {
                    if (isSwipeMode && isMouseDown) {
                        toggleRowSelection(this);
                    }
                });
            });

            function toggleRowSelection(row) {
                const cb = row.querySelector('.service-checkbox');
                if (cb) {
                    cb.checked = !cb.checked;
                    if (cb.checked) row.classList.add('selected-row');
                    else row.classList.remove('selected-row');
                }
                
                const checkedCount = document.querySelectorAll('.service-checkbox:checked').length;
                if (selectAll) {
                    selectAll.checked = (checkedCount === checkboxes.length && checkboxes.length > 0);
                }
                updateDeleteButton();
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    const row = this.closest('tr');
                    if (this.checked) row.classList.add('selected-row');
                    else row.classList.remove('selected-row');
                    
                    if (!this.checked) selectAll.checked = false;
                    if (document.querySelectorAll('.service-checkbox:checked').length === checkboxes.length) {
                        selectAll.checked = true;
                    }
                    updateDeleteButton();
                });
            });

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    checkboxes.forEach(cb => {
                        cb.checked = selectAll.checked;
                        const row = cb.closest('tr');
                        if (selectAll.checked) row.classList.add('selected-row');
                        else row.classList.remove('selected-row');
                    });
                    updateDeleteButton();
                });
            }
        });
    </script>
</body>
</html>