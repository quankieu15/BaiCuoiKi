<x-guest-layout>
    <div class="w-full max-w-md bg-slate-900/95 p-6 md:p-8 rounded-2xl shadow-xl border border-slate-800 space-y-6 mx-auto my-8">
        
        <div class="text-center space-y-1">
            <h1 class="text-2xl font-black text-white tracking-tight uppercase">HKT <span class="text-orange-500">TRAVEL</span></h1>
            <p class="text-xs text-slate-400">Đăng ký tài khoản thành viên mới</p>
        </div>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium text-sm text-slate-200 mb-1" for="name">Họ và tên</label>
                <input id="name" class="block mt-1 w-full bg-white border border-slate-700 text-gray-900 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm p-2.5 font-medium" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
            </div>

            <div>
                <label class="block font-medium text-sm text-slate-200 mb-1" for="email">Địa chỉ Email</label>
                <input id="email" class="block mt-1 w-full bg-white border border-slate-700 text-gray-900 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm p-2.5 font-medium" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
            </div>

            <div>
                <label class="block font-medium text-sm text-slate-200 mb-1" for="phone">Số điện thoại</label>
                <input id="phone" class="block mt-1 w-full bg-white border border-slate-700 text-gray-900 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm p-2.5 font-medium" type="text" name="phone" :value="old('phone')" required />
                <x-input-error :messages="$errors->get('phone')" class="mt-2 text-red-400" />
            </div>
            <div>
                <label class="block font-medium text-sm text-slate-200 mb-1" for="password">Mật khẩu</label>
                <input id="password" class="block mt-1 w-full bg-white border border-slate-700 text-gray-900 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm p-2.5 font-medium" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
            </div>

            <div>
                <label class="block font-medium text-sm text-slate-200 mb-1" for="password_confirmation">Xác nhận mật khẩu</label>
                <input id="password_confirmation" class="block mt-1 w-full bg-white border border-slate-700 text-gray-900 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm p-2.5 font-medium" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-slate-800 mt-6">
                <a class="text-xs text-slate-400 hover:text-orange-400 underline rounded-md transition-colors" href="{{ route('login') }}">
                    Bạn đã có tài khoản?
                </a>

                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2.5 px-5 rounded-xl text-xs uppercase tracking-wider transition-colors shadow-sm">
                    Đăng ký ngay
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>