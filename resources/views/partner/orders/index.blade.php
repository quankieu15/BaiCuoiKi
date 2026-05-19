<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 mb-2 uppercase tracking-wide">
            {{ __('Quản lý Đơn đặt lịch (Bookings từ khách hàng)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-gray-500 dark:text-gray-400 min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-4 py-3">Khách hàng</th>
                                <th class="px-4 py-3">Dịch vụ yêu cầu</th>
                                <th class="px-4 py-3 text-center">Số lượng</th>
                                <th class="px-4 py-3">Tổng tiền</th>
                                <th class="px-4 py-3 text-center">Trạng thái</th>
                                <th class="px-4 py-3">Hành động duyệt đơn</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($orders as $order)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td class="px-4 py-4 dark:text-white">
                                        <div class="font-bold text-gray-900 dark:text-white">{{ $order->user->name }}</div>
                                        <div class="text-xs text-gray-400">SĐT: {{ $order->user->phone ?? 'Chưa cập nhật' }}</div>
                                    </td>
                                    <td class="px-4 py-4 font-semibold text-blue-600 dark:text-blue-400 max-w-xs truncate">
                                        {{ $order->service->title }}
                                    </td>
                                    
                                    <td class="px-4 py-4 text-center whitespace-nowrap font-medium text-gray-900 dark:text-white">
                                        {{ $order->quantity }} 
                                        @if(\Illuminate\Support\Str::contains(\Illuminate\Support\Str::lower($order->service->title), ['xe', 'ô tô', 'tự lái']))
                                            xe
                                        @elseif(\Illuminate\Support\Str::contains(\Illuminate\Support\Str::lower($order->service->title), ['vé', 'vinwonders', 'cổng', 'vào']))
                                            vé
                                        @else
                                            người
                                        @endif
                                    </td>
                                    
                                    <td class="px-4 py-4 text-red-600 dark:text-red-400 font-bold whitespace-nowrap">
                                        {{ number_format($order->total_price) }}đ
                                    </td>

                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        @if($order->status === 'pending')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 dark:bg-amber-400"></span>
                                                Chờ duyệt
                                            </span>
                                        @elseif($order->status === 'approved' || $order->status === 'accepted')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400 animate-pulse"></span>
                                                Đã xác nhận
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 dark:bg-rose-400"></span>
                                                Đã hủy bỏ
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap">
                                        @if($order->status === 'pending')
                                            <div class="flex items-center space-x-2">
                                                
                                                <form action="{{ route('partner.orders.updateStatus', $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT') <input type="hidden" name="status" value="accepted">
                                                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold py-1.5 px-3 rounded-lg shadow-sm transition-all duration-150">
                                                        Duyệt đơn
                                                    </button>
                                                </form>

                                                <form action="{{ route('partner.orders.updateStatus', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn từ chối đơn này?')">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold py-1.5 px-3 rounded-lg shadow-sm transition-all duration-150">
                                                        Hủy đơn
                                                    </button>
                                                </form>

                                            </div>
                                        @else
                                            <div class="flex flex-col items-start gap-1">
                                                <span class="text-gray-400 dark:text-gray-500 text-xs font-medium">✓ Xử lý xong</span>
                                                <span class="text-[11px] text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700/50 px-1.5 py-0.5 rounded">
                                                    {{ $order->updated_at->format('H:i d/m/Y') }}
                                                </span>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-gray-400 font-medium">
                                        Chưa có khách hàng nào đặt dịch vụ của bạn.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>