<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chỉnh sửa thông tin dịch vụ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('partner.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <x-input-label for="category_id" :value="__('Loại hình dịch vụ')" />
                        <select id="category_id" name="category_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" data-slug="{{ Str::slug($cat->name) }}" {{ $service->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="title" :value="__('Tên tiêu đề bài đăng')" />
                        <x-text-input id="title" name="title" type="text" class="block mt-1 w-full" value="{{ old('title', $service->title) }}" required />
                    </div>

                    <div>
                        <x-input-label for="price" :value="__('Giá bán (đ)')" />
                        <x-text-input id="price" name="price" type="number" class="block mt-1 w-full" value="{{ old('price', $service->price) }}" required />
                    </div>

                    <div>
                        <x-input-label for="tour_location_input" :value="__('Địa điểm')" />
                        <x-text-input id="tour_location_input" name="location" type="text" class="block mt-1 w-full" value="{{ old('location', $service->location) }}" required />
                    </div>

                    <div id="hotel_select_container" class="space-y-2 hidden border border-dashed border-amber-500/40 p-4 rounded-xl bg-amber-50/5 dark:bg-amber-950/10">
                        <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide">
                            🏨 Khách sạn liên kết lưu trú cho Tour này
                        </label>
                        
                        <div class="border border-gray-300 dark:border-gray-700 rounded-md p-3 bg-white dark:bg-gray-900 max-h-48 overflow-y-auto space-y-2">
                            @php
                                // Lấy mảng danh sách ID khách sạn đã liên kết từ trước để check chuẩn xác
                                $selectedHotels = $service->hotels ? $service->hotels->pluck('id')->toArray() : [];
                            @endphp
                            
                            @foreach($hotels as $hotel)
                                <label class="hotel-item flex items-start gap-3 p-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer transition-colors text-gray-800 dark:text-gray-200">
                                    <input type="checkbox" name="hotel_ids[]" value="{{ $hotel->id }}" 
                                           {{ in_array($hotel->id, $selectedHotels) ? 'checked' : '' }}
                                           class="w-4 h-4 rounded text-indigo-600 border-gray-300 dark:border-gray-700 focus:ring-indigo-500 mt-0.5">
                                    <div class="text-xs">
                                        <p class="font-semibold">{{ $hotel->name }}</p>
                                        <p class="text-gray-400">📍 <span class="hotel-location-text">{{ $hotel->location }}</span></p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        <p class="text-[11px] text-gray-400">💡 Danh sách tự động tinh gọn hiển thị các khách sạn phù hợp với khu vực bạn điền ở ô "Địa điểm".</p>
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Mô tả chi tiết')" />
                        <textarea id="description" name="description" rows="5" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description', $service->description) }}</textarea>
                    </div>

                    <div>
                        <x-input-label for="image" :value="__('Thay đổi hình ảnh (Bỏ trống nếu giữ ảnh cũ)')" />
                        @if($service->image)
                            <div class="my-2">
                                <p class="text-xs text-gray-400 mb-1">Ảnh hiện tại:</p>
                                <img src="{{ asset('storage/' . $service->image) }}" class="w-32 h-20 object-cover rounded-lg shadow-sm border border-gray-200" onerror="this.src='https://placehold.co/600x400?text=Error+Image'">
                            </div>
                        @endif
                        <input id="image" name="image" type="file" class="block mt-1 w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                    </div>

                    <div class="flex justify-end space-x-2 pt-4">
                        <a href="{{ route('partner.services.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md text-sm transition-colors">Quay lại</a>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md text-sm transition-colors">Cập nhật ngay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category_id');
            const hotelContainer = document.getElementById('hotel_select_container');
            const locationInput = document.getElementById('tour_location_input');

            function checkCategoryVisibility() {
                const selectedOption = categorySelect.options[categorySelect.selectedIndex];
                const slug = selectedOption.getAttribute('data-slug') || '';

                if (slug.includes('tour')) {
                    hotelContainer.classList.remove('hidden');
                } else {
                    hotelContainer.classList.add('hidden');
                }
            }

            function filterHotels() {
                const filterText = locationInput.value.toLowerCase().trim();
                const hotelItems = document.querySelectorAll('.hotel-item'); 
                
                hotelItems.forEach(item => {
                    const locationTextEl = item.querySelector('.hotel-location-text');
                    if (!locationTextEl) return;
                    
                    const hotelLocation = locationTextEl.textContent.toLowerCase().trim();
                    
                    if (filterText === "" || filterText.includes(hotelLocation) || hotelLocation.includes(filterText)) {
                        item.style.setProperty('display', 'flex', 'important');
                    } else {
                        item.style.setProperty('display', 'none', 'important');
                    }
                });
            }
            categorySelect.addEventListener('change', checkCategoryVisibility);
            locationInput.addEventListener('input', filterHotels);

            // Chạy kiểm tra khởi tạo ban đầu khi tải trang
            checkCategoryVisibility();
            filterHotels();
        });
    </script>
</x-app-layout>