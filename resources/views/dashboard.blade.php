<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lịch sử đặt Tour / Khách sạn của bạn') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Danh sách dịch vụ đã đặt</h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Tên dịch vụ</th>
                                <th class="px-6 py-3">Số lượng đặt</th>
                                <th class="px-6 py-3">Tổng thanh toán</th>
                                <th class="px-6 py-3">Ngày đặt</th>
                                <th class="px-6 py-3">Trạng thái đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">
                                        {{ $order->service->title }}
                                    </td>
                                    <td class="px-6 py-4">{{ $order->quantity }} vé / phòng</td>
                                    <td class="px-6 py-4 font-semibold text-red-500">
                                        {{ number_format($order->total_price) }} đ
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        {{ $order->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($order->status === 'pending')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                                ⏳ Chờ đối tác duyệt
                                            </span>
                                        @elseif($order->status === 'accepted')
                                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                ✅ Đã xác nhận thành công
                                            </span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                ❌ Đã bị hủy bỏ
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-400">
                                        Bạn chưa thực hiện đơn đặt lịch nào. Quay lại <a href="/" class="text-blue-500 underline">Trang chủ</a> để khám phá ngay!
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