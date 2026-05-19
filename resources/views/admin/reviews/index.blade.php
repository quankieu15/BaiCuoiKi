<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 uppercase tracking-wide">
            {{ __('Hệ thống kiểm duyệt Đánh giá & Bình luận') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded mb-4 text-center font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-gray-500 min-w-full divide-y divide-gray-200">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-3">Khách hàng</th>
                                <th class="px-4 py-3">Dịch vụ</th>
                                <th class="px-4 py-3 text-center">Đánh giá</th>
                                <th class="px-4 py-3">Nội dung bình luận</th>
                                <th class="px-4 py-3 text-center">Trạng thái</th>
                                <th class="px-4 py-3 text-right">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($reviews as $review)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4">
                                        <div class="font-bold text-gray-900">{{ $review->user->name }}</div>
                                        <div class="text-xs text-gray-400">{{ $review->user->email }}</div>
                                    </td>
                                    
                                    <td class="px-4 py-4 font-medium text-blue-600 max-w-xs truncate">
                                        {{ $review->service->title }}
                                    </td>
                                    
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <span class="text-amber-400 font-bold">
                                            {{ str_repeat('⭐', $review->rating) }}
                                        </span>
                                    </td>
                                    
                                    <td class="px-4 py-4 text-sm text-gray-700 max-w-md break-words">
                                        {{ $review->comment }}
                                    </td>
                                    
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        @if($review->is_approved)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                                🟢 Đang hiển thị
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 animate-pulse">
                                                🟡 Chờ kiểm duyệt
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <td class="px-4 py-4 text-right whitespace-nowrap text-sm font-medium">
                                        <div class="flex justify-end items-center space-x-2">
                                            @if(!$review->is_approved)
                                                <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold py-1.5 px-3 rounded shadow-sm transition">
                                                        Phê duyệt
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn bình luận này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold py-1.5 px-3 rounded shadow-sm transition">
                                                    Xóa bỏ
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-gray-400 font-medium">
                                        Hiện tại chưa có đánh giá nào cần kiểm duyệt.
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