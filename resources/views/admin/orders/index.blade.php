<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đơn Hàng - HKT TRAVEL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 text-slate-900 font-sans antialiased">

    <nav class="bg-white shadow-sm border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-8">
                <a href="/" class="text-xl font-black text-blue-600 tracking-wider">HKT <span class="text-orange-500">TRAVEL</span></a>
                <div class="hidden md:flex space-x-4 text-sm font-semibold">
                    <a href="/" class="text-gray-500 hover:text-blue-600 px-3 py-2 transition flex items-center gap-1">🏠 Xem Trang Chủ</a>
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-blue-600 px-3 py-2 transition flex items-center gap-1">📊 Tổng quan hệ thống</a>
                    <a href="{{ route('admin.orders.index') }}" class="text-blue-600 border-b-2 border-blue-600 px-3 py-2 flex items-center gap-1">📋 Quản lý đặt lịch</a>
                    <a href="{{ route('admin.reviews.index') }}" class="text-gray-500 hover:text-blue-600 px-3 py-2 transition flex items-center gap-1">💬 Kiểm duyệt Đánh giá</a>
                </div>
            </div>
            <div class="text-sm font-bold text-gray-700 bg-slate-100 px-4 py-2 rounded-xl flex items-center gap-2">
                <i class="fa-solid fa-user-shield text-blue-600"></i> Quản trị viên Hệ thống
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8 space-y-6">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-200 pb-5">
            <div>
                <h1 class="text-2xl font-black text-slate-800 uppercase flex items-center gap-2">
                    📦 HỆ THỐNG QUẢN LÝ ĐẶT LỊCH ĐƠN HÀNG
                </h1>
                <p class="text-xs text-slate-500 mt-1 font-medium">Xem danh sách, phê duyệt hoặc hủy bỏ các yêu cầu đặt Tour/Xe từ khách hàng.</p>
            </div>
            
            <div class="flex items-center gap-2 bg-white p-1.5 rounded-xl border border-slate-200 shadow-sm text-xs font-bold">
                <span class="text-slate-500 px-2">Dữ liệu thật hệ thống</span>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl text-sm font-bold flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-circle-check text-emerald-500 text-base"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-slate-800 text-white rounded-2xl shadow-xl overflow-hidden border border-slate-700">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-300">
                    <thead class="text-xs uppercase bg-slate-900 text-slate-400 tracking-wider border-b border-slate-700">
                        <tr>
                            <th class="px-6 py-4">Khách hàng / Liên hệ</th>
                            <th class="px-6 py-4">Thông tin dịch vụ</th>
                            <th class="px-6 py-4 text-center">Số lượng</th>
                            <th class="px-6 py-4">Tổng tạm tính</th>
                            <th class="px-6 py-4 text-center">Trạng thái</th>
                            <th class="px-6 py-4 text-right">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700 bg-slate-800/50">
                        @forelse($orders as $order)
                            <tr class="hover:bg-slate-700/40 transition">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-white flex items-center gap-1.5">
                                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                        {{ $order->user->name ?? 'Không rõ danh tính' }}
                                    </div>
                                    <div class="text-xs text-slate-400 mt-0.5">
                                        <i class="fa-regular fa-envelope text-[10px]"></i> {{ $order->user->email ?? 'N/A' }}
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="font-bold text-blue-400 hover:underline max-w-md truncate">
                                        <a href="#">{{ $order->service->title ?? 'Dịch vụ đã bị xóa vĩnh viễn' }}</a>
                                    </div>
                                    <div class="text-xs text-slate-400 mt-1 flex items-center gap-3">
                                        <span>📅 Ngày đặt: <strong>{{ $order->created_at->format('d/m/Y H:i') }}</strong></span>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 text-center font-extrabold text-slate-100 text-base">
                                    {{ $order->quantity }}
                                </td>
                                
                                <td class="px-6 py-4 font-black text-orange-400 text-base tracking-tight">
                                    {{ number_format($order->total_price) }} đ
                                </td>
                                
                                <td class="px-6 py-4 text-center">
                                    @if($order->status === 'approved')
    <span class="inline-flex items-center gap-1 bg-emerald-950 text-emerald-400 text-xs font-black px-3 py-1 rounded-full border border-emerald-800">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Giao dịch thành công
    </span>
@elseif($order->status === 'cancelled')
    <span class="inline-flex items-center gap-1 bg-red-950 text-red-400 text-xs font-black px-3 py-1 rounded-full border border-red-900">
        ❌ Đã hủy bỏ
    </span>
@else
    <span class="inline-flex items-center gap-1 bg-amber-950 text-amber-400 text-xs font-black px-3 py-1 rounded-full border border-amber-800">
        ⏳ Chờ xác nhận
    </span>
@endif
                                </td>
                                
                                <td class="px-6 py-4 text-right">
                                    <div class="inline-flex gap-1.5 justify-end w-full">
                                        @if($order->status === 'pending')
                                            <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn DUYỆT đơn hàng này?')">
                                                @csrf
                                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-2.5 py-1.5 rounded-lg transition shadow-sm flex items-center gap-1">
                                                    <i class="fa-solid fa-check"></i> Duyệt
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn HỦY đơn hàng này?')">
                                                @csrf
                                                <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs px-2.5 py-1.5 rounded-lg transition shadow-sm flex items-center gap-1">
                                                    <i class="fa-solid fa-ban"></i> Hủy
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('CẢNH BÁO: Bạn có chắc chắn muốn XÓA VĨNH VIỄN đơn đặt lịch này khỏi hệ thống không?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold text-xs px-2.5 py-1.5 rounded-lg transition shadow-sm flex items-center gap-1">
                                                <i class="fa-regular fa-trash-can"></i> Xóa
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-slate-400 font-medium">
                                    Hiện tại chưa có yêu cầu đặt lịch nào trong cơ sở dữ liệu.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

</body>
</html>