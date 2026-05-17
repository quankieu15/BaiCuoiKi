<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
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
                <table class="w-full text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-3">Khách hàng</th>
                            <th class="px-4 py-3">Dịch vụ yêu cầu</th>
                            <th class="px-4 py-3">Số lượng</th>
                            <th class="px-4 py-3">Tổng tiền</th>
                            <th class="px-4 py-3">Trạng thái</th>
                            <th class="px-4 py-3">Hành động duyệt đơn</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-4 py-4 dark:text-white">
                                    <div class="font-bold">{{ $order->user->name }}</div>
                                    <div class="text-xs text-gray-400">SĐT: {{ $order->user->phone ?? 'Chưa cập nhật' }}</div>
                                </td>
                                <td class="px-4 py-4 font-semibold text-blue-500">{{ $order->service->title }}</td>
                                <td class="px-4 py-4 text-center">{{ $order->quantity }} người</td>
                                <td class="px-4 py-4 text-red-500 font-bold">{{ number_format($order->total_price) }} đ</td>
                                <td class="px-4 py-4">
                                    @if($order->status === 'pending')
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Chờ duyệt</span>
                                    @elseif($order->status === 'accepted')
                                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Đã xác nhận</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Đã hủy bỏ</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4">
                                    @if($order->status === 'pending')
                                        <div class="flex space-x-2">
                                            <form action="{{ route('partner.orders.status', $order->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="accepted">
                                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-1 px-3 rounded">
                                                    Duyệt đơn
                                                </button>
                                            </form>
                                            <form action="{{ route('partner.orders.status', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn từ chối đơn này?')">
                                                @csrf
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-1 px-3 rounded">
                                                    Hủy đơn
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-400">Xử lý xong</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-400">Chưa có khách hàng nào đặt dịch vụ của bạn.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>