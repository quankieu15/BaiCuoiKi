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
                    💰 {{ number_format($orders->sum('total_price')) }}VND
                </span>
            </div>
        </div>
    </div>
</x-slot>

{{-- BODY CONTAINER --}}
<div class="py-10 text-slate-700">
    <div class="max-w-7xl mx-auto px-4 space-y-8">

        {{-- 2. FILTER (NẰM NGAY DƯỚI HEADER) --}}
        <div class="bg-blue border border-blue/50 rounded-2xl p-4 shadow">
            <form method="GET" class="flex gap-3">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="🔍 Tìm dịch vụ..."
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-300 text-slate-900">

                <select name="status" class="px-7 py-2 rounded-xl border border-slate-200 text-sm bg-blue text-slate-900">
                    <option value="">Tất cả trạng thái</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>

                <button class="bg-sky-500 hover:bg-sky-600 text-black px-5 rounded-xl text-sm font-bold">
                    Lọc
                </button>
            </form>
        </div>

        {{-- 3. TABLE ĐƠN HÀNG (FULL 100%) --}}
        <div class="bg-blue border border-white/50 rounded-2xl overflow-hidden shadow-lg w-full">
            <div class="p-5 border-b flex justify-between items-center bg-white/80">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    🌊 Danh sách đơn hàng đã đặt
                </h3>
                <span class="text-xs font-semibold bg-sky-100 text-sky-800 px-2.5 py-1 rounded-lg">
                    Cập nhật thời gian thực
                </span>
            </div>

            <div class="w-full overflow-auto max-h-[680px] scroll-smooth custom-scroll">
                <table class="w-full text-sm min-w-[800px]">
                    <thead class="sticky top-0 z-10 bg-sky-50 text-xs text-slate-500 uppercase shadow-sm">
                        <tr>
                            <th class="p-4 text-center">Mã</th>
                            <th class="text-left">Dịch vụ</th>
                            <th class="text-center">SL</th>
                            <th class="text-center">Ngày đặt</th>
                            <th class="text-left">Thanh toán</th>
                            <th class="text-center">Ghi chú</th>
                            <th class="text-center">Ngày tạo</th>
                            <th class="text-center">Trạng thái</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 bg-white/50">
                    @forelse($orders as $order)
                        <tr class="hover:bg-sky-50/60 transition">
                            <td class="p-4 text-center font-mono text-slate-700">#{{ $order->id }}</td>
                            <td class="font-semibold text-slate-900">{{ $order->service->title ?? 'Dịch vụ đã xóa' }}</td>
                            <td class="text-center font-extrabold text-slate-800">{{ $order->quantity }}</td>
                            <td class="text-center text-slate-600 font-medium">
                                {{ $order->booking_date ? \Carbon\Carbon::parse($order->booking_date)->format('d/m/Y') : '---' }}
                            </td>
                            <td>
                                <div class="font-bold text-sky-600 text-base">
                                    {{ number_format($order->total_price) }}VND
                                </div>

                                @if(!$order->payment_proof)
                                    <button
                                        onclick="openPaymentModal(this)"
                                        data-id="{{ $order->id }}"
                                        data-price="{{ $order->total_price }}"
                                        data-formatted-price="{{ number_format($order->total_price) }}VND"
                                        data-route="{{ route('orders.uploadProof', $order->id) }}"
                                        class="mt-1 text-xs bg-sky-500 hover:bg-sky-600 text-black px-3  py-2 rounded-lg font-bold shadow-sm transition cursor-pointer">
                                        QR / Upload
                                    </button>
                                @else
                                    <a href="{{ asset('storage/'.$order->payment_proof) }}" target="_blank"
                                       class="text-sky-600 text-xs font-bold underline inline-block mt-1">
                                        Xem bill
                                    </a>
                                @endif
                            </td>

                            <td class="text-center text-xs text-slate-500 max-w-[150px] truncate italic">
                                {{ $order->note ?? '---' }}
                            </td>

                            <td class="text-center text-xs text-slate-400 font-medium">
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="text-center whitespace-nowrap">
                                @if($order->status === 'pending')
                                    <span class="px-2.5 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-bold border border-amber-200">Pending</span>
                                @elseif(in_array($order->status,['confirmed','accepted','approved']))
                                    <span class="px-2.5 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-bold border border-sky-200">Confirmed</span>
                                @elseif($order->status === 'completed')
                                    <span class="px-2.5 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold border border-emerald-200">Done</span>
                                @else
                                    <span class="px-2.5 py-1 bg-slate-100 text-slate-500 rounded-full text-xs font-bold">Cancel</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-16 text-slate-400 font-medium">
                                📭 Chưa có đơn hàng
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- 4. DASHBOARD (DƯỚI CÙNG THÀNH KHỐI THỐNG KÊ PHỤ) --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <div class="bg-blue border border-blue/50 rounded-2xl p-5 shadow hover:shadow-xl transition hover:-translate-y-1">
                <div class="text-xs text-slate-500">📊 Tổng đơn</div>
                <div class="text-3xl font-extrabold text-sky-600">{{ $orders->count() }}</div>
            </div>

            <div class="bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-5 shadow hover:shadow-xl transition hover:-translate-y-1">
                <div class="text-xs text-slate-500">⏳ Chờ duyệt</div>
                <div class="text-3xl font-extrabold text-amber-500">{{ $orders->where('status','pending')->count() }}</div>
            </div>

            <div class="bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-5 shadow hover:shadow-xl transition hover:-translate-y-1">
                <div class="text-xs text-slate-500">✅ Hoàn thành</div>
                <div class="text-3xl font-extrabold text-emerald-500">{{ $orders->where('status','completed')->count() }}</div>
            </div>

            <div class="bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-5 shadow hover:shadow-xl transition hover:-translate-y-1">
                <div class="text-xs text-slate-500">💳 Đã thanh toán</div>
                <div class="text-3xl font-extrabold text-cyan-600">
                    {{ $orders->whereNotNull('payment_proof')->count() }}
                </div>
            </div>
        </div>

    </div>
