<x-app-layout>

{{-- FONT SAAS --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    #global-payment-modal{
    position: fixed !important;
    inset: 0 !important;
    z-index: 999999999 !important;
}
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
body{
    font-family: 'Inter', sans-serif;
}

.ocean-title{
    font-family: 'Sora', sans-serif;
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
<div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl border border-white/50 shadow-lg">
    <div class="flex items-center justify-between flex-wrap gap-4">
        <div>
            <div class="flex items-center gap-2 text-[10px] font-extrabold text-sky-600 uppercase tracking-wider mb-2">
                🌊 Ocean Booking System
            </div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">
                📦 LỊCH SỬ ĐƠN HÀNG
            </h2>
            <p class="text-sm text-slate-500 mt-2 font-medium">
                Theo dõi trạng thái booking, thanh toán và xác nhận dịch vụ.
            </p>
        </div>

        <div class="flex gap-3 flex-wrap">
            <div class="bg-sky-50 border border-sky-100 rounded-2xl px-5 py-4">
                <div class="text-[11px] uppercase font-black text-sky-500 tracking-widest">
                    Tổng đơn
                </div>
                <div class="text-3xl font-black text-sky-700 mt-1">
                    {{ $orders->count() }}
                </div>
            </div>

            <div class="bg-emerald-50 border border-emerald-100 rounded-2xl px-5 py-4">
                <div class="text-[11px] uppercase font-black text-emerald-500 tracking-widest">
                    Đã thanh toán
                </div>
                <div class="text-3xl font-black text-emerald-700 mt-1">
                    {{ $orders->whereNotNull('payment_proof')->count() }}
                </div>
            </div>
        </div>
    </div>
</div>
</x-slot>

{{-- 3. TABLE ĐƠN HÀNG (Ép chết cứng bo góc 28px bằng CSS Inline để triệt tiêu góc vuông 90 độ) --}}
<div class="border border-cyan-100 bg-white shadow-[0_10px_40px_rgba(0,140,255,0.08)] mb-6" 
     style="border-radius: 28px !important; overflow: hidden !important;">

    {{-- HEADER TABLE (Bo góc trên để khớp hoàn toàn với khung cha) --}}
    <div class="bg-gradient-to-r from-sky-500 via-cyan-500 to-blue-500 px-6 py-5" 
         style="border-top-left-radius: 27px !important; border-top-right-radius: 27px !important;">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 text-2xl backdrop-blur">
                    🌊
                </div>
                <div>
                    <h3 class="text-2xl font-black text-black">
                        Danh sách đơn hàng
                    </h3>
                    <p class="text-sm text-cyan-100 font-medium">
                        Theo dõi tour & khách sạn đã đặt
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE CONTENT --}}
    <div class="p-4 bg-white" style="border-bottom-left-radius: 27px !important; border-bottom-right-radius: 27px !important;">
        <div class="overflow-hidden border border-slate-100 overflow-auto custom-scroll" style="border-radius: 20px !important;">
            <table class="w-full border-separate border-spacing-0">
                <thead class="bg-sky-50 border-b border-sky-100">
                    <tr class="text-slate-700">
                        <th class="px-4 py-4 text-center text-xs font-black uppercase" style="border-top-left-radius: 20px !important;">Mã</th>
                        <th class="px-5 py-4 text-left text-xs font-black uppercase min-w-[280px]">Dịch vụ</th>
                        <th class="px-4 py-4 text-center text-xs font-black uppercase">SL</th>
                        <th class="px-4 py-4 text-center text-xs font-black uppercase">Ngày đặt</th>
                        <th class="px-5 py-4 text-right text-xs font-black uppercase">Thành tiền</th>
                        <th class="px-5 py-4 text-center text-xs font-black uppercase">Thanh toán</th>
                        <th class="px-5 py-4 text-center text-xs font-black uppercase">Hóa đơn</th>
                        <th class="px-5 py-4 text-left text-xs font-black uppercase">Ghi chú</th>
                        <th class="px-5 py-4 text-center text-xs font-black uppercase" style="border-top-right-radius: 20px !important;">Trạng thái</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($orders as $order)
                    <tr class="transition hover:bg-sky-50/60">

                        {{-- ID --}}
                        <td class="px-4 py-5 text-center @if($loop->last) rounded-bl-[20px] @endif" style="@if($loop->last) border-bottom-left-radius: 20px !important; @endif">
                            <div class="font-black text-lg" style="color: #0284c7 !important;">
                                {{ $order->id }}
                            </div>
                        </td>

                        {{-- SERVICE --}}
                        <td class="px-5 py-5">
                            <div class="flex flex-col gap-2">
                                @php
                                    $title = $order->service->title ?? 'Dịch vụ đã xóa';
                                    $isHotel = Str::contains(Str::lower($title), ['khách sạn', 'hotel', 'resort', 'homestay', 'phòng']);
                                @endphp

                                <div class="flex items-center gap-2 flex-wrap">
                                    @if($isHotel)
                                        <span class="inline-flex items-center gap-1 rounded-md px-2 py-0.5 text-[10px] font-black uppercase tracking-wider"
                                              style="background-color: #F3E8FF !important; color: #6B21A8 !important; border: 1px solid #E9D5FF !important;">
                                            🏨 Khách sạn
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-md px-2 py-0.5 text-[10px] font-black uppercase tracking-wider"
                                              style="background-color: #E0F2FE !important; color: #0369A1 !important; border: 1px solid #BAE6FD !important;">
                                            🌴 Tour Du Lịch
                                        </span>
                                    @endif
                                </div>

                                <div class="text-sm font-extrabold text-slate-800 leading-snug tracking-tight max-w-[320px] break-words">
                                    {{ $title }}
                                </div>

                                <div class="inline-flex items-center gap-1 text-[11px] font-semibold text-slate-400">
                                    <i class="fa-regular fa-clock text-[10px]"></i>
                                    <span>Đặt lúc đơn: {{ $order->created_at->format('H:i - d/m/Y') }}</span>
                                </div>
                            </div>
                        </td>

                        {{-- QUANTITY --}}
                        <td class="px-4 py-5 text-center">
                            <div class="inline-block min-w-[48px] px-3 py-1.5 rounded-2xl border border-slate-100 text-center font-black" 
                                 style="background-color: #F4F7FE !important; color: #1B254B !important;">
                                {{ $order->quantity }}
                            </div>
                        </td>

                        {{-- DATE --}}
                        <td class="px-4 py-5 text-center text-sm font-bold text-slate-700">
                            {{ $order->booking_date ? \Carbon\Carbon::parse($order->booking_date)->format('d/m/Y') : '---' }}
                        </td>

                        {{-- PRICE --}}
                        <td class="px-5 py-5 text-right">
                            <div class="text-xl font-black tracking-tight" style="color: #FF5A00 !important;">
                                {{ number_format($order->total_price) }}đ
                            </div>
                        </td>

                        {{-- PAYMENT --}}
                        <td class="px-5 py-5 text-center">
                            @if(!$order->payment_proof)
                            <button type="button"
                                onclick="openPaymentModal(this)"
                                data-id="{{ $order->id }}"
                                data-price="{{ $order->total_price }}"
                                data-formatted-price="{{ number_format($order->total_price) }} VND"
                                data-route="{{ route('orders.uploadProof', $order->id) }}"
                                class="rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 px-4 py-2 text-xs font-black shadow-md shadow-blue-100 transition hover:scale-105 active:scale-95"
                                style="color: #b58708 !important;">
                                QR / Upload
                            </button>
                            @elseif(in_array(trim($order->status), ['Chờ xác nhận', 'pending']))
                            <div class="inline-flex items-center gap-1 rounded-xl border border-amber-200 px-3 py-1.5 text-xs font-bold"
                                 style="background-color: #FFF9E6 !important; color: #B27000 !important;">
                                <span>⏳ Đang chờ duyệt ảnh</span>
                            </div>
                            @else
                            <div class="inline-flex items-center gap-1 rounded-2xl border border-emerald-200 px-3 py-1.5 text-xs font-bold"
                                 style="background-color: #EBFBF5 !important; color: #0A6C4A !important;">
                                <span>✅ Đã gửi</span>
                            </div>
                            @endif
                        </td>

                        {{-- BILL --}}
                        <td class="px-5 py-5 text-center">
                            @if($order->payment_proof)
                            @php
                                $proofPath = Str::contains($order->payment_proof, 'public/') 
                                    ? Storage::url($order->payment_proof) 
                                    : asset('storage/' . $order->payment_proof);
                            @endphp
                            <a href="{{ $proofPath }}"
                                target="_blank"
                                class="inline-flex items-center gap-1.5 rounded-xl border border-sky-200 px-3 py-1.5 text-xs font-black transition"
                                style="background-color: #E0F2FE !important; color: #0369A1 !important;">
                                🧾 Xem hóa đơn
                            </a>
                            @else
                            <span class="text-xs font-medium text-slate-400 italic">
                                Chưa có
                            </span>
                            @endif
                        </td>

                        {{-- NOTE --}}
                        <td class="px-5 py-5 text-left max-w-[180px]">
                            <div class="text-xs font-semibold text-slate-600 line-clamp-2" title="{{ $order->note }}">
                                {{ $order->note ?? '---' }}
                            </div>
                        </td>

                        {{-- STATUS --}}
                        <td class="px-5 py-5 text-center @if($loop->last) rounded-br-[20px] @endif" style="@if($loop->last) border-bottom-right-radius: 20px !important; @endif">
                            @php $statusClean = trim($order->status); @endphp

                            @if($statusClean === 'Chờ xác nhận' || $statusClean === 'pending')
                            <div class="inline-flex items-center justify-center gap-2 rounded-full border border-[#FFEBA6] px-5 py-2 text-sm font-bold min-w-[150px]"
                                 style="background-color: #FFF9E6 !important; color: #B27000 !important;">
                                <span class="w-4 h-4 rounded-full flex items-center justify-center text-[10px] font-black" style="background-color: #FFC107 !important; color: #ffffff !important;">🕒</span>
                                Chờ xác nhận
                            </div>
                            @elseif($statusClean === 'Đã xác nhận' || in_array($statusClean, ['confirmed', 'accepted', 'approved']))
                            <div class="inline-flex items-center justify-center gap-2 rounded-full border border-[#C6F6E5] px-5 py-2 text-sm font-bold min-w-[150px]"
                                 style="background-color: #EBFBF5 !important; color: #0A6C4A !important;">
                                <span class="w-2 h-2 rounded-full" style="background-color: #10B981 !important;"></span>
                                Đã xác nhận
                            </div>
                            @elseif($statusClean === 'Đã hoàn thành' || $statusClean === 'completed')
                            <div class="inline-flex items-center justify-center gap-2 rounded-full border border-emerald-200 px-5 py-2 text-sm font-bold min-w-[150px]"
                                 style="background-color: #EBFBF5 !important; color: #0A6C4A !important;">
                                <span class="w-2 h-2 rounded-full" style="background-color: #10B981 !important;"></span>
                                Đã hoàn thành
                            </div>
                            @else
                            <div class="inline-flex items-center justify-center gap-2 rounded-full border border-[#FDE8E8] px-5 py-2 text-sm font-bold min-w-[150px]"
                                 style="background-color: #FDF2F2 !important; color: #9B1C1C !important;">
                                <span class="w-2 h-2 rounded-full" style="background-color: #E53E3E !important;"></span>
                                Đã hủy
                            </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="py-20 text-center" style="border-bottom-left-radius: 20px !important; border-bottom-right-radius: 20px !important;">
                            <div class="text-6xl">🌊</div>
                            <div class="mt-4 text-2xl font-black text-sky-700">
                                Chưa có đơn hàng nào
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- 4. DASHBOARD THỐNG KÊ PHỤ --}}
<div class="flex gap-5 w-full">
    <div class="flex-1 bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-5 shadow-sm hover:shadow-xl transition hover:-translate-y-1">
        <div class="text-xs font-bold text-slate-500">📊 Tổng đơn</div>
        <div class="text-3xl font-extrabold text-sky-600 mt-1">{{ $orders->count() }}</div>
    </div>

    <div class="flex-1 bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-5 shadow-sm hover:shadow-xl transition hover:-translate-y-1">
        <div class="text-xs font-bold text-slate-500">⏳ Chờ duyệt</div>
        <div class="text-3xl font-extrabold text-amber-500 mt-1">{{ $orders->where('status','pending')->count() }}</div>
    </div>

    <div class="flex-1 bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-5 shadow-sm hover:shadow-xl transition hover:-translate-y-1">
        <div class="text-xs font-bold text-slate-500">✅ Hoàn thành</div>
        <div class="text-3xl font-extrabold text-emerald-500 mt-1">{{ $orders->where('status','completed')->count() }}</div>
    </div>

    <div class="flex-1 bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-5 shadow-sm hover:shadow-xl transition hover:-translate-y-1">
        <div class="text-xs font-bold text-slate-500">💳 Đã thanh toán</div>
        <div class="text-3xl font-extrabold text-cyan-600 mt-1">{{ $orders->whereNotNull('payment_proof')->count() }}</div>
    </div>
