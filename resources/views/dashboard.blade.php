<x-app-layout>

{{-- FONT SAAS --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* ========================================================== */
/* 🔥 CHỈ KÍCH HOẠT THANH CUỘN CUSTOM CHO KHUNG BẢNG ĐƠN HÀNG */
/* ========================================================== */
.custom-scroll::-webkit-scrollbar {
    width: 8px;   /* Độ rộng thanh cuộn dọc */
    height: 8px;  /* Độ cao thanh cuộn ngang */
}

/* Phần nền đường chạy của thanh cuộn bên trong bảng */
.custom-scroll::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.03); 
    border-radius: 100px;
}

/* Cục kéo (Thumb) - Bo tròn màu xám tinh tế */
.custom-scroll::-webkit-scrollbar-thumb {
    background: #a1a1aa; 
    border-radius: 100px;
    border: 2px solid transparent; 
    background-clip: padding-box;
}

/* Hiệu ứng hover cho cục kéo khi di chuột vào bảng */
.custom-scroll::-webkit-scrollbar-thumb:hover {
    background: #71717a; 
    border: 2px solid transparent;
    background-clip: padding-box;
}

body {
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
    overflow-y: auto; /* Thanh cuộn của toàn trang web giữ mặc định */
}

/* ===== OCEAN BACKGROUND CLEAN VERSION ===== */
.ocean-bg {
    position: fixed;
    inset: 0;
    z-index: -1;
    pointer-events: none;
    background: linear-gradient(180deg, #dff6ff 0%, #bfe9ff 40%, #7dd3fc 100%);
}

.ocean-bg::before {
    content: "";
    position: absolute;
    width: 120%;
    height: 120%;
    top: -10%;
    left: -10%;
    background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.8), transparent 60%),
                radial-gradient(circle at 70% 60%, rgba(255,255,255,0.5), transparent 55%);
    animation: oceanMove 18s ease-in-out infinite;
}

.ocean-bg::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, transparent 30%, rgba(255,255,255,0.25), transparent 70%);
    animation: shine 10s linear infinite;
}

@keyframes oceanMove {
    0% { transform: translate(0,0) scale(1); }
    50% { transform: translate(2%, 3%) scale(1.05); }
    100% { transform: translate(0,0) scale(1); }
}

@keyframes shine {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}
</style>

<div class="ocean-bg"></div>

{{-- 1. HEADER --}}
<x-slot name="header">
    <div class="rounded-2xl p-6 bg-white/60 backdrop-blur-xl border border-white/40 shadow-lg relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-60 h-60 bg-cyan-200 blur-3xl opacity-30 rounded-full"></div>
        <div class="absolute -bottom-10 -left-10 w-60 h-60 bg-sky-300 blur-3xl opacity-30 rounded-full"></div>

        <div class="relative">
            <div class="text-2xs font-bold text-sky-600 tracking-widest">
                🌊 OCEAN BOOKING SYSTEM
            </div>
            <h2 class="text-3xl font-black text-slate-800 mt-1">
                🧳 Lịch sử đặt Tour / Khách sạn
            </h2>
            <div class="mt-4 flex gap-3 text-xs font-bold text-slate-700">
                <span class="px-7 py-3 rounded-full bg-white/60 shadow">
                    📦 {{ $orders->count() }} đơn
                </span>
                <span class="px-7 py-3 rounded-full bg-white/60 shadow">
                    💰 {{ number_format($orders->sum('total_price')) }} VND
                </span>
            </div>
        </div>
    </div>
</x-slot>

