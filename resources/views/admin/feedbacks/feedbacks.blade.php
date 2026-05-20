@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    {{-- PAGE HEADER --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">

        <div class="flex items-center gap-2 text-[10px] font-extrabold text-blue-600 uppercase tracking-wider mb-1">
            <span>📬 HÒM THƯ LIÊN HỆ</span>
        </div>

        <h2 class="text-xl font-black text-slate-800 tracking-tight flex items-center gap-2">
            📥 QUẢN LÝ Ý KIẾN GÓP Ý & BÁO LỖI
        </h2>

        <p class="text-xs text-slate-400 mt-1 font-semibold leading-relaxed">
            Đọc và xử lý toàn bộ các phản hồi, khiếu nại hoặc đóng góp ý kiến từ form liên hệ.
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
                            Người gửi
                        </th>

                        <th class="px-6 py-4">
                            Tiêu đề góp ý
                        </th>

                        <th class="px-6 py-4">
                            Nội dung chi tiết
                        </th>

                        <th class="px-6 py-4 text-center">
                            Thời gian gửi
                        </th>

                        <th class="px-6 py-4 text-center">
                            Hành động
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">

                    @forelse($feedbacks as $feedback)

                        <tr class="hover:bg-slate-50/60 transition-colors">

                            {{-- USER --}}
                            <td class="px-6 py-5">

                                <div class="font-bold text-slate-800 text-base">
                                    {{ $feedback->name }}
                                </div>

                                <div class="text-xs text-slate-400 mt-1">
                                    {{ $feedback->email }}
                                </div>

                            </td>

                            {{-- SUBJECT --}}
                            <td class="px-6 py-5">

                                <div class="font-bold text-blue-600">
                                    {{ $feedback->subject }}
                                </div>

                            </td>

                            {{-- MESSAGE --}}
                            <td class="px-6 py-5 max-w-lg">

                                <p class="text-sm text-slate-600 leading-relaxed">
                                    {{ $feedback->message }}
                                </p>

                            </td>

                            {{-- CREATED AT --}}
                            <td class="px-6 py-5 text-center text-xs text-slate-400 font-mono">

                                {{ $feedback->created_at->format('d/m/Y H:i') }}

                            </td>

                            {{-- ACTION --}}
                            <td class="px-6 py-5 text-center whitespace-nowrap">

                                <form action="{{ route('admin.feedbacks.destroy', $feedback->id) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa góp ý này không?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-xs font-bold text-rose-600 hover:bg-rose-50 px-3 py-1.5 rounded-xl border border-transparent hover:border-rose-100 transition">

                                        <i class="fa-regular fa-trash-can mr-1"></i>
                                        Xóa

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="px-6 py-20 text-center text-slate-400">

                                <div class="text-4xl mb-3">
                                    📬
                                </div>

                                <div class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                    Hòm thư trống
                                </div>

                                <p class="text-xs text-slate-400 mt-1">
                                    Hiện tại chưa có phản hồi hoặc góp ý nào từ người dùng.
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