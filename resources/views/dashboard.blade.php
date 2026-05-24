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
    <div class="relative overflow-hidden rounded-[28px] border border-cyan-100 bg-white/70 p-7 backdrop-blur-xl shadow-[0_10px_40px_rgba(0,140,255,0.10)]">

        {{-- DECOR --}}
        <div class="absolute -top-16 -right-16 h-40 w-40 rounded-full bg-cyan-200/40 blur-3xl"></div>
        <div class="absolute -bottom-16 -left-16 h-40 w-40 rounded-full bg-sky-300/30 blur-3xl"></div>

        <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

            {{-- LEFT --}}
            <div>

                <div class="inline-flex items-center gap-2 rounded-full bg-sky-100 px-4 py-2 text-[11px] font-extrabold uppercase tracking-[0.25em] text-sky-700 shadow-sm">
                    🌊 Ocean Booking System
                </div>

              <h2 class="ocean-title mt-4 text-4xl font-extrabold leading-tight text-slate-800">
    🧳 Lịch sử 
    <span class="bg-gradient-to-r from-cyan-500 to-sky-600 bg-clip-text text-transparent">
        đơn hàng
    </span>
</h2>

                <p class="mt-3 text-sm font-medium text-slate-500">
                    Theo dõi booking, thanh toán và trạng thái dịch vụ du lịch.
                </p>
            </div>

            {{-- RIGHT STATS --}}
            <div class="flex flex-wrap gap-3">

                <div class="rounded-2xl bg-gradient-to-r from-sky-500 to-cyan-500 px-6 py-4 text-black shadow-lg">
                    <div class="text-[11px] font-black uppercase tracking-widest opacity-90">
                        📦 Tổng đơn
                    </div>

                    <div class="mt-1 text-3xl font-black">
                        {{ $orders->count() }}
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-cyan-500 to-sky-500 px-6 py-5 text-black shadow-[0_10px_30px_rgba(0,140,255,0.25)]">

    {{-- EFFECT --}}
    <div class="absolute -right-5 -top-5 h-24 w-24 rounded-full bg-white/20 blur-2xl"></div>

    <div class="relative z-10">

        <div class="text-[11px] font-black uppercase tracking-[0.25em] text-cyan-100">
            💰 Tổng đã đặt
        </div>

        <div class="mt-2 flex items-end gap-2">

            <span class="text-3xl font-black leading-none">
                {{ number_format($orders->sum('total_price')) }}
            </span>

            <span class="mb-1 text-xs font-bold uppercase tracking-widest text-cyan-100">
                VND
            </span>
        </div>

        <div class="mt-3 text-xs font-semibold text-cyan-50">
            Chi phí booking tour & khách sạn
        </div>
    </div>
