@extends('layouts.partner') {{-- Thay bằng layout thực tế của dự án ông nếu có --}}

@section('content')
<div class="p-6 max-w-7xl mx-auto">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-black text-slate-800">📋 Quản lý dịch vụ</h1>
            <p class="text-xs text-slate-500 font-medium mt-1">Quản lý và theo dõi trạng thái các dịch vụ của bạn trên hệ thống.</p>
        </div>
        <a href="{{ route('partner.services.create') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-bold px-5 py-2.5 rounded-xl transition shadow-sm flex items-center gap-2">
            ➕ Thêm dịch vụ mới
        </a>
    </div>

    <div class="flex flex-wrap gap-2 mb-6 border-b border-slate-100 pb-4">
        @php
            $tabs = [
                'all' => '🌍 Tất cả',
                'domestic_tour' => '🏔️ Tour nội địa',
                'international_tour' => '✈️ Tour quốc tế',
                'hotel' => '🏨 Khách sạn',
                'car' => '🚗 Dịch vụ xe',
                'ticket' => '🎫 Vé tham quan'
            ];
        @endphp
        @foreach($tabs as $key => $label)
            <a href="{{ route('partner.services.index', ['type' => $key]) }}" 
               class="px-4 py-2 rounded-xl text-xs font-black transition {{ (isset($type) && $type === $key) ? 'bg-cyan-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <div class="bg-white/70 backdrop-blur-md rounded-[24px] border border-cyan-100 shadow-sm overflow-hidden">
        <form action="{{ route('partner.services.bulkDelete') }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa các dịch vụ đã chọn?')">
            @csrf
            @method('DELETE')
            
            <div class="p-4 bg-slate-50/50 border-b border-slate-100">
                <button type="submit" class="bg-rose-50 text-rose-600 hover:bg-rose-100 text-xs font-bold px-3 py-1.5 rounded-lg border border-rose-200 transition">
                    🗑️ Xóa mục đã chọn
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-cyan-50/40 text-cyan-900 border-b border-cyan-100 text-xs font-black uppercase tracking-wider">
                            <th class="p-4 w-10 text-center"><input type="checkbox" id="selectAll" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"></th>
                            <th class="p-4">Hình ảnh</th>
                            <th class="p-4">Tên dịch vụ / Đánh giá</th>
                            <th class="p-4">Vị trí</th>
                            <th class="p-4">Giá niêm yết</th>
                            <th class="p-4 text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-slate-100 bg-white">
                        @forelse($services as $service)
                            <tr class="hover:bg-cyan-50/10 transition">
                                <td class="p-4 text-center">
                                    <input type="checkbox" name="ids[]" value="{{ $service->id }}" class="service-checkbox rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                                </td>
                                <td class="p-4">
                                    <img src="{{ asset($service->image ?? 'https://images.unsplash.com/photo-1528127269322-539801943592?w=500') }}" 
                                         class="w-20 h-14 object-cover rounded-xl border border-slate-100 shadow-sm">
                                </td>
                                <td class="p-4">
                                    <div class="font-bold text-slate-800 mb-1">{{ $service->title }}</div>
                                    <div class="flex items-center gap-1.5 text-xs text-slate-500 font-medium">
                                        <span class="text-amber-500 font-bold">⭐ {{ number_format($service->reviews_avg_rating, 1) ?? '0.0' }}</span>
                                        <span>({{ $service->reviews_count ?? 0 }} đánh giá)</span>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-500 font-medium">
                                    <span class="inline-flex items-center gap-1 bg-slate-100 px-2.5 py-1 rounded-lg text-xs">
                                        📍 {{ \Illuminate\Support\Str::limit($service->location, 30) }}
                                    </span>
                                </td>
                                <td class="p-4 font-black text-rose-500 text-base">
                                    {{ number_format($service->price) }} <span class="text-xs font-bold text-slate-400">đ</span>
                                </td>
                                <td class="p-4 text-center">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="{{ route('partner.services.edit', $service->id) }}" class="text-cyan-600 hover:text-cyan-800 font-black text-xs bg-cyan-50 px-2.5 py-1.5 rounded-lg border border-cyan-100 transition">Sửa</a>
                                        <button type="button" onclick="deleteService('{{ $service->id }}')" class="text-rose-600 hover:text-rose-800 font-black text-xs bg-rose-50 px-2.5 py-1.5 rounded-lg border border-rose-100 transition">Xóa</button>
                                        <form id="delete-form-{{ $service->id }}" action="{{ route('partner.services.destroy', $service->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center text-slate-400 font-medium bg-slate-50/30">
                                    <div class="text-3xl mb-2">📦</div>
                                    Không tìm thấy dịch vụ nào thuộc danh mục này.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('selectAll').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.service-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    function deleteService(id) {
        if(confirm('Bạn có chắc chắn muốn xóa hoàn toàn dịch vụ này không?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection