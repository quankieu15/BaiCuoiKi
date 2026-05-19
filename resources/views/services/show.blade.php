<div class="mt-8 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
        💬 Đánh giá & Bình luận từ khách hàng
    </h3>

    <div class="space-y-4 mb-8">
        @forelse($service->reviews->where('is_approved', 1) as $review)
            <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 flex gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold shrink-0">
                    {{ substr($review->user->name, 0, 1) }}
                </div>
                
                <div class="space-y-1 w-full">
                    <div class="flex items-center justify-between">
                        <h4 class="font-bold text-gray-800 text-sm">{{ $review->user->name }}</h4>
                        <span class="text-xs text-gray-400">
                            {{ $review->created_at->diffForHumans() }}
                        </span>
                    </div>
                    
                    <div class="text-amber-400 text-xs">
                        {{ str_repeat('⭐', $review->rating) }}
                    </div>
                    
                    <p class="text-gray-600 text-sm mt-1 leading-relaxed">
                        {{ $review->comment }}
                    </p>
                </div>
            </div>
        @empty
            <div class="text-center py-6 text-gray-400 text-sm">
                📌 Chưa có đánh giá nào cho dịch vụ này. Hãy là người đầu tiên chia sẻ trải nghiệm nhé!
            </div>
        @endforelse
    </div>

    <hr class="border-gray-100 my-6">

    @auth
        <form action="{{ route('reviews.store', $service->id) }}" method="POST" class="space-y-4 bg-slate-50/50 p-4 rounded-xl border border-dashed border-gray-200">
            @csrf
            <h4 class="font-bold text-gray-800 text-sm">✍️ Chia sẻ trải nghiệm của bạn</h4>
            
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Mức độ hài lòng:</label>
                <select name="rating" class="w-full text-sm rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="5">⭐⭐⭐⭐⭐ (Tuyệt vời)</option>
                    <option value="4">⭐⭐⭐⭐ (Tốt)</option>
                    <option value="3">⭐⭐⭐ (Bình thường)</option>
                    <option value="2">⭐⭐ (Kém)</option>
                    <option value="1">⭐ (Tệ)</option>
                </select>
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Nội dung bình luận:</label>
                <textarea name="comment" rows="3" required class="w-full text-sm rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Tour này hướng dẫn viên có nhiệt tình không? Phòng khách sạn có sạch sẽ không?..."></textarea>
            </div>
            
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded-lg transition text-xs shadow-sm">
                Gửi đánh giá (Cần duyệt)
            </button>
        </form>
    @else
        <div class="bg-gray-50 p-4 rounded-xl text-center text-sm text-gray-500">
            🔒 Vui lòng <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Đăng nhập</a> để viết đánh giá cho dịch vụ này.
        </div>
    @endauth
</div>