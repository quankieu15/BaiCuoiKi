<section class="max-w-xl">
    <header class="mb-6">
        <h2 class="text-xl font-bold text-gray-900 tracking-tight">
            {{ __('Thông tin hồ sơ cá nhân') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500 leading-relaxed">
            {{ __("Cập nhật thông tin tài khoản và ảnh đại diện công khai của bạn.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="flex items-center gap-x-6 p-5 bg-gray-50/80 border border-gray-200/60 rounded-2xl shadow-sm">
            <div class="relative w-20 h-20 rounded-full overflow-hidden ring-4 ring-orange-500/10 bg-white shadow-inner flex-shrink-0">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover" alt="Avatar">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f97316&color=fff&size=128" class="w-full h-full object-cover" alt="Default Avatar">
                @endif
            </div>
            
            <div class="space-y-2">
                <label class="cursor-pointer inline-flex items-center justify-center bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all duration-200 shadow-sm">
                    {{ __('Thay ảnh đại diện mới') }}
                    <input type="file" name="avatar" class="hidden" accept="image/*">
                </label>
                <p class="text-[11px] text-gray-400 block">Định dạng: JPG, PNG. Tối đa 2MB.</p>
                
                @if($errors->get('avatar'))
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $errors->first('avatar') }}</p>
                @endif
            </div>
        </div>

        <div class="space-y-1">
            <x-input-label for="name" :value="__('Họ và tên')" class="text-gray-700 font-semibold text-sm" />
            <x-text-input id="name" name="name" type="text" class="block mt-1 w-full bg-white border-gray-300 text-gray-900 rounded-xl focus:border-orange-500 focus:ring-orange-500 shadow-sm" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="space-y-1">
            <x-input-label for="email" :value="__('Địa chỉ Email')" class="text-gray-700 font-semibold text-sm" />
            <x-text-input id="email" name="email" type="email" class="block mt-1 w-full bg-white border-gray-300 text-gray-900 rounded-xl focus:border-orange-500 focus:ring-orange-500 shadow-sm" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-gray-800 hover:bg-gray-700 text-white font-bold text-xs uppercase tracking-widest rounded-xl shadow-md transition-all duration-150 cursor-pointer">
                {{ __('Lưu thay đổi') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium"
                >{{ __('Đã cập nhật thành công!') }}</p>
            @endif
        </div>
    </form>
</section>