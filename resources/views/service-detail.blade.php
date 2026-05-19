<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service->title }} - HKT TRAVEL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-900 font-sans">

    @php
        // 1. Nhận diện loại dịch vụ ngay từ đầu trang để đồng bộ toàn cục
        $isCar = \Illuminate\Support\Str::contains(\Illuminate\Support\Str::lower($service->title), ['xe', 'ô tô', 'tự lái']);
        $isTicket = \Illuminate\Support\Str::contains(\Illuminate\Support\Str::lower($service->title), ['vé', 'vinwonders', 'cổng', 'cửa']);
    @endphp

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="/" class="text-xl font-black text-blue-600 tracking-wider">HKT <span class="text-orange-500">TRAVEL</span></a>
            <a href="/" class="text-sm font-bold text-gray-500 hover:text-blue-600 flex items-center gap-1">
                ↩️ Quay lại trang chủ
            </a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8">
        
        <div class="mb-6">
            <span class="bg-blue-100 text-blue-700 text-xs font-black px-3 py-1 rounded-full uppercase tracking-wider">
                📍 {{ $service->location }}
            </span>
            <h1 class="text-2xl md:text-4xl font-black text-slate-800 mt-2 leading-tight">
                {{ $service->title }}
            </h1>
        </div>

        <div class="w-full aspect-[21/9] rounded-3xl overflow-hidden shadow-md mb-8 bg-slate-200">
            @if($service->image)
                <img src="{{ asset($service->image) }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-slate-400">Chưa cập nhật hình ảnh</div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="lg:col-span-2 space-y-6">
                
                @if($isCar)
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <h2 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">
                            ⚙️ Thông số kỹ thuật của xe
                        </h2>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-slate-50 p-3.5 rounded-xl text-center">
                                <span class="block text-xs font-bold text-slate-400 uppercase">Số chỗ</span>
                                <span class="text-base font-black text-slate-700 mt-1 block">5 - 7 Chỗ</span>
                            </div>
                            <div class="bg-slate-50 p-3.5 rounded-xl text-center">
                                <span class="block text-xs font-bold text-slate-400 uppercase">Truyền động</span>
                                <span class="text-base font-black text-slate-700 mt-1 block">Số tự động</span>
                            </div>
                            <div class="bg-slate-50 p-3.5 rounded-xl text-center">
                                <span class="block text-xs font-bold text-slate-400 uppercase">Nhiên liệu</span>
                                <span class="text-base font-black text-slate-700 mt-1 block">Xăng / Dầu</span>
                            </div>
                            <div class="bg-slate-50 p-3.5 rounded-xl text-center">
                                <span class="block text-xs font-bold text-slate-400 uppercase">Đời xe</span>
                                <span class="text-base font-black text-slate-700 mt-1 block">2022 - 2025</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-amber-50/60 border border-amber-100 p-6 rounded-2xl">
                        <h3 class="font-black text-amber-800 mb-2 flex items-center gap-1.5">📑 Thủ tục nhận xe tự lái cần có:</h3>
                        <ul class="text-sm text-amber-900 space-y-1.5 list-disc pl-5 font-medium">
                            <li>Căn cước công dân gắn chíp (Bản gốc đối chiếu).</li>
                            <li>Bằng lái xe hạng B1 / B2 trở lên còn hạn.</li>
                            <li>Tài sản thế chấp: Xe máy hoặc 15.000.000đ tiền mặt.</li>
                        </ul>
                    </div>

                @elseif($isTicket)
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <h2 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">
                            ✨ Đặc điểm nổi bật của Vé
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="flex items-center gap-3 border border-slate-100 p-4 rounded-xl">
                                <span class="text-2xl">📱</span>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-400 uppercase">Hình thức nhận</h4>
                                    <p class="text-sm font-black text-slate-700">Vé điện tử (QR Code)</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 border border-slate-100 p-4 rounded-xl">
                                <span class="text-2xl">⚡</span>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-400 uppercase">Xác nhận</h4>
                                    <p class="text-sm font-black text-slate-700">Có kết quả tức thì</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 border border-slate-100 p-4 rounded-xl">
                                <span class="text-2xl">📅</span>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-400 uppercase">Chính sách hủy</h4>
                                    <p class="text-sm font-black text-red-500">Không hoàn hủy vé</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50/60 border border-blue-100 p-5 rounded-2xl text-sm text-blue-900 font-medium">
                        💡 <strong>Hướng dẫn sử dụng:</strong> Sau khi hệ thống xác nhận đặt lịch, mã vé QR Code sẽ được chuẩn bị sẵn sàng. Bạn chỉ cần đưa mã quét tại quầy soát vé vào cửa công viên giải trí.
                    </div>
                @endif

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 space-y-4">
                    <h2 class="text-lg font-black text-slate-800 pb-2 border-b border-slate-100">
                        📝 Thông tin chi tiết dịch vụ
                    </h2>
                    <div class="prose max-w-none text-slate-600 leading-relaxed text-sm space-y-4">
                        {!! $service->description !!}
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-left">
                    <h3 class="text-lg font-black text-gray-900 mb-6 flex items-center gap-2">
                        💬 Đánh giá từ khách hàng
                    </h3>

                    <div class="space-y-4 mb-8">
                        @if(isset($approvedReviews) && $approvedReviews->count() > 0)
                            @foreach($approvedReviews as $review)
                                <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 flex gap-3 text-left">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold shrink-0 text-sm">
                                        {{ $review->user ? substr($review->user->name, 0, 1) : 'K' }}
                                    </div>
                                    
                                    <div class="space-y-1 w-full">
                                        <div class="flex items-center justify-between">
                                            <h4 class="font-bold text-gray-800 text-sm">{{ $review->user->name ?? 'Khách hàng ẩn danh' }}</h4>
                                            <span class="text-xs text-gray-400">
                                                {{ $review->created_at ? $review->created_at->diffForHumans() : '' }}
                                            </span>
                                        </div>
                                        
                                        <div class="text-amber-400 text-xs">
                                            {{ str_repeat('⭐', $review->rating ?? 5) }}
                                        </div>
                                        
                                        <p class="text-gray-600 text-sm mt-1 leading-relaxed">
                                            {{ $review->comment }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8 text-gray-400 text-sm font-medium bg-slate-50 rounded-xl border border-dashed border-gray-200">
                                📌 Chưa có đánh giá nào được duyệt cho dịch vụ này. Hãy là người đầu tiên chia sẻ trải nghiệm nhé!
                            </div>
                        @endif
                    </div>

                    <hr class="border-gray-100 my-6">

                    @auth
                        <form action="{{ route('reviews.store', $service->id) }}" method="POST" class="space-y-4 bg-slate-50/50 p-5 rounded-xl border border-dashed border-gray-200 text-left">
                            @csrf
                            <h4 class="font-bold text-gray-800 text-sm flex items-center gap-1">✍️ Chia sẻ trải nghiệm thực tế của bạn</h4>
                            
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1">Mức độ hài lòng:</label>
                                <select name="rating" class="w-full text-sm rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                                    <option value="5">⭐⭐⭐⭐⭐ (Tuyệt vời)</option>
                                    <option value="4">⭐⭐⭐⭐ (Tốt)</option>
                                    <option value="3">⭐⭐⭐ (Bình thường)</option>
                                    <option value="2">⭐⭐ (Kém)</option>
                                    <option value="1">⭐ (Tệ)</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1">Nội dung bình luận:</label>
                                <textarea name="comment" rows="3" required class="w-full text-sm rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border" placeholder="Dịch vụ có đúng như mô tả không? Bạn có hài lòng không?..."></textarea>
                            </div>
                            
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded-lg transition text-xs shadow-sm">
                                Gửi đánh giá (Chờ phê duyệt)
                            </button>
                        </form>
                    @else
                        <div class="bg-slate-50 p-4 rounded-xl text-center text-sm text-gray-500 border border-gray-100">
                            🔒 Vui lòng <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Đăng nhập</a> để viết đánh giá cho dịch vụ này.
                        </div>
                    @endauth
                </div>

            </div>

            <div class="lg:col-span-1 lg:sticky lg:top-24">
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-slate-100 space-y-5">
                    
                    <div>
                        <span class="text-xs font-bold text-slate-400 uppercase block">Giá niêm yết từ</span>
                        <div class="flex items-baseline gap-1 mt-1">
                            <span class="text-2xl md:text-3xl font-black text-red-500">{{ number_format($service->price) }}</span>
                            <span class="text-sm font-bold text-red-500">đ / lượt</span>
                        </div>
                    </div>

                    <hr class="border-slate-100">

                    @guest
                        <div class="bg-amber-50 text-amber-700 p-4 rounded-xl text-center text-xs font-bold border border-amber-200">
                            🔒 Vui lòng <a href="{{ route('login') }}" class="underline text-blue-600">Đăng nhập</a> tài khoản Khách hàng để tiến hành đặt dịch vụ này.
                        </div>
                    @else
                        @if(auth()->user()->role === 'customer')
                            
                            @if(session('success'))
                                <div class="bg-green-50 text-green-700 p-3 rounded-xl text-xs font-bold border border-green-200">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('services.book', $service->id) }}" method="POST" class="space-y-4">
                                @csrf
                                
                                <div>
                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-1">
                                        {{ $isCar ? '🚗 Số lượng ngày thuê xe:' : ($isTicket ? '🎟/👤 Số lượng vé đặt:' : '👥 Số người tham gia:') }}
                                    </label>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="w-full bg-slate-50 rounded-xl font-black text-slate-800 text-center py-2.5 border border-slate-200/60 focus:outline-none focus:border-blue-500 transition text-sm">
                                </div>

                                <div>
                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-1">
                                        📅 {{ $isCar ? 'Ngày nhận xe:' : ($isTicket ? 'Ngày sử dụng vé:' : 'Ngày khởi hành Tour:') }}
                                    </label>
                                    <input type="date" name="booking_date" required min="{{ date('Y-m-d') }}" class="w-full bg-slate-50 rounded-xl py-2.5 px-4 text-sm font-bold text-slate-800 border border-slate-200/60 focus:outline-none focus:border-blue-500 transition">
                                </div>

                                <div>
                                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-1">
                                        📝 Ghi chú yêu cầu đặc biệt:
                                    </label>
                                    <textarea name="note" rows="3" placeholder="{{ $isCar ? 'Ví dụ: Giao xe tại sân bay Nội Bài...' : ($isTicket ? 'Ví dụ: Cần xuất hóa đơn...' : 'Ví dụ: Mình ăn chay...') }}" class="w-full bg-slate-50 rounded-xl py-2 px-3 text-xs font-medium text-slate-700 border border-slate-200/60 focus:outline-none focus:border-blue-500 transition resize-none"></textarea>
                                </div>

                                <div class="bg-slate-50 p-3 rounded-xl flex justify-between items-center text-sm">
                                    <span class="font-bold text-slate-500">Tổng tạm tính:</span>
                                    <span id="total-display" class="font-black text-slate-800 text-base">
                                        {{ number_format($service->price) }} đ
                                    </span>
                                </div>

                                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black py-3.5 rounded-xl shadow-lg shadow-blue-500/20 text-xs uppercase tracking-wider transition active:scale-[0.98]">
                                    ⚡ Tiến hành đặt ngay
                                </button>
                            </form>
                        @else
                            <div class="bg-gray-50 text-gray-500 p-4 rounded-xl text-center text-xs font-bold border border-gray-200">
                                👋 Bạn đang đăng nhập quyền [{{ auth()->user()->role }}]. Chỉ tài khoản Khách hàng mới có quyền thực hiện đặt dịch vụ.
                            </div>
                        @endif
                    @endguest

                    <p class="text-[10px] text-center text-slate-400 font-medium leading-relaxed">
                        Hệ thống sẽ ghi nhận lịch và liên hệ lại ngay với quý khách qua SĐT tài khoản cá nhân để xác nhận.
                    </p>
                </div>
            </div>

        </div>
    </main>

    <script>
        const price = {{ $service->price }};
        const input = document.getElementById('quantity');
        const display = document.getElementById('total-display');

        if (input) {
            input.addEventListener('input', function() {
                let qty = parseInt(this.value) || 1;
                if(qty < 1) qty = 1;
                const total = price * qty;
                display.innerText = total.toLocaleString('vi-VN') + ' đ';
            });
        }
    </script>
</body>
</html>