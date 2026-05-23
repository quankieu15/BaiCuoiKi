@php

    $titleLower = \Illuminate\Support\Str::lower($service->title);

    $isCar = \Illuminate\Support\Str::contains($titleLower, ['xe', 'ô tô', 'tự lái']) || $service->category_id == 1;

    $isTicket = \Illuminate\Support\Str::contains($titleLower, ['vé', 'vinwonders', 'cổng', 'cửa']) || $service->category_id == 2;

    $isHotel = \Illuminate\Support\Str::contains($titleLower, ['villas', 'phòng', 'resort', 'khách sạn']) || $service->category_id == 5;

@endphp



<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $service->title }} - Chi tiết dịch vụ</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-50 font-sans antialiased">



<div class="max-w-7xl mx-auto px-4 py-8">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

       

        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100">

                <img src="{{ asset($service->image ?? 'images/default-service.jpg') }}" alt="{{ $service->title }}" class="w-full h-[400px] object-cover">

                <div class="p-6">

                    <h1 class="text-2xl font-black text-slate-800 mb-2">{{ $service->title }}</h1>

                    <p class="text-sm text-slate-500 flex items-center gap-1.5">

                        📍 {{ $service->location }}

                    </p>

                </div>

            </div>



            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">

                <h3 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">

                    📋 Giới thiệu dịch vụ

                </h3>

                <div class="text-slate-600 text-sm leading-relaxed whitespace-pre-line">

                    {{ $service->description }}

                </div>

            </div>



            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">

                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">

                    💬 Đánh giá & Bình luận từ khách hàng

                </h3>



                <div class="space-y-4 mb-8">

                    @forelse($service->reviews->where('is_approved', 1) as $review)

                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 flex gap-3">

                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold shrink-0">

                                {{ substr($review->user->name ?? 'K', 0, 1) }}

                            </div>

                           

                            <div class="space-y-1 w-full">

                                <div class="flex items-center justify-between">

                                    <h4 class="font-bold text-gray-800 text-sm">{{ $review->user->name ?? 'Khách ẩn danh' }}</h4>

                                    <span class="text-xs text-gray-400">

                                        {{ $review->created_at ? $review->created_at->diffForHumans() : 'Vừa xong' }}

                                    </span>

                                </div>

                               

                                <div class="text-amber-400 text-xs flex gap-0.5">

                                    @for ($i = 1; $i <= ($review->rating ?? 5); $i++)

                                        ⭐

                                    @endfor

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

        </div>



        <div class="lg:col-span-1">

            <div class="bg-white rounded-2xl p-6 shadow-md border border-cyan-100/50 sticky top-6">

                <div class="flex items-baseline justify-between mb-6 pb-4 border-b border-slate-100">

                    <span class="text-xs font-black text-slate-400 uppercase tracking-wider">Giá gốc</span>

                    <div class="text-right">

                        <span class="text-2xl font-black text-cyan-600">{{ number_format($service->price, 0, ',', '.') }} đ</span>

                        <span class="text-[10px] block text-slate-400 font-bold">/ dịch vụ</span>

                    </div>

                </div>



                <form action="#" method="POST" class="space-y-4">

                    @csrf

                   

                    <div>

                        <label class="block text-xs font-black text-cyan-700 uppercase tracking-wider mb-1.5">

                            @if($isCar) 🚗 Số lượng ngày thuê xe:

                            @elseif($isHotel) 🏨 Số đêm lưu trú:

                            @elseif($isTicket) 🎟️ Số lượng vé đặt:

                            @else 👥 Số người tham gia: @endif

                        </label>

                        <input type="number" name="quantity" id="quantity" value="1" min="1"

                               {{ ($isCar || $isHotel) ? 'readonly' : '' }}

                               class="w-full rounded-xl font-black text-slate-800 text-center py-3 border border-cyan-100 focus:outline-none focus:border-cyan-500 transition text-sm {{ ($isCar || $isHotel) ? 'bg-slate-100 text-slate-400 cursor-not-allowed' : 'bg-slate-50' }}">

                    </div>



                    <div>

                        <label class="block text-xs font-black text-cyan-700 uppercase tracking-wider mb-1.5">

                            📅 @if($isCar) Ngày nhận xe: @elseif($isHotel) Ngày Check-in: @elseif($isTicket) Ngày sử dụng vé: @else Ngày khởi hành Tour: @endif

                        </label>

                        <input type="date" name="booking_date" id="booking_date" required min="{{ date('Y-m-d') }}" class="w-full bg-slate-50 rounded-xl py-3 px-4 text-sm font-bold text-slate-800 border border-cyan-100 focus:outline-none focus:border-cyan-500 transition">

                    </div>



                    @if($isCar || $isHotel)

                    <div>

                        <label class="block text-xs font-black text-cyan-700 uppercase tracking-wider mb-1.5">

                            📅 @if($isCar) Ngày trả xe: @else Ngày Check-out: @endif

                        </label>

                        <input type="date" name="end_date" id="end_date" required min="{{ date('Y-m-d') }}" class="w-full bg-slate-50 rounded-xl py-3 px-4 text-sm font-bold text-slate-800 border border-cyan-100 focus:outline-none focus:border-cyan-500 transition">

                    </div>

                    @endif



                    <div>

                        <label class="block text-xs font-black text-cyan-700 uppercase tracking-wider mb-1.5">📝 Ghi chú kèm theo:</label>

                        <textarea name="note" rows="2" class="w-full bg-slate-50 rounded-xl py-2.5 px-4 text-xs font-bold text-slate-800 border border-cyan-100 focus:outline-none focus:border-cyan-500 transition resize-none" placeholder="Ví dụ: Giờ đón, số lượng trẻ em, yêu cầu đặc biệt..."></textarea>

                    </div>



                    <div class="pt-4 mt-2 border-t border-dashed border-slate-100 flex items-center justify-between">

                        <span class="text-xs font-black text-slate-700 uppercase tracking-wider">Tổng tiền tạm tính:</span>

                        <span id="total-display" class="text-xl font-black text-emerald-600">{{ number_format($service->price, 0, ',', '.') }} đ</span>

                    </div>



                    <button type="submit" class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-black text-sm uppercase tracking-wider py-4 rounded-xl shadow-md shadow-cyan-100 transition transform active:scale-[0.98] mt-2">

                        🚀 Tiến hành đặt ngay

                    </button>

                </form>

            </div>

        </div>



    </div>

