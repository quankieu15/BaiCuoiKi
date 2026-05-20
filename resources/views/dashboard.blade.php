<x-app-layout>

{{-- FONT SAAS --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Inter', sans-serif;
}

/* ===== OCEAN BACKGROUND (3 LAYERS) ===== */
.ocean-bg {
    position: fixed;
    inset: 0;
    z-index: -1;
    background: linear-gradient(135deg, #dff6ff, #bfe9ff, #e6f7ff);
    overflow: hidden;
}

/* wave layer 1 */
.ocean-bg::before {
    content: "";
    position: absolute;
    width: 200%;
    height: 200%;
    top: -50%;
    left: -50%;
    background: radial-gradient(circle at 30% 40%, rgba(255,255,255,0.6), transparent 60%);
    animation: floatWave 18s linear infinite;
}

/* wave layer 2 */
.ocean-bg::after {
    content: "";
    position: absolute;
    width: 200%;
    height: 200%;
    top: -40%;
    left: -40%;
    background: radial-gradient(circle at 70% 60%, rgba(255,255,255,0.4), transparent 55%);
    animation: floatWave 25s linear infinite reverse;
    filter: blur(20px);
}

@keyframes floatWave {
    0% { transform: translate(0,0) rotate(0deg); }
    50% { transform: translate(3%,2%) rotate(180deg); }
    100% { transform: translate(0,0) rotate(360deg); }
}

/* shimmer loading */
.shimmer {
    position: relative;
    overflow: hidden;
}
.shimmer::after {
    content: "";
    position: absolute;
    top: 0;
    left: -150%;
    width: 150%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
    animation: shimmer 1.4s infinite;
}
@keyframes shimmer {
    0% { left: -150%; }
    100% { left: 150%; }
}
</style>

<div class="ocean-bg"></div>

{{-- HEADER --}}
<x-slot name="header">
    <div class="rounded-2xl p-6 bg-white/40 backdrop-blur-xl border border-white/40 shadow-lg relative overflow-hidden">

        <div class="absolute -top-10 -right-10 w-60 h-60 bg-cyan-200 blur-3xl opacity-30 rounded-full"></div>
        <div class="absolute -bottom-10 -left-10 w-60 h-60 bg-sky-300 blur-3xl opacity-30 rounded-full"></div>

        <div class="relative">
            <div class="text-xs font-bold text-sky-600 tracking-widest">
                🌊 OCEAN BOOKING SYSTEM
            </div>

            <h2 class="text-2xl font-black text-slate-800 mt-1">
                🧳 Lịch sử đặt Tour / Khách sạn
            </h2>



            <div class="mt-4 flex gap-3 text-xs font-bold text-slate-700">

                <span class="px-3 py-1 rounded-full bg-white/60 shadow">
                    📦 {{ $orders->count() }}
                </span>

                <span class="px-3 py-1 rounded-full bg-white/60 shadow">
                    💰 {{ number_format($orders->sum('total_price')) }}đ
                </span>

            </div>
        </div>
    </div>
</x-slot>

{{-- BODY --}}
<div class="py-10 min-h-screen text-slate-700">

<div class="max-w-7xl mx-auto px-4">

    {{-- DASHBOARD --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">

        <div class="bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-5 shadow hover:shadow-xl transition hover:-translate-y-1">
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

    {{-- FILTER --}}
    <div class="bg-white/70 backdrop-blur-xl border border-white/50 rounded-2xl p-4 mb-6 shadow">

        <form method="GET" class="flex gap-3">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="🔍 Tìm dịch vụ..."
                   class="w-full px-4 py-2 rounded-xl border text-sm focus:outline-none focus:ring-2 focus:ring-sky-300">

            <select name="status" class="px-3 py-2 rounded-xl border text-sm">

                <option value="">Tất cả</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="accepted">Accepted</option>
                <option value="approved">Approved</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>

            </select>

            <button class="bg-sky-500 hover:bg-sky-600 text-black px-5 rounded-xl text-sm font-bold transition">
                Lọc
            </button>

        </form>

    </div>

    {{-- TABLE --}}
    <div class="bg-white/70 backdrop-blur-xl border border-white/50 rounded-2xl overflow-hidden shadow-lg">

        <div class="p-5 border-b">
            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                🌊 Danh sách đơn hàng
            </h3>
        </div>

        <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-sky-50 text-xs text-slate-500 uppercase">
                <tr>
                    <th class="p-4">Mã</th>
                    <th>Dịch vụ</th>
                    <th>SL</th>
                    <th>Ngày</th>
                    <th>Thanh toán</th>
                    <th>Note</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>

            <tbody>

            @forelse($orders as $order)

            <tr class="border-b hover:bg-sky-50/60 transition">

                <td class="text-center text-slate-500 font-mono">#{{ $order->id }}</td>

                <td class="font-semibold text-slate-800">
                    {{ $order->service->title ?? 'Deleted' }}
                </td>

                <td class="text-center">{{ $order->quantity }}</td>

                <td class="text-center text-xs">
                    {{ $order->booking_date ? \Carbon\Carbon::parse($order->booking_date)->format('d/m/Y') : '---' }}
                </td>

                <td>
                    <div class="font-bold text-sky-600">
                        {{ number_format($order->total_price) }}đ
                    </div>

                    @if(!$order->payment_proof)
                        <button onclick="openPaymentModal(this)"
                            data-id="{{ $order->id }}"
                            data-price="{{ $order->total_price }}"
                            data-formatted-price="{{ number_format($order->total_price) }}đ"
                            data-route="{{ route('orders.uploadProof', $order->id) }}"
                            class="mt-1 text-xs bg-sky-500 text-black px-3 py-1 rounded-lg">
                            QR / Upload
                        </button>
                    @else
                        <a class="text-sky-600 text-xs underline"
                           href="{{ asset('storage/'.$order->payment_proof) }}">
                            Xem bill
                        </a>
                    @endif
                </td>

                <td class="text-xs text-slate-400 text-center">
                    {{ $order->note ?? '---' }}
                </td>

                <td class="text-xs text-center">
                    {{ $order->created_at->format('d/m/Y H:i') }}
                </td>

                <td class="text-center">
                    @if($order->status === 'pending')
                        <span class="px-2 py-1 bg-amber-100 text-amber-600 rounded-full text-xs">Pending</span>
                    @elseif(in_array($order->status,['confirmed','accepted','approved']))
                        <span class="px-2 py-1 bg-sky-100 text-sky-600 rounded-full text-xs">Confirmed</span>
                    @elseif($order->status === 'completed')
                        <span class="px-2 py-1 bg-emerald-100 text-emerald-600 rounded-full text-xs">Done</span>
                    @else
                        <span class="px-2 py-1 bg-slate-100 text-slate-500 rounded-full text-xs">Cancel</span>
                    @endif
                </td>

            </tr>

            @empty
                <tr>
                    <td colspan="8" class="text-center py-10 text-slate-400">
                        Không có đơn hàng
                    </td>
                </tr>
            @endforelse

            </tbody>

        </table>

        </div>

    </div>

</div>
</div>

{{-- MODAL GIỮ NGUYÊN LOGIC --}}
<div id="global-payment-modal" class="fixed inset-0 hidden bg-black/40 backdrop-blur flex items-center justify-center">

<div class="bg-white p-6 rounded-2xl w-[380px] shadow-2xl">

    <img id="modal-qr-img" class="w-48 mx-auto" />
    <p id="modal-order-price" class="text-center font-bold mt-2"></p>

    <form id="modal-payment-form" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" name="payment_proof" class="w-full mt-3 text-sm">

        <button class="w-full mt-3 bg-sky-500 text-white py-2 rounded-xl">
            Upload
        </button>
    </form>

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
}

function closePaymentModal(){
    document.getElementById('global-payment-modal').classList.add('hidden');
}
</script>

</x-app-layout>