<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-slate-800 mb-6 uppercase tracking-wide">
            {{ __('Quản lý Bài đăng Dịch vụ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">📦 Danh sách dịch vụ của bạn</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Thêm mới hoặc sửa đổi các gói Tour, Khách sạn, Gọi xe, Thuê xe của bạn.</p>
                    </div>
                    <a href="{{ route('partner.services.create') }}" class="inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white font-bold text-xs uppercase tracking-wider rounded-md shadow-md transition duration-150">
                        + Thêm dịch vụ mới
                    </a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 text-sm rounded-md shadow-sm font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-left text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-400 uppercase text-xs font-bold">
                            <tr>
                                <th class="px-6 py-3">Hình ảnh</th>
                                <th class="px-6 py-3">Tên dịch vụ</th>
                                <th class="px-6 py-3">Địa điểm</th>
                                <th class="px-6 py-3">Giá bán</th>
                                <th class="px-6 py-3 text-right">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-600 dark:text-gray-300">
                            @forelse($services as $service)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <img src="{{ $service->image ? asset($service->image) : 'https://placehold.co/600x400?text=No+Image' }}" class="w-16 h-10 object-cover rounded-lg shadow-sm">
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                        {{ $service->title }}
                                    </td>
                                    <td class="px-6 py-4">
                                        📍 {{ $service->location }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-orange-600">
                                        {{ number_format($service->price) }}đ
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <a href="{{ route('partner.services.edit', $service->id) }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Sửa</a>
                                        <form action="{{ route('partner.services.destroy', $service->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa dịch vụ này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:underline cursor-pointer">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                        Chưa có dịch vụ nào được đăng bán.
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