{{-- BODY CONTAINER --}}
<div class="py-10 text-slate-700">
    <div class="max-w-7xl mx-auto px-4 space-y-8">

        {{-- 2. FILTER --}}
        <div class="bg-white/60 backdrop-blur-xl border border-white/40 rounded-2xl p-4 shadow-sm">
            <form method="GET" class="flex gap-3">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="🔍 Tìm dịch vụ..."
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-300 text-slate-900 bg-white/80">

                <select name="status" class="px-7 py-2 rounded-xl border border-slate-200 text-sm bg-white/80 text-slate-900 font-medium">
                    <option value="">Tất cả trạng thái</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>

                <button class="bg-sky-500 hover:bg-sky-600 text-black px-6 rounded-xl text-sm font-black uppercase tracking-wider shadow transition">
                    Lọc
                </button>
            </form>
        </div>

        {{-- 3. TABLE ĐƠN HÀNG --}}
        <div class="bg-white/70 backdrop-blur-xl rounded-[24px] border border-white/40 shadow-xl overflow-hidden w-full">
            <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="font-black text-slate-800 text-sm uppercase tracking-wider flex items-center gap-2">
                    <i class="fa-solid fa-list-check text-sky-600"></i> Danh sách đơn hàng đã đặt
                </h3>
                <span class="text-xs font-black bg-sky-100 text-sky-800 px-3 py-1 rounded-xl uppercase tracking-wider">
                    Cập nhật thời gian thực
                </span>
            </div>

            <div class="w-full overflow-auto max-h-[680px] scroll-smooth custom-scroll">
                <table class="w-full text-left border-collapse text-sm">
                    <thead class="sticky top-0 z-10 bg-slate-50 text-slate-700 border-b border-slate-100 text-xs font-black uppercase tracking-wider shadow-sm">
                        <tr>
                            <th class="p-4 text-center w-16">Mã</th>
                            <th class="p-4 min-w-[250px]">Dịch vụ</th>
                            <th class="p-4 text-center w-16">SL</th>
                            <th class="p-4 text-center w-28">Ngày đặt</th>
                            <th class="p-4 text-right w-40">Thành tiền</th>
                            <th class="p-4 text-center w-36">Thanh toán</th>
                            <th class="p-4 text-center w-24">Hóa đơn</th>
                            <th class="p-4 min-w-[150px]">Ghi chú</th>
                            <th class="p-4 text-center w-32">Trạng thái</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 bg-white/50 font-medium text-slate-600">
                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-50/50 transition">
                            {{-- MÃ ĐƠN HÀNG --}}
                            <td class="p-4 text-center font-bold text-slate-400">#{{ $order->id }}</td>
                            
                            {{-- TÊN DỊCH VỤ & NGÀY TẠO ĐƠN --}}
                            <td class="p-4">
                                <div class="font-bold text-slate-800 line-clamp-2">{{ $order->service->title ?? 'Dịch vụ đã xóa' }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5 font-medium">Ngày tạo: {{ $order->created_at->format('d/m/Y H:i') }}</div>
                            </td>
                            
                            {{-- SỐ LƯỢNG (SL) --}}
                            <td class="p-4 text-center font-black text-slate-700 bg-slate-50/30">{{ $order->quantity }}</td>
                            
                            {{-- NGÀY ĐẶT --}}
                            <td class="p-4 text-center text-xs text-slate-500 font-semibold">
                                {{ $order->booking_date ? \Carbon\Carbon::parse($order->booking_date)->format('d/m/Y') : '---' }}
                            </td>
                            
                            {{-- THÀNH TIỀN --}}
                            <td class="p-4 text-right font-black text-slate-900">
                                {{ number_format($order->total_price) }} <span class="text-xs font-bold text-slate-400">VND</span>
                            </td>

                            {{-- NÚT BẤM HIỂN THỊ MODAL QR --}}
                            <td class="p-4 text-center">
                                @if(!$order->payment_proof)
                                    <button type="button"
                                        onclick="openPaymentModal(this)"
                                        data-id="{{ $order->id }}"
                                        data-price="{{ $order->total_price }}"
                                        data-formatted-price="{{ number_format($order->total_price) }} VND"
                                        data-route="{{ route('orders.uploadProof', $order->id) }}"
                                        class="inline-flex items-center gap-1 text-xs font-black text-amber-700 hover:text-amber-900 bg-amber-50 hover:bg-amber-100/80 px-3 py-1.5 rounded-xl transition shadow-sm border border-amber-200 uppercase tracking-wider cursor-pointer">
                                        <i class="fa-solid fa-qrcode text-[11px]"></i> QR / Upload
                                    </button>
                                @else
                                    <span class="inline-flex items-center text-[11px] font-black uppercase tracking-wider px-2.5 py-1 rounded bg-slate-100 text-slate-500 border border-slate-200/60">
                                        Đã gửi ảnh
                                    </span>
                                @endif
                            </td>

                            {{-- NÚT XEM BILL HÓA ĐƠN ĐÃ GỬI --}}
                            <td class="p-4 text-center">
                                @if($order->payment_proof)
                                    <a href="{{ asset('storage/'.$order->payment_proof) }}" target="_blank"
                                       class="inline-flex items-center gap-1 text-xs font-black text-sky-600 hover:text-sky-800 bg-sky-50 hover:bg-sky-100 px-2.5 py-1 rounded-lg transition border border-sky-100">
                                        <i class="fa-solid fa-image"></i> Xem bill
                                    </a>
                                @else
                                    <span class="text-xs text-slate-400 italic">Trống</span>
                                @endif
                            </td>

                            {{-- GHI CHÚ --}}
                            <td class="p-4 text-xs text-slate-400 italic max-w-[150px] truncate">
                                {{ $order->note ?? '---' }}
                            </td>

                            {{-- TRẠNG THÁI MÀU SẮC --}}
                            <td class="p-4 text-center whitespace-nowrap">
                                @if($order->status === 'pending')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-black rounded-xl bg-amber-50 text-amber-700 border border-amber-200">
                                        <i class="fa-solid fa-spinner fa-spin text-[10px]"></i> Pending
                                    </span>
                                @elseif(in_array($order->status,['confirmed','accepted','approved']))
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-black rounded-xl bg-sky-50 text-sky-700 border border-sky-200">
                                        <i class="fa-solid fa-circle-check text-[10px]"></i> Confirmed
                                    </span>
                                @elseif($order->status === 'completed')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-black rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <i class="fa-solid fa-square-check text-[10px]"></i> Done
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-black rounded-xl bg-slate-50 text-slate-500 border border-slate-200">
                                        <i class="fa-solid fa-ban text-[10px]"></i> Cancel
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-16 text-slate-400 font-medium bg-slate-50/20">
                                <div class="text-3xl mb-2">📭</div>
                                Chưa có đơn hàng nào phát sinh.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- 4. DASHBOARD THỐNG KÊ PHỤ --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <div class="bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-5 shadow-sm hover:shadow-xl transition hover:-translate-y-1">
                <div class="text-xs font-bold text-slate-500">📊 Tổng đơn</div>
                <div class="text-3xl font-extrabold text-sky-600 mt-1">{{ $orders->count() }}</div>
            </div>

            <div class="bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-5 shadow-sm hover:shadow-xl transition hover:-translate-y-1">
                <div class="text-xs font-bold text-slate-500">⏳ Chờ duyệt</div>
                <div class="text-3xl font-extrabold text-amber-500 mt-1">{{ $orders->where('status','pending')->count() }}</div>
            </div>

            <div class="bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-5 shadow-sm hover:shadow-xl transition hover:-translate-y-1">
                <div class="text-xs font-bold text-slate-500">✅ Hoàn thành</div>
                <div class="text-3xl font-extrabold text-emerald-500 mt-1">{{ $orders->where('status','completed')->count() }}</div>
            </div>

            <div class="bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-5 shadow-sm hover:shadow-xl transition hover:-translate-y-1">
                <div class="text-xs font-bold text-slate-500">💳 Đã thanh toán</div>
                <div class="text-3xl font-extrabold text-cyan-600 mt-1">
                    {{ $orders->whereNotNull('payment_proof')->count() }}
                </div>
            </div>
        </div>

        {{-- ================= 🌊 5. CÁC DỊCH VỤ TƯƠNG TỰ ĐỘNG CHUẨN ĐẸP ================= --}}
        <div class="space-y-5 pt-6">
            <div class="flex justify-between items-center px-1">
                <h3 class="font-black text-slate-800 text-lg uppercase tracking-wider flex items-center gap-2">
                    <span class="text-xl">✨</span> Có thể bạn sẽ thích
                </h3>
                <span class="text-xs font-bold text-sky-700 bg-sky-100/80 px-3 py-1 rounded-full border border-sky-200">
                    Gợi ý phù hợp với bạn
                </span>
            </div>

            {{-- Grid hiển thị các Card dịch vụ động --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($suggestedServices as $service)
                <div class="group bg-white/70 backdrop-blur-xl border border-white/50 rounded-[24px] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between">
                    
                    {{-- Khung ảnh dịch vụ --}}
                    <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                        <img src="{{ $service->image_url ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500' }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" 
                             alt="{{ $service->title }}">
                        
                        {{-- Tag Badge tự động đổi chữ dựa theo loại dịch vụ thực tế --}}
                        <span class="absolute top-3 left-3 bg-slate-950/70 backdrop-blur-md text-white text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-lg">
                            @if(($service->type ?? '') === 'khach_san')
                                🏨 Khách Sạn
                            @elseif(($service->type ?? '') === 'tour_trong_nuoc')
                                🇻🇳 Tour Trong Nước
                            @elseif(($service->type ?? '') === 'tour_nuoc_ngoai')
                                ✈️ Tour Nước Ngoài
                            @else
                                🏝️ Vé & Dịch Vụ
                            @endif
                        </span>
                    </div>

                    {{-- Nội dung chữ --}}
                    <div class="p-4 flex-1 flex flex-col justify-between space-y-3">
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm line-clamp-2 group-hover:text-sky-600 transition">
                                {{ $service->title }}
                            </h4>
                            <p class="text-[11px] text-slate-400 mt-1 line-clamp-1">
                                📍 {{ $service->location ?? 'Địa điểm toàn quốc' }}
                            </p>
                        </div>

                        {{-- Giá tiền & Nút hành động --}}
                        <div class="flex items-center justify-between pt-2 border-t border-slate-100/60">
                            <div>
                                <span class="text-[9px] uppercase font-bold text-slate-400 block leading-none">Giá từ</span>
                                <span class="text-sm font-black text-rose-500 font-mono">
                                    {{ number_format($service->price ?? 0) }}đ
                                </span>
                            </div>
                            
                            {{-- Nút nhảy sang trang chi tiết cụ thể để đặt tiếp --}}
                            <a href="{{ route('services.show', $service->id) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-sky-500 text-black shadow-sm transition group-hover:bg-sky-600 active:scale-95 cursor-pointer">
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

{{-- ================= PAYMENT MODAL PREMIUM ================= --}}
<div id="global-payment-modal"
    class="fixed inset-0 hidden z-[999999] bg-black/80 backdrop-blur-md flex items-center justify-center p-4 transition-all duration-300">

    {{-- CARD --}}
    <div class="relative w-full max-w-[360px] overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-[0_25px_60px_-15px_rgba(0,0,0,0.45)]">

        {{-- DECOR --}}
        <div class="absolute -top-24 -right-24 h-48 w-48 rounded-full bg-cyan-200/40 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 h-48 w-48 rounded-full bg-sky-200/40 blur-3xl"></div>

        {{-- CONTENT --}}
        <div class="relative p-5">

            {{-- CLOSE --}}
            <button type="button"
                onclick="closePaymentModal()"
                class="absolute right-4 top-4 z-50 flex h-10 w-10 items-center justify-center rounded-full bg-red-500 text-white shadow-lg transition-all duration-200 hover:scale-110 hover:bg-red-600 cursor-pointer">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>

            {{-- HEADER --}}
            <div class="text-center border-b border-slate-200 pb-4">
                <div class="inline-flex items-center gap-1.5 rounded-full border border-cyan-300 bg-cyan-100 px-3 py-1 text-[10px] font-black uppercase tracking-widest text-cyan-700 shadow-sm">
                    <span class="h-1.5 w-1.5 rounded-full bg-cyan-500 animate-pulse"></span>
                    VietQR Secure Gateway
                </div>

                <h2 class="mt-3 text-xl font-black text-slate-900">
                    Quét mã để thanh toán
                </h2>

                <p class="mt-1 text-xs font-medium text-slate-500">
                    Hỗ trợ tất cả ngân hàng nội địa
                </p>
            </div>

            {{-- BODY --}}
            <div class="mt-5 space-y-5">

                {{-- PRICE --}}
                <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-100 px-4 py-3 shadow-sm">
                    <span class="text-[11px] font-black uppercase tracking-widest text-slate-500">
                        Tổng tiền
                    </span>
                    <span id="modal-order-price" class="text-2xl font-black text-slate-900 font-mono">
                        0 VND
                    </span>
                </div>

                {{-- QR --}}
                <div class="flex justify-center">
                    <div class="w-48 h-48 overflow-hidden rounded-2xl border-2 border-slate-200 bg-white p-2 shadow-lg flex items-center justify-center shrink-0">
                        <img id="modal-qr-img"
                            src=""
                            alt="QR Code"
                            class="block !w-full !h-full object-contain">
                    </div>
                </div>

                {{-- STATUS --}}
                <div class="flex items-center justify-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50 py-2.5 text-sm font-bold text-emerald-700">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Đang chờ thanh toán...
                </div>

                {{-- NOTE --}}
                <div class="rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-center">
                    <p class="text-[11px] font-semibold leading-relaxed text-amber-700">
                        Nội dung chuyển khoản phải đúng mã đơn để hệ thống duyệt tự động.
                    </p>
                </div>

                {{-- FORM TẢI HÓA ĐƠN --}}
                <form id="modal-payment-form"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    {{-- FILE --}}
                    <label class="group flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 py-4 transition hover:border-cyan-400 hover:bg-cyan-50">
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-image text-cyan-600"></i>
                            <span id="file-name-hint" class="max-w-[220px] truncate text-xs font-bold text-slate-700">
                                Tải hóa đơn chuyển khoản
                            </span>
                        </div>
                        <input type="file"
                            name="payment_proof"
                            required
                            onchange="displayFileName(this)"
                            class="hidden">
                    </label>

                    {{-- TIME --}}
                    <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-100 px-4 py-3">
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-500">
                            Thời gian tạo
                        </span>
                        <span class="text-xs font-bold text-slate-700 font-mono">
                            {{ now()->format('d/m/Y H:i') }}
                        </span>
                    </div>

                    {{-- SUBMIT --}}
                    <button type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-cyan-400 to-sky-500 py-3 text-xs font-black uppercase tracking-widest text-slate-950 shadow-lg transition hover:brightness-110 active:scale-[0.98]">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Xác nhận đã chuyển khoản</span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
function openPaymentModal(btn) {
    const id = btn.dataset.id;
    const price = btn.dataset.price;
    const formatted = btn.dataset.formattedPrice;
    const route = btn.dataset.route;

    document.getElementById('modal-order-price').innerText = formatted;

    document.getElementById('modal-qr-img').src =
        `https://img.vietqr.io/image/MB-1520327735200-compact.png?amount=${price}&addInfo=ORDER${id}`;

    document.getElementById('modal-payment-form').action = route;

    document.getElementById('global-payment-modal').classList.remove('hidden');

    document.body.style.overflow = 'hidden';
}

function closePaymentModal() {
    document.getElementById('global-payment-modal').classList.add('hidden');

    document.body.style.overflow = 'auto';

    document.getElementById('file-name-hint').innerText = "Tải hóa đơn chuyển khoản";

    document.getElementById('file-name-hint').className = "max-w-[220px] truncate text-xs font-bold text-slate-700";
}

function displayFileName(input) {
    const hint = document.getElementById('file-name-hint');

    if (input.files && input.files[0]) {
        hint.innerText = "📸 " + input.files[0].name;
        hint.className = "max-w-[220px] truncate text-xs font-black text-emerald-600";
    }
}
</script>

</x-app-layout>