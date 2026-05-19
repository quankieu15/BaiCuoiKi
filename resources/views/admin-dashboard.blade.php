<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-blue-900 tracking-wide uppercase">
            BẢNG ĐIỀU KHIỂN TỐI CAO (ADMIN DASHBOARD)
        </h1>
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
                <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        🔔 Các giao dịch đặt lịch mới nhất toàn hệ thống
                    </h3>
                    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-3 py-2 rounded-lg transition-colors shadow-sm">
                        ⚙️ Quản lý tất cả đơn hàng
                    </a>
                </div>
                
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
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition">
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                        {{ $order->user->name ?? 'N/A' }}
                                        <div class="text-xs text-gray-400 font-normal">{{ $order->user->email ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-blue-500 font-medium">{{ $order->service->title ?? 'Dịch vụ đã bị xóa' }}</td>
                                    <td class="px-6 py-4 font-semibold">{{ $order->quantity }}</td>
                                    <td class="px-6 py-4 font-bold text-red-500">{{ number_format($order->total_price) }} VND</td>
                                    <td class="px-6 py-4">
                                        @if($order->status === 'pending')
                                            <span class="text-yellow-500 font-medium">⏳ Đang chờ duyệt</span>
                                        @elseif($order->status === 'approved')
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