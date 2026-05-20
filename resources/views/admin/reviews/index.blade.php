@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    {{-- PAGE HEADER --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div class="flex items-center gap-2 text-[10px] font-extrabold text-blue-600 uppercase tracking-wider mb-1">
            <span>⭐ ĐÁNH GIÁ TỪ KHÁCH HÀNG</span>
        </div>

        <h2 class="text-xl font-black text-slate-800 tracking-tight flex items-center gap-2">
            💬 KIỂM DUYỆT ĐÁNH GIÁ & BÌNH LUẬN
        </h2>

        <p class="text-xs text-slate-400 mt-1 font-semibold leading-relaxed">
            Phê duyệt hoặc ẩn các bình luận, phản hồi từ người dùng về chất lượng Tour/Xe.
        </p>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-800 p-4 rounded-xl text-sm font-bold flex items-center gap-2.5 shadow-sm">
            <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-left border-collapse">

                <thead>
                    <tr class="bg-slate-50/70 text-slate-400 text-[11px] font-bold uppercase tracking-widest border-b border-slate-100">

                        <th class="px-6 py-4">
                            Khách hàng
                        </th>

                        <th class="px-6 py-4">
                            Dịch vụ đánh giá
                        </th>

                        <th class="px-6 py-4 text-center">
                            Số sao
                        </th>

                        <th class="px-6 py-4">
                            Nội dung bình luận
                        </th>

                        <th class="px-6 py-4 text-center">
                            Trạng thái
                        </th>

                        <th class="px-6 py-4 text-center">
                            Hành động
                        </th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">

                    @forelse($reviews as $review)

                        <tr class="hover:bg-slate-50/60 transition-colors">

                            {{-- USER --}}
                            <td class="px-6 py-5">

                                <div class="font-bold text-slate-800 text-base">
                                    {{ $review->user->name ?? 'Người dùng không tồn tại' }}
                                </div>

                                <div class="text-xs text-slate-400 mt-1">
                                    {{ $review->user->email ?? 'N/A' }}
                                </div>

                            </td>

                            {{-- SERVICE --}}
                            <td class="px-6 py-5">

                                <div class="font-bold text-blue-600">
                                    {{ $review->service->title ?? 'Dịch vụ đã bị xóa' }}
                                </div>

                                <div class="text-xs text-slate-400 mt-1">
                                    {{ $review->created_at->format('d/m/Y H:i') }}
                                </div>

                            </td>

                            {{-- RATING --}}
                            <td class="px-6 py-5 text-center">

                                <div class="flex items-center justify-center gap-1 text-amber-400">

                                    @for($i = 1; $i <= 5; $i++)

                                        @if($i <= $review->rating)
                                            <i class="fa-solid fa-star"></i>
                                        @else
                                            <i class="fa-regular fa-star text-slate-300"></i>
                                        @endif

                                    @endfor

                                </div>

                            </td>

                            {{-- COMMENT --}}
                            <td class="px-6 py-5 max-w-md">

                                <p class="text-sm text-slate-600 leading-relaxed">
                                    {{ $review->comment }}
                                </p>

                            </td>

                            {{-- STATUS --}}
                            <td class="px-6 py-5 text-center">

                                @if($review->is_visible)

                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-xl border border-emerald-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Đang hiển thị
                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-600 text-xs font-bold px-3 py-1.5 rounded-xl border border-rose-100">
                                        <i class="fa-solid fa-eye-slash"></i>
                                        Đã ẩn
                                    </span>

                                @endif

                            </td>

                            {{-- ACTION --}}
                            <td class="px-6 py-5 text-center whitespace-nowrap">

                                <form action="{{ route('admin.reviews.toggle', $review->id) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Bạn có chắc chắn muốn thay đổi trạng thái đánh giá này?')">

                                    @csrf

                                    @if($review->is_visible)

                                        <button type="submit"
                                                class="text-xs font-bold text-rose-600 hover:bg-rose-50 px-3 py-1.5 rounded-xl border border-transparent hover:border-rose-100 transition">

                                            <i class="fa-solid fa-eye-slash mr-1"></i>
                                            Ẩn đánh giá

                                        </button>

                                    @else

                                        <button type="submit"
                                                class="text-xs font-bold text-emerald-600 hover:bg-emerald-50 px-3 py-1.5 rounded-xl border border-transparent hover:border-emerald-100 transition">

                                            <i class="fa-solid fa-eye mr-1"></i>
                                            Hiển thị

                                        </button>

                                    @endif

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="px-6 py-20 text-center text-slate-400">

                                <div class="text-4xl mb-3">
                                    💬
                                </div>

                                <div class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                    Không có đánh giá nào
                                </div>

                                <p class="text-xs text-slate-400 mt-1">
                                    Hiện tại chưa có đánh giá nào trong hệ thống.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection