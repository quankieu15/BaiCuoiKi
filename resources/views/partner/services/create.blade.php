<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng bán dịch vụ mới</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Bắt buộc các ô input phải có viền rõ ràng, không bị mất border */
        .force-input {
            border: 1px solid #cbd5e1 !important;
            background-color: #ffffff !important;
            color: #1e293b !important;
        }
        .force-input:focus {
            border-color: #4f46e5 !important;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15) !important;
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen font-sans text-slate-800 antialiased">

    <header class="bg-white border-b border-slate-200 py-6 mb-8 shadow-sm">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-2xl font-black text-slate-900 tracking-tight flex items-center gap-2">
                ✨ Đăng bán dịch vụ mới
            </h1>
            <p class="text-sm text-slate-500 mt-1">Cung cấp thông tin chi tiết về sản phẩm của bạn để thu hút khách hàng đặt lịch.</p>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 pb-16">
        <div class="bg-white border border-slate-200/80 shadow-xl shadow-slate-200/50 rounded-3xl p-6 md:p-10">
            
            <form action="{{ route('partner.services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700 tracking-wide">📁 Loại hình dịch vụ <span class="text-rose-500">*</span></label>
                    <select id="category_select" name="category_id" class="force-input block w-full h-12 px-4 rounded-xl text-sm font-medium cursor-pointer" required>
                        <option value="">-- Bấm vào đây để chọn loại hình dịch vụ bạn kinh doanh --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" data-slug="{{ Str::slug($cat->name) }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="form_khach_san" class="dynamic-form hidden space-y-4 border border-dashed border-blue-300 p-6 rounded-2xl bg-gradient-to-b from-blue-50/50 to-white shadow-sm animate-fade-in">
                    <div class="text-blue-600 font-black text-sm uppercase tracking-wider flex items-center gap-2">
                        <span>🏨</span> Thông tin phòng khách sạn / Khu nghỉ dưỡng
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Tên khách sạn</label>
                            <input name="title_hotel" type="text" class="force-input w-full h-11 px-4 rounded-xl text-sm" placeholder="Ví dụ: Khách sạn Mường Thanh Hạ Long" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Địa chỉ chính xác</label>
                            <input name="location_hotel" type="text" class="force-input w-full h-11 px-4 rounded-xl text-sm" placeholder="Ví dụ: Số 1, Đường Hạ Long, Bãi Cháy" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Mô tả tiện ích nổi bật</label>
                            <textarea name="description_hotel" rows="4" class="force-input w-full p-4 rounded-xl text-sm resize-none" placeholder="Ví dụ: Có bể bơi vô cực, miễn phí buffet sáng, phòng tắm bồn..."></textarea>
                        </div>
                    </div>
                </div>

                <div id="form_thue_xe" class="dynamic-form hidden space-y-4 border border-dashed border-emerald-300 p-6 rounded-2xl bg-gradient-to-b from-emerald-50/50 to-white shadow-sm animate-fade-in">
                    <div class="text-emerald-600 font-black text-sm uppercase tracking-wider flex items-center gap-2">
                        <span>🚗</span> Dịch vụ cho thuê xe / Trung chuyển
                    </div>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Hãng xe & Đời xe</label>
                                <input name="title_car" type="text" class="force-input w-full h-11 px-4 rounded-xl text-sm" placeholder="Ví dụ: Toyota Innova 2024" />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Số chỗ ngồi</label>
                                <input name="car_slots" type="number" class="force-input w-full h-11 px-4 rounded-xl text-sm" placeholder="Ví dụ: 7" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Phạm vi giao xe / Khu vực đón</label>
                            <input name="location_car" type="text" class="force-input w-full h-11 px-4 rounded-xl text-sm" placeholder="Ví dụ: Toàn bộ khu vực nội thành Đà Nẵng" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Thông số kỹ thuật & Quy định nhận xe</label>
                            <textarea name="description_car" rows="4" class="force-input w-full p-4 rounded-xl text-sm resize-none" placeholder="Ví dụ: Xe số tự động, yêu cầu căn cước công dân gắn chíp và bằng lái B2..."></textarea>
                        </div>
                    </div>
                </div>

                <div id="form_ve_vui_choi" class="dynamic-form hidden space-y-4 border border-dashed border-purple-300 p-6 rounded-2xl bg-gradient-to-b from-purple-50/50 to-white shadow-sm animate-fade-in">
                    <div class="text-purple-600 font-black text-sm uppercase tracking-wider flex items-center gap-2">
                        <span>🎟️</span> Bán vé tham quan / Vui chơi giải trí
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Tên loại vé / Gói dịch vụ vui chơi</label>
                            <input name="title_ticket" type="text" class="force-input w-full h-11 px-4 rounded-xl text-sm" placeholder="Ví dụ: Vé cáp treo Sun World Bà Nà Hills trọn gói" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Địa điểm áp dụng sử dụng vé</label>
                            <input name="location_ticket" type="text" class="force-input w-full h-11 px-4 rounded-xl text-sm" placeholder="Ví dụ: Hòa Vang, Đà Nẵng" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Điều khoản sử dụng & Tiện ích kèm theo</label>
                            <textarea name="description_ticket" rows="4" class="force-input w-full p-4 rounded-xl text-sm resize-none" placeholder="Ví dụ: Vé quét mã QR qua cổng trực tiếp, bao gồm toàn bộ trò chơi, không gồm ăn trưa..."></textarea>
                        </div>
                    </div>
                </div>

                <div id="form_tour" class="dynamic-form hidden space-y-4 border border-dashed border-amber-300 p-6 rounded-2xl bg-gradient-to-b from-amber-50/50 to-white shadow-sm animate-fade-in">
                    <div class="text-amber-600 font-black text-sm uppercase tracking-wider flex items-center gap-2">
                        <span>✈️</span> Đăng bán Tour du lịch trọn gói
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Tên tiêu đề Tour du lịch</label>
                            <input name="title_tour" type="text" class="force-input w-full h-11 px-4 rounded-xl text-sm" placeholder="Ví dụ: Tour Sapa kỳ vĩ 3 Ngày 2 Đêm - Khởi hành từ Hà Nội" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Điểm xuất phát / Điểm đến</label>
                            <input id="tour_location_input" name="location_tour" type="text" class="force-input w-full h-11 px-4 rounded-xl text-sm" placeholder="Ví dụ: Hà Nội - Sapa" />
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">
                                🏨 Chọn các khách sạn liên kết lưu trú cho Tour này
                            </label>
                            
                            <div class="border border-slate-200 rounded-xl p-4 bg-white max-h-60 overflow-y-auto space-y-2 shadow-inner">
                                @foreach($hotels as $hotel)
                                    <label class="hotel-item flex items-start gap-3 p-2 rounded-lg hover:bg-slate-50 cursor-pointer transition-colors">
                                        <input type="checkbox" name="hotel_ids[]" value="{{ $hotel->id }}" 
                                               class="w-4 h-4 rounded text-indigo-600 border-slate-300 focus:ring-indigo-500 mt-0.5">
                                        <div class="text-sm">
                                            <p class="font-semibold text-slate-800">{{ $hotel->name }}</p>
                                            <p class="text-xs text-slate-400 flex items-center gap-1">📍 <span class="hotel-location-text">{{ $hotel->location }}</span></p>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <p class="text-[11px] text-slate-400">💡 Hệ thống tự động lọc danh sách khách sạn phù hợp khi bạn gõ "Điểm đến" ở trên.</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Lịch trình chi tiết từng ngày</label>
                            <textarea name="description_tour" rows="6" class="force-input w-full p-4 rounded-xl text-sm resize-none" placeholder="Ngày 1: Xe đón khách tại trung tâm phố cổ đi Sapa...&#10;Ngày 2: Khám phá đỉnh Fansipan..."></textarea>
                        </div>
                    </div>
                </div>

                <div id="common_fields" class="space-y-4 pt-6 border-t border-slate-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">Giá Dịch Vụ (VNĐ) <span class="text-rose-500">*</span></label>
                            <input id="price" name="price" type="number" class="force-input w-full h-11 px-4 rounded-xl text-sm font-bold text-indigo-600" placeholder="0" required />
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">Hình ảnh đại diện bài đăng</label>
                            <input id="image" name="image" type="file" class="block w-full text-xs text-slate-500 bg-slate-50 border border-slate-200 rounded-xl p-1.5 file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 file:cursor-pointer transition-all" />
                        </div>
                    </div>
                </div>

                <input type="hidden" id="title" name="title">
                <input type="hidden" id="location" name="location">
                <input type="hidden" id="description" name="description">

                <div class="flex justify-end space-x-3 pt-6 border-t border-slate-200">
                    <a href="{{ route('partner.services.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-2.5 px-6 rounded-xl text-xs tracking-wider transition-all text-center uppercase decoration-none">Hủy bỏ</a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-6 rounded-xl text-xs tracking-wider shadow-md shadow-indigo-200 transition-all uppercase">Đăng dịch vụ ngay</button>
                </div>
            </form>
        </div>
    </main>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category_select');
            const dynamicForms = document.querySelectorAll('.dynamic-form');
            const formEl = document.querySelector('form');
            const locationInput = document.getElementById('tour_location_input');

            // 1. Logic ẩn / hiện cụm form động tương ứng theo loại hình dịch vụ chọn lựa
            categorySelect.addEventListener('change', function () {
                dynamicForms.forEach(form => form.classList.add('hidden'));

                const selectedOption = this.options[this.selectedIndex];
                const slug = selectedOption.getAttribute('data-slug');

                if (!slug) return;

                if (slug.includes('khach-san')) {
                    document.getElementById('form_khach_san').classList.remove('hidden');
                } else if (slug.includes('xe')) {
                    document.getElementById('form_thue_xe').classList.remove('hidden');
                } else if (slug.includes('ve') || slug.includes('vui-choi')) {
                    document.getElementById('form_ve_vui_choi').classList.remove('hidden');
                } else if (slug.includes('tour')) {
                    document.getElementById('form_tour').classList.remove('hidden');
                }
            });

            // 2. Logic LỌC KHÁCH SẠN THÔNG MINH khi người dùng gõ điểm đến của Tour
            if (locationInput) {
                locationInput.addEventListener('input', function() {
                    const filterText = this.value.toLowerCase().trim();
                    const hotelItems = document.querySelectorAll('.hotel-item'); 
                    
                    hotelItems.forEach(item => {
                        const locationTextEl = item.querySelector('.hotel-location-text');
                        if (!locationTextEl) return;
                        
                        const hotelLocation = locationTextEl.textContent.toLowerCase().trim();
                        
                        // Nếu ô tìm kiếm trống, hoặc vị trí tour và vị trí khách sạn khớp/chứa nhau
                        if (filterText === "" || filterText.includes(hotelLocation) || hotelLocation.includes(filterText)) {
                            item.style.setProperty('display', 'flex', 'important');
                        } else {
                            item.style.setProperty('display', 'none', 'important');
                        }
                    });
                });
            }

            // 3. Logic đóng gói gom giá trị từ cụm form con vào các ô Input ẩn trước khi Submit
            formEl.addEventListener('submit', function(e) {
                const selectedOption = categorySelect.options[categorySelect.selectedIndex];
                const slug = selectedOption.getAttribute('data-slug');
                
                let activePrefix = 'tour';
                if (slug.includes('khach-san')) activePrefix = 'hotel';
                else if (slug.includes('xe')) activePrefix = 'car';
                else if (slug.includes('ve') || slug.includes('vui-choi')) activePrefix = 'ticket';

                document.getElementById('title').value = document.querySelector(`[name="title_${activePrefix}"]`).value;
                document.getElementById('location').value = document.querySelector(`[name="location_${activePrefix}"]`).value;
                document.getElementById('description').value = document.querySelector(`[name="description_${activePrefix}"]`).value;
            });
        });
    </script>
</body>
</html>