</div>

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
        {{-- ================= OCEAN ORDER TABLE ================= --}}
{{-- ================= CLEAN OCEAN TABLE ================= --}}
<div class="overflow-hidden rounded-[28px] border border-cyan-100 bg-white shadow-[0_10px_40px_rgba(0,140,255,0.08)]">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-sky-500 via-cyan-500 to-blue-500 px-6 py-5">

        <div class="flex items-center justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 text-2xl backdrop-blur">
                    🌊
                </div>

                <div>
                    <h3 class="text-2xl font-black text-white">
                        Danh sách đơn hàng
                    </h3>

                    <p class="text-sm text-cyan-100 font-medium">
                        Theo dõi tour & khách sạn đã đặt
                    </p>
                </div>
            </div>

            <div class="rounded-full bg-white/20 px-4 py-2 text-xs font-black text-white backdrop-blur">
                🔄 REALTIME
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="overflow-auto custom-scroll">

        <table class="w-full border-collapse">

            {{-- HEAD --}}
            <thead class="bg-sky-50 border-b border-sky-100">

                <tr class="text-slate-700">

                    <th class="px-4 py-4 text-center text-xs font-black uppercase">Mã</th>

                    <th class="px-5 py-4 text-left text-xs font-black uppercase min-w-[280px]">
                        Dịch vụ
                    </th>

                    <th class="px-4 py-4 text-center text-xs font-black uppercase">
                        SL
                    </th>

                    <th class="px-4 py-4 text-center text-xs font-black uppercase">
                        Ngày đặt
                    </th>

                    <th class="px-5 py-4 text-right text-xs font-black uppercase">
                        Thành tiền
                    </th>

                    <th class="px-5 py-4 text-center text-xs font-black uppercase">
                        Thanh toán
                    </th>

                    <th class="px-5 py-4 text-center text-xs font-black uppercase">
                        Hóa đơn
                    </th>

                    <th class="px-5 py-4 text-left text-xs font-black uppercase">
                        Ghi chú
                    </th>

                    <th class="px-5 py-4 text-center text-xs font-black uppercase">
                        Trạng thái
                    </th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody class="divide-y divide-slate-100 bg-white">

                @forelse($orders as $order)

                <tr class="transition hover:bg-sky-50/60">

                    {{-- ID --}}
                    <td class="px-4 py-5 text-center">

                        <div class="font-black text-sky-600 text-lg">
                            #{{ $order->id }}
                        </div>
                    </td>

                    {{-- SERVICE --}}
                    <td class="px-5 py-5">

                        <div class="flex items-start gap-4">

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-100 text-3xl">
                                🐬
                            </div>

                            <div>

                                <div class="text-sm font-black text-slate-800 leading-6">
                                    {{ $order->service->title ?? 'Dịch vụ đã xóa' }}
                                </div>

                                <div class="mt-1 text-xs font-semibold text-slate-400">
                                    📅 {{ $order->created_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </td>

                    {{-- QUANTITY --}}
                    <td class="px-4 py-5 text-center">

                        <div class="font-black text-slate-700">
                            {{ $order->quantity }}
                        </div>
                    </td>

                    {{-- DATE --}}
                    <td class="px-4 py-5 text-center text-sm font-bold text-slate-600">

                        {{ $order->booking_date ? \Carbon\Carbon::parse($order->booking_date)->format('d/m/Y') : '---' }}
                    </td>

                    {{-- PRICE --}}
                    <td class="px-5 py-5 text-right">

                        <div class="text-xl font-black text-sky-700">
                            {{ number_format($order->total_price) }}
                        </div>

                        <div class="text-xs font-bold uppercase text-slate-400">
                            VND
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
                            class="rounded-xl bg-gradient-to-r from-amber-400 to-orange-400 px-4 py-2 text-xs font-black text-black shadow transition hover:scale-105">

                            QR / Upload
                        </button>

                        @else

                        <div class="rounded-xl bg-emerald-100 px-3 py-2 text-xs font-black text-emerald-700">
                            ✅ Đã gửi
                        </div>

                        @endif
                    </td>

                    {{-- BILL --}}
                    <td class="px-5 py-5 text-center">

                        @if($order->payment_proof)

                        <a href="{{ asset('storage/'.$order->payment_proof) }}"
                            target="_blank"
                            class="text-sm font-black text-sky-600 hover:text-sky-800">

                            🧾 Xem
                        </a>

                        @else

                        <span class="text-sm text-slate-400">
                            Trống
                        </span>

                        @endif
                    </td>

                    {{-- NOTE --}}
                    <td class="px-5 py-5 text-sm text-slate-500">

                        {{ $order->note ?? '---' }}
                    </td>

                    {{-- STATUS --}}
                    <td class="px-5 py-5 text-center">

                        @if($order->status === 'pending')

                        <div class="rounded-xl bg-amber-100 px-3 py-2 text-xs font-black text-amber-700">
                            ⏳ Pending
                        </div>

                        @elseif(in_array($order->status,['confirmed','accepted','approved']))

                        <div class="rounded-xl bg-sky-100 px-3 py-2 text-xs font-black text-sky-700">
                            🌊 Confirmed
                        </div>

                        @elseif($order->status === 'completed')

                        <div class="rounded-xl bg-emerald-100 px-3 py-2 text-xs font-black text-emerald-700">
                            ✅ Completed
                        </div>

                        @else

                        <div class="rounded-xl bg-rose-100 px-3 py-2 text-xs font-black text-rose-700">
                            ❌ Cancelled
                        </div>

                        @endif
                    </td>
                </tr>

                @empty

                <tr>

                    <td colspan="9" class="py-20 text-center">

                        <div class="text-6xl">
                            🌊
                        </div>

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

       

{{-- ================= PAYMENT MODAL PREMIUM ================= --}}
<div id="global-payment-modal"
    class="fixed inset-0 hidden items-center justify-center bg-black/80 backdrop-blur-md p-4 z-[999999999]">

    {{-- CARD --}}
    <div
        class="relative w-full max-w-[360px] overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-[0_25px_60px_-15px_rgba(0,0,0,0.45)]">

        {{-- DECOR --}}
        <div class="absolute -top-24 -right-24 h-48 w-48 rounded-full bg-cyan-200/40 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 h-48 w-48 rounded-full bg-sky-200/40 blur-3xl"></div>

        {{-- CONTENT --}}
        <div class="relative p-5">

            {{-- CLOSE --}}
            <button type="button"
                onclick="closePaymentModal()"
                class="absolute top-4 right-4 z-[999999] flex h-10 w-10 items-center justify-center rounded-full bg-red-500 text-black shadow-xl transition duration-200 hover:scale-110 hover:bg-red-600">

                <i class="fa-solid fa-xmark text-lg text-black"></i>
            </button>

            {{-- HEADER --}}
            <div class="text-center border-b border-slate-200 pb-4">

                <div
                    class="inline-flex items-center gap-1.5 rounded-full border border-cyan-300 bg-cyan-100 px-3 py-1 text-[10px] font-black uppercase tracking-widest text-cyan-700 shadow-sm">

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
                <div
                    class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-100 px-4 py-3 shadow-sm">

                    <span class="text-[11px] font-black uppercase tracking-widest text-slate-500">
                        Tổng tiền
                    </span>

                    <span id="modal-order-price"
                        class="text-2xl font-black text-slate-900 font-mono">
                        0 VND
                    </span>
                </div>

                {{-- QR --}}
                <div class="flex justify-center">

                    <div
                        class="flex h-48 w-48 shrink-0 items-center justify-center overflow-hidden rounded-2xl border-2 border-slate-200 bg-white p-2 shadow-lg">

                        <img id="modal-qr-img"
                            src=""
                            alt="QR Code"
                            class="block h-full w-full object-contain">
                    </div>
                </div>

                {{-- STATUS --}}
                <div
                    class="flex items-center justify-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50 py-2.5 text-sm font-bold text-emerald-700">

                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>

                    Đang chờ thanh toán...
                </div>

                {{-- NOTE --}}
                <div
                    class="rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-center">

                    <p class="text-[11px] font-semibold leading-relaxed text-amber-700">
                        Nội dung chuyển khoản phải đúng mã đơn để hệ thống duyệt tự động.
                    </p>
                </div>

                {{-- FORM --}}
                <form id="modal-payment-form"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-4">

                    @csrf

                    {{-- FILE --}}
                    <label
                        class="group flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 py-4 transition hover:border-cyan-400 hover:bg-cyan-50">

                        <div class="flex items-center gap-2">

                            <i class="fa-regular fa-image text-cyan-600"></i>

                            <span id="file-name-hint"
                                class="max-w-[220px] truncate text-xs font-bold text-slate-700">

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
                    <div
                        class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-100 px-4 py-3">

                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-500">
                            Thời gian tạo
                        </span>

                        <span class="font-mono text-xs font-bold text-slate-700">
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

{{-- ================= SCRIPT ================= --}}
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

    document.getElementById('file-name-hint').innerText =
        "Tải hóa đơn chuyển khoản";

    document.getElementById('file-name-hint').className =
        "max-w-[220px] truncate text-xs font-bold text-slate-700";
}

function displayFileName(input) {

    const hint = document.getElementById('file-name-hint');

    if (input.files && input.files[0]) {

        hint.innerText = "📸 " + input.files[0].name;

        hint.className =
            "max-w-[220px] truncate text-xs font-black text-emerald-600";
    }
}

window.addEventListener('keydown', function(e) {

    if (e.key === 'Escape') {
        closePaymentModal();
    }
});

document.getElementById('global-payment-modal')
    .addEventListener('click', function(e) {

        if (e.target === this) {
            closePaymentModal();
        }
    });
</script>

</x-app-layout>