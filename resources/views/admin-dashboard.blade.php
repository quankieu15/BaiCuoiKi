<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('BẢNG ĐIỀU KHIỂN TỐI CAO (ADMIN DASHBOARD)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl p-5 border-l-4 border-blue-500">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">Tổng Khách Hàng</div>
                    <div class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalCustomers }}</div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl p-5 border-l-4 border-purple-500">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">Đối Tác Nhà Xe/Ks</div>
                    <div class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalPartners }}</div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl p-5 border-l-4 border-teal-500">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">Tổng Tour & Dịch Vụ</div>
                    <div class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalServices }}</div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl p-5 border-l-4 border-orange-500">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">Tổng Lượt Đặt Lịch</div>
                    <div class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalOrders }}</div>
                </div>

            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">🔔 Các giao dịch đặt lịch mới nhất toàn hệ thống</h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Người đặt</th>
                                <th class="px-6 py-3">Dịch vụ / Tour</th>
                                <th class="px-6 py-3">Số lượng</th>
                                <th class="px-6 py-3">Tổng tiền</th>
                                <th class="px-6 py-3">Trạng thái đơn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                        {{ $order->user->name }}
                                        <div class="text-xs text-gray-400 font-normal">{{ $order->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-blue-500 font-medium">{{ $order->service->title }}</td>
                                    <td class="px-6 py-4">{{ $order->quantity }} chỗ</td>
                                    <td class="px-6 py-4 font-bold text-red-500">{{ number_format($order->total_price) }} đ</td>
                                    <td class="px-6 py-4">
                                        @if($order->status === 'pending')
                                            <span class="text-yellow-500 font-medium">⏳ Đang chờ duyệt</span>
                                        @elseif($order->status === 'accepted')
                                            <span class="text-green-500 font-bold">✅ Đã duyệt</span>
                                        @else
                                            <span class="text-red-500 font-medium">❌ Đã hủy</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-400">Hệ thống chưa ghi nhận giao dịch nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>