</div>



<script>

    const price = {{ $service->price }};

    const isCar = {{ $isCar ? 'true' : 'false' }};

    const isHotel = {{ $isHotel ? 'true' : 'false' }};

    const isRangeMode = isCar || isHotel;

   

    const qtyInput = document.getElementById('quantity');

    const startDateInput = document.getElementById('booking_date');

    const endDateInput = document.getElementById('end_date');

    const display = document.getElementById('total-display');



    function calculateTotal() {

        let qty = 1;



        if (isRangeMode && startDateInput && endDateInput) {

            const startVal = startDateInput.value;

            const endVal = endDateInput.value;



            if (startVal && endVal) {

                const start = new Date(startVal);

                const end = new Date(endVal);

               

                const timeDiff = end.getTime() - start.getTime();

                let days = Math.ceil(timeDiff / (1000 * 3600 * 24));

               

                if (days <= 0) days = 1;

               

                qty = days;

                if(qtyInput) qtyInput.value = qty;

            }

        } else if (qtyInput) {

            qty = parseInt(qtyInput.value) || 1;

            if (qty < 1) qty = 1;

        }



        const total = price * qty;

        display.innerText = total.toLocaleString('vi-VN') + ' đ';

    }



    if (qtyInput && !isRangeMode) {

        qtyInput.addEventListener('input', calculateTotal);

    }



    if (isRangeMode && startDateInput && endDateInput) {

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