</div>

{{-- ================= PAYMENT MODAL PREMIUM ================= --}}
<div id="global-payment-modal" class="fixed inset-0 hidden items-center justify-center bg-black/80 backdrop-blur-md p-4 z-[999999999]">
    <div class="relative w-full max-w-[360px] overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-[0_25px_60px_-15px_rgba(0,0,0,0.45)]">
        {{-- DECOR --}}
        <div class="absolute -top-24 -right-24 h-48 w-48 rounded-full bg-cyan-200/40 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 h-48 w-48 rounded-full bg-sky-200/40 blur-3xl"></div>

        {{-- CONTENT --}}
        <div class="relative p-5">
            {{-- CLOSE --}}
            <button type="button" onclick="closePaymentModal()"
                class="absolute top-4 right-4 z-[999999] flex h-10 w-10 items-center justify-center rounded-full bg-red-500 text-black shadow-xl transition duration-200 hover:scale-110 hover:bg-red-600">
                <i class="fa-solid fa-xmark text-lg text-black"></i>
            </button>

            {{-- HEADER --}}
            <div class="text-center border-b border-slate-200 pb-4">
                <div class="inline-flex items-center gap-1.5 rounded-full border border-cyan-300 bg-cyan-100 px-3 py-1 text-[10px] font-black uppercase tracking-widest text-cyan-700 shadow-sm">
                    <span class="h-1.5 w-1.5 rounded-full bg-cyan-500 animate-pulse"></span>
                    VietQR Secure Gateway
                </div>
                <h2 class="mt-3 text-xl font-black text-slate-900">Quét mã để thanh toán</h2>
                <p class="mt-1 text-xs font-medium text-slate-500">Hỗ trợ tất cả ngân hàng nội địa</p>
            </div>

            {{-- BODY --}}
            <div class="mt-5 space-y-5">
                {{-- PRICE --}}
                <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-100 px-4 py-3 shadow-sm">
                    <span class="text-[11px] font-black uppercase tracking-widest text-slate-500">Tổng tiền</span>
                    <span id="modal-order-price" class="text-2xl font-black text-slate-900 font-mono">0 VND</span>
                </div>

                {{-- QR --}}
                <div class="flex justify-center">
                    <div class="flex h-48 w-48 shrink-0 items-center justify-center overflow-hidden rounded-2xl border-2 border-slate-200 bg-white p-2 shadow-lg">
                        <img id="modal-qr-img" src="" alt="QR Code" class="block h-full w-full object-contain">
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

                {{-- FORM --}}
                <form id="modal-payment-form" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    {{-- FILE --}}
                    <label class="group flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 py-4 transition hover:border-cyan-400 hover:bg-cyan-50">
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-image text-cyan-600"></i>
                            <span id="file-name-hint" class="max-w-[220px] truncate text-xs font-bold text-slate-700">Tải hóa đơn chuyển khoản</span>
                        </div>
                        <input type="file" name="payment_proof" required onchange="displayFileName(this)" class="hidden">
                    </label>

                    {{-- TIME --}}
                    <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-100 px-4 py-3">
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-500">Thời gian tạo</span>
                        <span class="font-mono text-xs font-bold text-slate-700">{{ now()->format('d/m/Y H:i') }}</span>
                    </div>

                    {{-- SUBMIT --}}
                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-cyan-400 to-sky-500 py-3 text-xs font-black uppercase tracking-widest text-slate-950 shadow-lg transition hover:brightness-110 active:scale-[0.98]">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Xác nhận đã chuyển khoản</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>
function openPaymentModal(btn) {
    const id = btn.dataset.id;
    const price = btn.dataset.price;
    const formatted = btn.dataset.formattedPrice;
    const route = btn.dataset.route;

    document.getElementById('modal-order-price').innerText = formatted;
    document.getElementById('modal-qr-img').src = `https://img.vietqr.io/image/MB-1520327735200-compact.png?amount=${price}&addInfo=ORDER${id}`;
    document.getElementById('modal-payment-form').action = route;

    const modal = document.getElementById('global-payment-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closePaymentModal() {
    const modal = document.getElementById('global-payment-modal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
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

window.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { closePaymentModal(); }
});

document.getElementById('global-payment-modal').addEventListener('click', function(e) {
    if (e.target === this) { closePaymentModal(); }
});
</script>

</x-app-layout>