<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-5 bg-gray-50 dark:bg-gray-900/50">
                        <h4 class="font-semibold text-blue-500 mb-2">📦 Quản lý bài đăng dịch vụ</h4>
                        <p class="text-xs text-gray-500 mb-4">Thêm mới, sửa đổi thông tin hoặc tạm dừng hiển thị các gói Tour và phòng Khách sạn của bạn.</p>
                        <a href="{{ route('partner.services.index') }}" class="inline-block bg-blue-600 text-white text-xs font-bold px-4 py-2 rounded hover:bg-blue-700">
                            Truy cập ngay ➔
                        </a>
                    </div>

                    <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-5 bg-gray-50 dark:bg-gray-900/50 opacity-60">
                        <h4 class="font-semibold text-green-500 mb-2">📋 Quản lý đơn đặt hàng (Booking)</h4>
                        <p class="text-xs text-gray-500 mb-4">Xem danh sách khách hàng đã đặt lịch, duyệt trạng thái đơn hàng và liên hệ đón khách.</p>
                        <button disabled class="text-xs font-bold text-gray-400 cursor-not-allowed">
                            Chức năng đang phát triển...
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>