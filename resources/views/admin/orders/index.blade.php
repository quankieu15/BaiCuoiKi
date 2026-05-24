    @extends('layouts.admin')

    @section('content')

    <div class="space-y-6">

        {{-- TITLE --}}
        <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl border border-white/50 shadow-lg">

            <div class="flex items-center gap-2 text-[10px] font-extrabold text-blue-600 uppercase tracking-wider mb-1">
                <span>🛡️ Bảng kiểm soát giao dịch</span>
            </div>

            <h2 class="text-2xl font-black text-slate-800 tracking-tight flex items-center gap-2">
                📦 HỆ THỐNG QUẢN LÝ ĐẶT LỊCH ĐƠN HÀNG
            </h2>

            <p class="text-sm text-slate-500 mt-2 font-medium leading-relaxed">
                Xem danh sách, phê duyệt hoặc hủy bỏ các yêu cầu đặt Tour/Xe từ khách hàng trên toàn bộ hệ thống.
            </p>

        </div>

        {{-- SUCCESS --}}
        @if(session('success'))

            <div class="bg-emerald-50 border border-emerald-100 text-emerald-800 p-4 rounded-2xl text-sm font-bold flex items-center gap-3 shadow-sm">

                <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>

                {{ session('success') }}

            </div>

        @endif

        {{-- TABLE --}}
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/50 overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full text-left border-collapse">

                    <thead>

                        <tr class="bg-slate-50 text-slate-500 text-[11px] font-bold uppercase tracking-widest border-b border-slate-100">

                            <th class="px-6 py-4 w-60">
                                Khách hàng / Liên hệ
                            </th>

                            <th class="px-6 py-4">
                                Thông tin dịch vụ
                            </th>

                            <th class="px-6 py-4 text-center w-24">
                                Số lượng
                            </th>

                            <th class="px-6 py-4 w-44">
                                Tổng tạm tính
                            </th>

                            <th class="px-6 py-4 text-center w-48">
                                Trạng thái
                            </th>

                            <th class="px-6 py-4 text-center w-52">
                                Hành động
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100 text-sm text-slate-600">

                        @forelse($orders as $order)

                            <tr class="hover:bg-sky-50/40 transition-all duration-200">

                                {{-- USER --}}
                                <td class="px-6 py-5">

                                    <div class="font-bold text-slate-800 text-base flex items-center gap-2">

                                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>

                                        {{ $order->user->name ?? 'Không rõ danh tính' }}

                                    </div>

                                    <div class="text-xs text-slate-400 font-medium mt-1 flex items-center gap-1.5 pl-4">

                                        <i class="fa-regular fa-envelope text-[11px]"></i>

                                        {{ $order->user->email ?? 'N/A' }}

                                    </div>

                                </td>

                                {{-- SERVICE --}}
                                <td class="px-6 py-5">

                                    <div class="font-bold text-sky-600 hover:text-sky-700 transition-colors max-w-md truncate text-sm">

                                        <a href="#" class="hover:underline">

                                            {{ $order->service->title ?? 'Dịch vụ đã bị xóa vĩnh viễn' }}

                                        </a>

                                    </div>

                                    <div class="text-xs text-slate-400 font-bold font-mono mt-1 flex items-center gap-1">

                                        <i class="fa-regular fa-calendar-check text-[11px]"></i>

                                        Ngày đặt:
                                        {{ $order->created_at->format('d/m/Y H:i') }}

                                    </div>

                                </td>

                                {{-- QUANTITY --}}
                                <td class="px-6 py-5 text-center">

                                    <span class="inline-flex items-center justify-center px-3 py-1 bg-slate-100 text-slate-700 rounded-lg font-extrabold font-mono text-xs border border-slate-200">

                                        {{ $order->quantity }}

                                    </span>

                                </td>

                                {{-- PRICE --}}
                                <td class="px-6 py-5">

                                    <span class="font-black text-orange-600 text-base font-mono tracking-tight">

                                        {{ number_format($order->total_price) }}đ

                                    </span>

                                </td>

                               {{-- STATUS --}}
<td class="px-6 py-5 text-center whitespace-nowrap">

    @if(in_array($order->status, ['approved', 'accepted', 'confirmed']))

        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-xl border border-emerald-100">

            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>

            Đã xác nhận

        </span>

    @elseif($order->status === 'cancelled')

        <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-600 text-xs font-bold px-3 py-1.5 rounded-xl border border-rose-100">

            <i class="fa-solid fa-circle-xmark text-rose-400"></i>

            Đã hủy

        </span>

    @else

        <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 text-xs font-bold px-3 py-1.5 rounded-xl border border-amber-100">

            <i class="fa-solid fa-clock text-amber-400"></i>

            Chờ xác nhận

        </span>

    @endif

</td>

                                {{-- ACTION --}}
                                <td class="px-6 py-5 text-center whitespace-nowrap">

                                    <div class="inline-flex items-center gap-2 justify-center w-full">

                                        @if($order->status === 'pending')

                                            <form action="{{ route('admin.orders.approve', $order->id) }}"
                                                method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Bạn chắc chắn muốn DUYỆT đơn hàng này?')">

                                                @csrf

                                                <button type="submit"
                                                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-3 py-2 rounded-xl transition flex items-center gap-1">

                                                    <i class="fa-solid fa-check text-[10px]"></i>

                                                    Duyệt

                                                </button>

                                            </form>

                                            <form action="{{ route('admin.orders.cancel', $order->id) }}"
                                                method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Bạn chắc chắn muốn HỦY đơn hàng này?')">

                                                @csrf

                                                <button type="submit"
                                                        class="bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs px-3 py-2 rounded-xl transition flex items-center gap-1">

                                                    <i class="fa-solid fa-ban text-[10px]"></i>

                                                    Hủy

                                                </button>

                                            </form>

                                        @endif

                                        <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                            method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn XÓA đơn này?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="text-xs font-bold text-rose-600 hover:bg-rose-50 px-3 py-2 rounded-xl transition flex items-center gap-1">

                                                <i class="fa-regular fa-trash-can text-[11px]"></i>

                                                Xóa

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                    @empty

                            <tr>

                                <td colspan="6" class="px-6 py-20 text-center text-slate-400 bg-slate-50/50">

                                    <div class="text-6xl mb-4 animate-bounce">
                                        🛡️
                                    </div>

                                    <div class="text-base font-black text-slate-700 uppercase tracking-wider">
                                        XÁC NHẬN: BẠN ĐANG TRUY CẬP QUYỀN ADMIN TỐI CAO
                                    </div>

                                    <p class="text-sm text-slate-500 mt-2 font-medium">
                                        Hệ thống điều hướng chuẩn xác! Tuy nhiên, hiện tại <strong class="text-blue-600">chưa có khách hàng nào đặt lịch</strong> trên hệ thống nên danh sách đang trống.
                                    </p>
                                    
                                    <div class="mt-4">
                                        <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-xl border border-blue-100">
                                            URL Hiện Tại: {{ request()->path() }}
                                        </span>
                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    @endsection