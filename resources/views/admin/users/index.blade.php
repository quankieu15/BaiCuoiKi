@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div class="flex items-center gap-2 text-[10px] font-extrabold text-blue-600 uppercase tracking-wider mb-1">
            <span>👥 QUẢN LÝ TÀI KHOẢN</span>
        </div>

        <h2 class="text-xl font-black text-slate-800 tracking-tight flex items-center gap-2">
            👥 DANH SÁCH THÀNH VIÊN & PHÂN QUYỀN
        </h2>

        <p class="text-xs text-slate-400 mt-1 font-semibold leading-relaxed">
            Nơi quản lý thông tin khách hàng, nhà cung cấp (Partner), cấp quyền hoặc khóa tài khoản vi phạm chính sách.
        </p>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-left border-collapse">

                <thead>
                    <tr class="bg-slate-50/70 text-slate-400 text-[11px] font-bold uppercase tracking-widest border-b border-slate-100">
                        <th class="px-6 py-4">Họ và Tên</th>
                        <th class="px-6 py-4">Địa chỉ Email</th>
                        <th class="px-6 py-4 text-center">Vai trò</th>
                        <th class="px-6 py-4 text-center">Ngày tham gia</th>
                        <th class="px-6 py-4 text-center">Hành động</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">

                    @forelse($users as $user)

                        <tr class="hover:bg-slate-50/60 transition-colors group">

                            {{-- NAME --}}
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 text-base flex items-center gap-2">

                                    <div class="w-2 h-2 rounded-full {{ $user->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></div>

                                    {{ $user->name }}

                                </div>
                            </td>

                            {{-- EMAIL --}}
                            <td class="px-6 py-4 font-medium text-slate-500">
                                {{ $user->email }}
                            </td>

                            {{-- ROLE --}}
                            <td class="px-6 py-4 text-center">

                                <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST" class="inline-block">

                                    @csrf
                                    @method('PATCH')

                                    <select
                                        name="role"
                                        onchange="this.form.submit()"
                                        class="text-xs font-bold px-2 py-1 rounded-md border bg-white cursor-pointer focus:outline-none
                                        {{ $user->role === 'admin'
                                            ? 'bg-red-50 text-red-600 border-red-200'
                                            : ($user->role === 'partner'
                                                ? 'bg-amber-50 text-amber-600 border-amber-200'
                                                : 'bg-blue-50 text-blue-600 border-blue-200') }}"
                                    >

                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                            User
                                        </option>

                                        <option value="partner" {{ $user->role === 'partner' ? 'selected' : '' }}>
                                            Partner
                                        </option>

                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>

                                    </select>

                                </form>

                            </td>

                            {{-- CREATED --}}
                            <td class="px-6 py-4 text-center text-slate-400 text-xs font-mono">

                                {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}

                            </td>

                            {{-- ACTION --}}
                            <td class="px-6 py-4 text-center whitespace-nowrap">

                                <form
                                    action="{{ route('admin.users.toggleStatus', $user->id) }}"
                                    method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn thay đổi trạng thái tài khoản này?')"
                                >

                                    @csrf

                                    @if($user->is_active)

                                        <button
                                            type="submit"
                                            class="text-xs font-bold text-rose-600 hover:bg-rose-50 px-3 py-1.5 rounded-xl border border-transparent hover:border-rose-100 transition"
                                        >

                                            <i class="fa-solid fa-user-slash mr-1"></i>

                                            Khóa tài khoản

                                        </button>

                                    @else

                                        <button
                                            type="submit"
                                            class="text-xs font-bold text-emerald-600 hover:bg-emerald-50 px-3 py-1.5 rounded-xl border border-transparent hover:border-emerald-100 transition"
                                        >

                                            <i class="fa-solid fa-user-check mr-1"></i>

                                            Mở khóa

                                        </button>

                                    @endif

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="px-6 py-20 text-center text-slate-400">

                                <div class="text-4xl mb-3">
                                    👥
                                </div>

                                <div class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                    Danh sách trống
                                </div>

                                <p class="text-xs text-slate-400 mt-1">
                                    Chưa có tài khoản thành viên nào trong hệ thống.
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