</div>

{{-- MODAL PHẦN THANH TOÁN (GIỮ NGUYÊN ĐỊNH VỊ CHÍNH GIỮA MÀN HÌNH) --}}
<div id="global-payment-modal" class="fixed inset-0 hidden bg-slate-950/80 flex items-center justify-center z-[999999] p-4 backdrop-blur-sm">

    <div class="bg-[#0b1220] rounded-[32px] w-full max-w-sm shadow-2xl overflow-hidden border border-sky-500/30 relative transform transition-all duration-200">

        {{-- NÚT ĐÓNG X --}}
        <button type="button"
            onclick="closePaymentModal()"
            class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white text-slate-900 flex items-center justify-center shadow-md hover:bg-rose-500 hover:text-white transition duration-200 z-50 cursor-pointer border border-slate-200">
            <i class="fa-solid fa-xmark text-sm font-black"></i>
        </button>

        <div class="bg-gradient-to-r from-[#008b9a] to-[#00becc] p-5 text-center">
            <span class="text-[10px] bg-black/15 text-slate-900 px-2.5 py-0.5 rounded-full font-extrabold uppercase tracking-wide">VietQR Gateway</span>
            <h4 class="text-sm font-black text-slate-900 mt-1 tracking-wide">THANH TOÁN AN TOÀN</h4>
        </div>

        <div class="p-5 space-y-4">

            <div class="bg-white text-slate-900 p-3.5 rounded-xl flex justify-between items-center shadow-sm">
                <span class="text-xs font-semibold text-slate-600">Tổng tiền:</span>
                <span id="modal-order-price" class="font-black text-base text-slate-900 font-mono">0VND</span>
            </div>

            <div class="bg-white p-3.5 rounded-xl flex justify-center shadow-sm border border-slate-100">
                <img id="modal-qr-img" class="w-48 h-48 object-contain shadow-inner" alt="VietQR Code" />
            </div>

            <form id="modal-payment-form" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="space-y-1">
                    <div class="relative flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-14 border-2 border-dashed border-sky-500/40 hover:border-sky-400 rounded-xl cursor-pointer bg-white hover:bg-slate-50 transition group p-2">
                            <div class="flex items-center gap-2">
                                <i class="fa-regular fa-image text-sky-600 text-sm"></i>
                                <span id="file-name-hint" class="text-xs text-slate-800 font-bold truncate max-w-[240px]">Chọn ảnh hóa đơn xác nhận</span>
                            </div>
                            <input type="file" name="payment_proof" required onchange="displayFileName(this)" class="hidden" />
                        </label>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-[#008b9a] to-[#00becc] text-slate-900 font-black py-2.5 rounded-xl text-xs uppercase tracking-wider shadow-md hover:opacity-95 active:scale-[0.99] transition cursor-pointer">
                    Xác nhận đã chuyển khoản
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function openPaymentModal(btn){
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

function closePaymentModal(){
    document.getElementById('file-name-hint').innerText = "Chọn ảnh hóa đơn xác nhận";
    document.getElementById('file-name-hint').className = "text-xs text-slate-800 font-bold truncate max-w-[240px]";
    document.getElementById('global-payment-modal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function displayFileName(input) {
    const hint = document.getElementById('file-name-hint');
    if (input.files && input.files[0]) {
        hint.innerText = "📸 " + input.files[0].name;
        hint.className = "text-xs text-emerald-600 font-black truncate max-w-[240px]";
    }
}
</script>

</x-app-layout>