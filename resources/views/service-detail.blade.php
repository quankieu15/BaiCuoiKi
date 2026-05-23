<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service->title }} - HKT TRAVEL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#f0f9ff] text-slate-800 font-sans min-h-screen relative overflow-x-hidden">

    <div class="fixed inset-0 -z-50 overflow-hidden">
        <div class="ocean-light-bg"></div>
    </div>

    @php
        // 1. Nhận diện loại dịch vụ ngay từ đầu trang để đồng bộ toàn cục
        $isCar = \Illuminate\Support\Str::contains(\Illuminate\Support\Str::lower($service->title), ['xe', 'ô tô', 'tự lái']);
        $isTicket = \Illuminate\Support\Str::contains(\Illuminate\Support\Str::lower($service->title), ['vé', 'vinwonders', 'cổng', 'cửa']);
    @endphp

    <nav class="bg-white/40 backdrop-blur-md border-b border-cyan-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
            <a href="/" class="flex items-center bg-white px-5 py-2 rounded-2xl border border-cyan-100 shadow-sm transition-all duration-300 hover:scale-[1.02]">
                <span class="text-xl font-black tracking-wide text-cyan-600">HKT</span>
                <span class="text-xl font-black text-orange-500 border-b-4 border-orange-400 pb-0.5 ml-1">{{ __('TRAVEL') }}</span>
            </a>
            <a href="/" class="text-sm font-bold text-cyan-700 bg-white/80 border border-cyan-100 px-4 py-2 rounded-xl hover:bg-cyan-50 hover:text-cyan-600 flex items-center gap-1 transition-all duration-300 shadow-sm">
                ↩️ Quay lại trang chủ
            </a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-10 relative z-10">
        
        <div class="mb-8">
            <span class="bg-cyan-100 text-cyan-700 text-xs font-black px-4 py-1.5 rounded-full uppercase tracking-widest border border-cyan-200 inline-flex items-center gap-1 shadow-sm">
                📍 {{ $service->location }}
            </span>
            <h1 class="text-2xl md:text-4xl font-black text-slate-800 mt-3 leading-tight tracking-wide drop-shadow-sm">
                {{ $service->title }}
            </h1>
        </div>

        <div class="w-full aspect-[21/9] rounded-[32px] overflow-hidden shadow-xl mb-10 bg-white border border-cyan-100 relative group">
            @if($service->image)
                <img src="{{ asset($service->image) }}" class="w-full h-full object-cover group-hover:scale-[1.02] transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-cyan-900/10 to-transparent"></div>
            @else
                <div class="w-full h-full flex items-center justify-center text-slate-400">Chưa cập nhật hình ảnh</div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="lg:col-span-2 space-y-8">
                
                @if($isCar)
                    <div class="bg-white/70 backdrop-blur-md p-6 rounded-[24px] border border-cyan-100 shadow-sm">
                        <h2 class="text-lg font-black text-cyan-800 mb-4 flex items-center gap-2">
                            ⚙️ Thông số kỹ thuật của xe
                        </h2>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-cyan-50/50 p-4 rounded-2xl text-center border border-cyan-100/50 hover:border-cyan-400 transition">
                                <span class="block text-xs font-bold text-cyan-600/70 uppercase tracking-wider">Số chỗ</span>
                                <span class="text-base font-black text-slate-700 mt-1 block">5 - 7 Chỗ</span>
                            </div>
                            <div class="bg-cyan-50/50 p-4 rounded-2xl text-center border border-cyan-100/50 hover:border-cyan-400 transition">
                                <span class="block text-xs font-bold text-cyan-600/70 uppercase tracking-wider">Truyền động</span>
                                <span class="text-base font-black text-slate-700 mt-1 block">Số tự động</span>
                            </div>
                            <div class="bg-cyan-50/50 p-4 rounded-xl text-center border border-cyan-100/50 hover:border-cyan-400 transition">
                                <span class="block text-xs font-bold text-cyan-600/70 uppercase tracking-wider">Nhiên liệu</span>
                                <span class="text-base font-black text-slate-700 mt-1 block">Xăng / Dầu</span>
                            </div>
                            <div class="bg-cyan-50/50 p-4 rounded-xl text-center border border-cyan-100/50 hover:border-cyan-400 transition">
                                <span class="block text-xs font-bold text-cyan-600/70 uppercase tracking-wider">Đời xe</span>
                                <span class="text-base font-black text-slate-700 mt-1 block">2022 - 2026</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-amber-50 border border-amber-200 p-6 rounded-[24px] shadow-sm">
                        <h3 class="font-black text-amber-800 mb-2 flex items-center gap-1.5">📑 Thủ tục nhận xe tự lái cần có:</h3>
                        <ul class="text-sm text-amber-900/90 space-y-1.5 list-disc pl-5 font-medium">
                            <li>Căn cước công dân gắn chíp (Bản gốc đối chiếu).</li>
                            <li>Bằng lái xe hạng B1 / B2 trở lên còn hạn.</li>
                            <li>Tài sản thế chấp: Xe máy hoặc 15.000.000đ tiền mặt.</li>
                        </ul>
                    </div>

                @elseif($isTicket)
                    <div class="bg-white/70 backdrop-blur-md p-6 rounded-[24px] border border-cyan-100 shadow-sm">
                        <h2 class="text-lg font-black text-cyan-800 mb-4 flex items-center gap-2">
                            ✨ Đặc điểm nổi bật của Vé
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="flex items-center gap-3 bg-cyan-50/50 p-4 rounded-xl border border-cyan-100/50">
                                <span class="text-2xl">📱</span>
                                <div>
                                    <h4 class="text-xs font-bold text-cyan-600/70 uppercase tracking-wider">Hình thức nhận</h4>
                                    <p class="text-sm font-black text-slate-700">Vé điện tử (QR Code)</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 bg-cyan-50/50 p-4 rounded-xl border border-cyan-100/50">
                                <span class="text-2xl">⚡</span>
                                <div>
                                    <h4 class="text-xs font-bold text-cyan-600/70 uppercase tracking-wider">Xác nhận</h4>
                                    <p class="text-sm font-black text-slate-700">Có kết quả tức thì</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 bg-cyan-50/50 p-4 rounded-xl border border-cyan-100/50">
                                <span class="text-2xl">📅</span>
                                <div>
                                    <h4 class="text-xs font-bold text-cyan-600/70 uppercase tracking-wider">Chính sách hủy</h4>
                                    <p class="text-sm font-black text-rose-600">Không hoàn hủy vé</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-sky-50 border border-sky-200 p-5 rounded-[24px] text-sm text-sky-800 font-medium shadow-sm">
                        💡 <strong>Hướng dẫn sử dụng:</strong> Sau khi hệ thống xác nhận đặt lịch, mã vé QR Code sẽ được chuẩn bị sẵn sàng. Bạn chỉ cần đưa mã quét tại quầy soát vé vào cửa công viên giải trí.
                    </div>
                @endif

                <div class="bg-white/70 backdrop-blur-md p-6 rounded-[24px] border border-cyan-100 shadow-sm space-y-4">
                    <h2 class="text-lg font-black text-slate-800 pb-3 border-b border-slate-100 flex items-center gap-2">
                        📝 Thông tin chi tiết dịch vụ
                    </h2>
                    <div class="prose max-w-none text-slate-600 leading-relaxed text-sm space-y-4 ocean-prose">
                        {!! $service->description !!}
                    </div>
                </div>

                {{-- Khối bản đồ Google Maps --}}
                <div class="bg-white/70 backdrop-blur-md p-6 rounded-[24px] border border-cyan-100 shadow-sm text-left">
                    <h2 class="text-lg font-black text-slate-800 pb-3 border-b border-slate-100 flex items-center gap-2 mb-4">
                        🗺️ Vị trí trên bản đồ
                    </h2>
                    
                    <div class="w-full h-[350px] rounded-2xl overflow-hidden border border-cyan-100 shadow-inner relative bg-slate-50">
                        @if(!empty($service->location))
                            <iframe 
                                class="w-full h-full border-0"
                                src="https://maps.google.com/maps?q={{ rawurlencode($service->location) }}&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 gap-2">
                                <span class="text-2xl">📍</span>
                                <p class="text-xs font-semibold">Chưa cập nhật vị trí chính xác cho dịch vụ này.</p>
                            </div>
                        @endif
                    </div>
                    <p class="text-slate-400 text-[11px] mt-2 font-medium italic">
                        * Địa điểm tìm kiếm tự động: <strong class="text-cyan-600">{{ $service->location }}</strong>
                    </p>
                </div>

                {{-- Khối đánh giá bình luận --}}
                <div class="bg-white/70 backdrop-blur-md p-6 rounded-[24px] border border-cyan-100 shadow-sm text-left">
                    <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2">
                        💬 Đánh giá từ khách hàng
                    </h3>
                    <div style="color:red; font-weight:bold; display:none;">
                        SERVICE ID: {{ $service->id }}
                    </div>
                    <div class="space-y-4 mb-8">
                        @if(isset($approvedReviews) && $approvedReviews->count() > 0)
                            @foreach($approvedReviews as $review)
                                <div class="p-4 bg-white rounded-2xl border border-cyan-50 flex gap-4 text-left hover:border-cyan-200 transition shadow-sm">
                                    <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-cyan-400 to-sky-500 text-white flex items-center justify-center font-black shrink-0 text-base shadow-sm">
                                        {{ $review->user ? substr($review->user->name, 0, 1) : 'K' }}
                                    </div>
                                    
                                    <div class="space-y-1 w-full">
                                        <div class="flex items-center justify-between">
                                            <h4 class="font-bold text-slate-700 text-sm">{{ $review->user->name ?? 'Khách hàng ẩn danh' }}</h4>
                                            <span class="text-xs text-slate-400 font-medium">
                                                {{ $review->created_at ? $review->created_at->diffForHumans() : '' }}
                                            </span>
                                        </div>
                                        
                                        <div class="text-amber-400 text-sm tracking-wider flex gap-0.5">
                                            @for ($i = 1; $i <= ($review->rating ?? 5); $i++)
                                                ⭐
                                            @endfor
                                        </div>
                                        
                                        <p class="text-slate-600 text-sm mt-2 leading-relaxed">
                                            {{ $review->comment }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-10 text-slate-400 text-sm font-medium bg-white rounded-2xl border border-dashed border-cyan-200">
                                📌 Chưa có đánh giá nào được duyệt cho dịch vụ này. Hãy là người đầu tiên chia sẻ trải nghiệm nhé!
                            </div>
                        @endif
                    </div>

                    <div class="border-t border-slate-100 my-6"></div>

                    @auth
                        <form action="{{ route('reviews.store', $service->id) }}" method="POST" class="space-y-4 bg-cyan-50/40 p-5 rounded-2xl border border-cyan-100 text-left">
                            @csrf
                            <h4 class="font-bold text-cyan-800 text-sm flex items-center gap-1.5">✍️ Chia sẻ trải nghiệm thực tế của bạn</h4>
                            
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Mức độ hài lòng:</label>
                                <select name="rating" class="w-full text-sm rounded-xl bg-white border-cyan-100 text-slate-700 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 p-3 border outline-none">
                                    <option value="5">⭐⭐⭐⭐⭐ (Tuyệt vời)</option>
                                    <option value="4">⭐⭐⭐⭐ (Tốt)</option>
                                    <option value="3">⭐⭐⭐ (Bình thường)</option>
                                    <option value="2">⭐⭐ (Kém)</option>
                                    <option value="1">⭐ (Tệ)</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nội dung bình luận:</label>
                                <textarea name="comment" rows="3" required class="w-full text-sm rounded-xl bg-white border-cyan-100 text-slate-700 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 p-3 border outline-none resize-none" placeholder="Dịch vụ có đúng như mô tả không? Bạn có hài lòng không?..."></textarea>
                            </div>
                            
                            <button type="submit" class="bg-gradient-to-r from-cyan-500 to-sky-600 hover:from-cyan-600 hover:to-sky-700 text-white font-black px-5 py-2.5 rounded-xl transition text-xs tracking-wider uppercase shadow-md shadow-cyan-500/20">
                                Gửi đánh giá (Chờ phê duyệt)
                            </button>
                        </form>
                    @else
                        <div class="bg-white p-5 rounded-2xl text-center text-sm text-slate-400 border border-slate-100">
                            🔒 Vui lòng <a href="{{ route('login') }}" class="text-cyan-600 font-bold hover:underline">Đăng nhập</a> để viết đánh giá cho dịch vụ này.
                        </div>
                    @endauth
                </div>

                {{-- ========================================================================= --}}
                {{-- KHỐI GỢI Ý DỊCH VỤ TƯƠNG TỰ (MỚI ĐƯỢC TÍCH HỢP) --}}
                {{-- ========================================================================= --}}
                <div class="bg-white/70 backdrop-blur-md p-6 rounded-[24px] border border-cyan-100 shadow-sm text-left space-y-6">
                    <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                        <h3 class="font-black text-slate-800 text-base uppercase tracking-wider flex items-center gap-2">
                            <span class="text-xl">✨</span> Có thể bạn sẽ thích
                        </h3>
                        <span class="text-[10px] font-black text-cyan-700 bg-cyan-100/80 px-2.5 py-1 rounded-lg border border-cyan-200 uppercase tracking-wider">
                            Gợi ý phù hợp
                        </span>
                    </div>

                    {{-- Grid 2 cột trên điện thoại nhỏ, 2 cột trên tablet, và 2 cột gọn gàng bên cạnh vùng nội dung chính --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        @foreach($suggestedServices as $item)
                        <div class="group bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between">
                            
                            {{-- Khung ảnh sản phẩm gợi ý --}}
                            <div class="relative aspect-[16/10] overflow-hidden bg-slate-50">
                                @if($item->image)
                                    <img src="{{ asset($item->image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $item->title }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300 text-xs">No image</div>
                                @endif
                                
                                {{-- Badge phân loại tự động dựa trên tên/loại dịch vụ --}}
                                <span class="absolute top-2 left-2 bg-slate-900/70 backdrop-blur-sm text-white text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded-md">
                                    @if(Str::contains(Str::lower($item->title), ['xe', 'ô tô'])) 🚗 Xe Tự Lái
                                    @elseif(Str::contains(Str::lower($item->title), ['vé', 'vinwonders'])) 🎟️ Vé Tham Quan
                                    @else 🏝️ Tour Du Lịch
                                    @endif
                                </span>
                            </div>

                            {{-- Nội dung tóm tắt --}}
                            <div class="p-3.5 flex-1 flex flex-col justify-between space-y-2">
                                <div>
                                    <h4 class="font-bold text-slate-700 text-xs line-clamp-2 group-hover:text-cyan-600 transition duration-300">
                                        {{ $item->title }}
                                    </h4>
                                    <p class="text-[10px] text-slate-400 mt-0.5 line-clamp-1">
                                        📍 {{ $item->location ?? 'Toàn quốc' }}
                                    </p>
                                </div>

                                {{-- Phần giá & Nút chuyển hướng --}}
                                <div class="flex items-center justify-between pt-1.5 border-t border-slate-100">
                                    <div>
                                        <span class="text-[10px] font-black text-rose-500 font-mono">
                                            {{ number_format($item->price) }}đ
                                        </span>
                                    </div>
                                    
                                    {{-- Nút điều hướng tải lại trang chi tiết mới --}}
                                    <a href="{{ route('services.show', $item->id) }}" class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-cyan-500 text-white shadow-sm transition hover:bg-cyan-600 active:scale-95 cursor-pointer">
                                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                {{-- ========================================================================= --}}

            </div>

            {{-- Sidebar cột phải (Form đặt dịch vụ cố định khi cuộn trang) --}}
            <div class="lg:col-span-1 lg:sticky lg:top-28">
                <div class="bg-white/90 backdrop-blur-xl p-6 rounded-[28px] shadow-xl border border-cyan-100 space-y-6">
                    
                    <div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest block">Giá niêm yết từ</span>
                        <div class="flex items-baseline gap-1 mt-1">
                            <span class="text-3xl font-black text-rose-500 drop-shadow-sm">{{ number_format($service->price) }}</span>
                            <span class="text-sm font-bold text-rose-500">đ / lượt</span>
                        </div>
                    </div>

                    <div class="border-t border-slate-100"></div>

                    @guest
                        <div class="bg-amber-50 text-amber-800 p-4 rounded-2xl text-center text-xs font-bold border border-amber-200 leading-relaxed">
                            🔒 Vui lòng <a href="{{ route('login') }}" class="underline text-cyan-600">Đăng nhập</a> tài khoản Khách hàng để tiến hành đặt dịch vụ này.
                        </div>
                    @else
                        @if(auth()->user()->role === 'customer')
                            
                            @if(session('success'))
                                <div class="bg-emerald-50 text-emerald-700 p-4 rounded-2xl text-xs font-bold border border-emerald-200">
                                    ✅ {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('services.book', $service->id) }}" method="POST" class="space-y-4">
                                @csrf
                                
                                <div>
                                    <label class="block text-xs font-black text-cyan-700 uppercase tracking-wider mb-1.5">
                                        {{ $isCar ? '🚗 Số lượng ngày thuê xe:' : ($isTicket ? '🎟/👤 Số lượng vé đặt:' : '👥 Số người tham gia:') }}
                                    </label>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" {{ $isCar ? 'readonly class=bg-slate-100' : 'class=bg-slate-50' }} class="w-full rounded-xl font-black text-slate-800 text-center py-3 border border-cyan-100 focus:outline-none focus:border-cyan-500 transition text-sm">
                                </div>

                                <div>
                                    <label class="block text-xs font-black text-cyan-700 uppercase tracking-wider mb-1.5">
                                        📅 {{ $isCar ? 'Ngày nhận xe:' : ($isTicket ? 'Ngày sử dụng vé:' : 'Ngày khởi hành Tour:') }}
                                    </label>
                                    <input type="date" name="booking_date" id="booking_date" required min="{{ date('Y-m-d') }}" class="w-full bg-slate-50 rounded-xl py-3 px-4 text-sm font-bold text-slate-800 border border-cyan-100 focus:outline-none focus:border-cyan-500 transition">
                                </div>

                                @if($isCar)
                                <div>
                                    <label class="block text-xs font-black text-cyan-700 uppercase tracking-wider mb-1.5">
                                        📅 Ngày trả xe:
                                    </label>
                                    <input type="date" name="end_date" id="end_date" required min="{{ date('Y-m-d') }}" class="w-full bg-slate-50 rounded-xl py-3 px-4 text-sm font-bold text-slate-800 border border-cyan-100 focus:outline-none focus:border-cyan-500 transition">
                                </div>
                                @endif

                                <div>
                                    <label class="block text-xs font-black text-cyan-700 uppercase tracking-wider mb-1.5">
                                        Ghi chú yêu cầu đặc biệt:
                                    </label>
                                    <textarea name="note" rows="3" placeholder="{{ $isCar ? 'Ví dụ: Giao xe tại sân bay Phú Quốc...' : ($isTicket ? 'Ví dụ: Cần xuất hóa đơn...' : 'Ví dụ: Mình ăn chay...') }}" class="w-full bg-slate-50 rounded-xl py-2.5 px-3 text-xs font-medium text-slate-700 border border-cyan-100 focus:outline-none focus:border-cyan-500 transition resize-none h-20"></textarea>
                                </div>

                                <div class="bg-cyan-50/50 p-4 rounded-2xl flex justify-between items-center text-sm border border-cyan-100/50">
                                    <span class="font-bold text-slate-500">Tổng tạm tính:</span>
                                    <span id="total-display" class="font-black text-cyan-600 text-lg">
                                        {{ number_format($service->price) }} đ
                                    </span>
                                </div>

                                <button type="submit" class="w-full bg-gradient-to-r from-cyan-400 via-sky-400 to-cyan-500 bg-[size:200%_auto] hover:bg-right text-white font-black py-4 rounded-xl shadow-md shadow-cyan-400/20 text-xs uppercase tracking-widest transition-all duration-500 active:scale-[0.98]">
                                    ⚡ Tiến hành đặt ngay
                                </button>
                            </form>
                        @else
                            <div class="bg-slate-50 text-slate-500 p-4 rounded-2xl text-center text-xs font-bold border border-slate-200 leading-relaxed">
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

    <style>
    .ocean-light-bg {
        position: absolute;
        inset: 0;
        z-index: -50;
        background: linear-gradient(135deg, #e0f2fe 0%, #cffaf2 40%, #e0f7fa 70%, #f0f9ff 100%);
        background-size: 400% 400%;
        animation: oceanLightMove 14s ease infinite;
    }

    @keyframes oceanLightMove {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .ocean-light-bg::before {
        content: "";
        position: absolute;
        width: 200%;
        height: 200%;
        top: -50%;
        left: -50%;
        background: radial-gradient(circle at 20% 30%, rgba(34, 211, 238, 0.15), transparent 60%),
                    radial-gradient(circle at 70% 60%, rgba(56, 189, 248, 0.12), transparent 60%);
        animation: waveSlowRotate 25s linear infinite;
    }

    @keyframes waveSlowRotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .ocean-prose p {
        margin-bottom: 1rem;
    }
    .ocean-prose strong {
        color: #0891b2 !important;
    }
    
    input[type="date"]::-webkit-calendar-picker-indicator {
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="%230891b2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>');
        cursor: pointer;
    }
    </style>

    <script>
        const price = {{ $service->price }};
        const isCar = {{ $isCar ? 'true' : 'false' }};
        
        const qtyInput = document.getElementById('quantity');
        const startDateInput = document.getElementById('booking_date');
        const endDateInput = document.getElementById('end_date');
        const display = document.getElementById('total-display');

        function calculateTotal() {
            let qty = 1;

            if (isCar && startDateInput && endDateInput) {
                const startVal = startDateInput.value;
                const endVal = endDateInput.value;

                if (startVal && endVal) {
                    const start = new Date(startVal);
                    const end = new Date(endVal);
                    
                    const timeDiff = end.getTime() - start.getTime();
                    let days = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    
                    if (days <= 0) days = 1; 
                    
                    qty = days;
                    qtyInput.value = qty; 
                }
            } else if (qtyInput) {
                qty = parseInt(qtyInput.value) || 1;
                if (qty < 1) qty = 1;
            }

            const total = price * qty;
            display.innerText = total.toLocaleString('vi-VN') + ' đ';
        }

        if (qtyInput && !isCar) {
            qtyInput.addEventListener('input', calculateTotal);
        }

        if (isCar && startDateInput && endDateInput) {
            startDateInput.addEventListener('change', function() {
                endDateInput.min = this.value;
                
                if (endDateInput.value && endDateInput.value < this.value) {
                    endDateInput.value = this.value;
                }
                calculateTotal();
            });

            endDateInput.addEventListener('change', calculateTotal);
        }
    </script>
</body>
</html> 