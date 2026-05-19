<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-blue-900 tracking-wide uppercase">
            {{ __('TRANG TRUNG TÂM ĐỐI TÁC (PARTNER)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="text-gray-900 dark:text-gray-100 mb-6">
                    <h3 class="text-lg font-bold mb-2">Xin chào, {{ auth()->user()->name }}!</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Chào mừng bạn đến với hệ thống quản lý dành cho nhà cung cấp dịch vụ du lịch.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 mt-4">
                    
                    <div class="bg-gradient-to-br from-emerald-50 to-white dark:from-gray-700/30 dark:to-gray-800 overflow-hidden shadow-sm rounded-xl p-6 border-l-4 border-emerald-500 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">💰 Tổng doanh thu</p>
                                <p class="text-2xl font-extrabold text-emerald-600 dark:text-emerald-400 mt-2">
                                    {{ number_format($totalRevenue) }}đ
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-amber-50 to-white dark:from-gray-700/30 dark:to-gray-800 overflow-hidden shadow-sm rounded-xl p-6 border-l-4 border-amber-500 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">⏳ Đơn chờ duyệt</p>
                                <p class="text-2xl font-extrabold text-amber-600 dark:text-amber-400 mt-2">
                                    {{ $pendingOrders }} <span class="text-xs font-medium text-gray-400">đơn</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-white dark:from-gray-700/30 dark:to-gray-800 overflow-hidden shadow-sm rounded-xl p-6 border-l-4 border-blue-500 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">📦 Dịch vụ đang bán</p>
                                <p class="text-2xl font-extrabold text-blue-600 dark:text-blue-400 mt-2">
                                    {{ $totalServices }} <span class="text-xs font-medium text-gray-400">dịch vụ</span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                <hr class="border-gray-100 dark:border-gray-700 my-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-5 bg-gray-50 dark:bg-gray-900/50">
                        <h4 class="text-xl font-bold text-blue-900 dark:text-blue-400 tracking-wide uppercase mb-1">📦 Quản lý bài đăng dịch vụ</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Thêm mới, sửa đổi thông tin hoặc tạm dừng hiển thị các gói Tour và phòng Khách sạn của bạn.</p>
                        <a href="{{ route('partner.services.index') }}" class="inline-block bg-blue-600 text-white text-xs font-bold px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-150 shadow-sm">
                            Truy cập ngay ➔
                        </a>
                    </div>

                    <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-5 bg-gray-50 dark:bg-gray-900/50">
                        <h4 class="text-xl font-bold text-blue-900 dark:text-blue-400 tracking-wide uppercase mb-1">📋 Quản lý đơn đặt hàng (Booking)</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Xem danh sách khách hàng đã đặt lịch, duyệt trạng thái đơn hàng và liên hệ đón khách.</p>
                        <a href="{{ route('partner.orders.index') }}" class="inline-block bg-indigo-600 text-white text-xs font-bold px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-150 shadow-sm">
                            Xử lý đơn đặt lịch ➔
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>