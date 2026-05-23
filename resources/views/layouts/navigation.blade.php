<nav x-data="{ open: false }" class="bg-white/10 backdrop-blur-xl border-b border-white/10 sticky top-0 z-50 shadow-lg">
    <div class="absolute inset-0 -z-10 overflow-hidden">
        <div class="ocean-wave-bg"></div>
    </div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="flex justify-between h-20 items-center" style="display: flex; justify-content: space-between; align-items: center; height: 80px;">
        <div class="flex items-center gap-10" style="display: flex; align-items: center; gap: 40px;">
            <div class="shrink-0 flex items-center" style="display: flex; align-items: center; flex-shrink: 0;">
                
                <a href="/" style="display: inline-flex; align-items: center; background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); padding: 10px 20px; border-radius: 16px; border: 1px solid #e0f2fe; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); text-decoration: none; transition: all 0.3s ease;">
                    
                    <span style="font-size: 24px; font-weight: 900; color: #2563eb; letter-spacing: 0.05em; line-height: 1; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">HKT</span>
                    
                    <span style="font-size: 24px; font-weight: 900; color: #f97316; border-bottom: 4px solid #e76824; padding-bottom: 2px; margin-left: 6px; line-height: 1; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">TRAVEL</span>
                
                </a>
    
            </div>
                {{-- ======================================================= --}}
                {{-- KHU VỰC ĐIỀU HƯỚNG DESKTOP (OCEAN NAV WRAPPER)          --}}
                {{-- ======================================================= --}}
                <div class="hidden space-x-1 sm:-my-px sm:flex items-center h-20 ocean-nav-wrapper">
                    <x-nav-link href="/" :active="request()->is('/')">
                        {{ __('🏠 Xem Trang Chủ') }}
                    </x-nav-link>

                    {{-- 👑 PHÂN HỆ QUẢN TRỊ VIÊN (ADMIN) --}}
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard') || request()->is('admin')">
                            {{ __('🛡️ Tổng quan hệ thống') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.reviews.index')" :active="request()->routeIs('admin.reviews.*')">
                            {{ __('💬 Kiểm duyệt Đánh giá') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.feedbacks.index')" :active="request()->routeIs('admin.feedbacks.*')">
                            {{ __('📥 Quản lý góp ý') }}
                        </x-nav-link>
                    @endif

                    {{-- 📊 PHÂN HỆ ĐỐI TÁC (PARTNER) --}}
                    @if(auth()->user()->role === 'partner')
                        <x-nav-link :href="route('partner.dashboard')" :active="request()->routeIs('partner.dashboard')">
                            {{ __('📊 Bảng điều khiển') }}
                        </x-nav-link>
                        <x-nav-link :href="route('partner.services.index')" :active="request()->routeIs('partner.services.*')">
                            {{ __('🏨 Quản lý Dịch vụ') }}
                        </x-nav-link>
                        <x-nav-link :href="route('partner.orders.index')" :active="request()->routeIs('partner.orders.*')">
                            {{ __('📋 Quản lý Đơn hàng') }}
                        </x-nav-link>
                        <x-nav-link :href="route('partner.feedbacks.index')" :active="request()->routeIs('partner.feedbacks.*')">
                            {{ __('✉️ Hộp thư phản hồi') }}
                        </x-nav-link>
                    @endif

                    {{-- 🧳 PHÂN HỆ KHÁCH HÀNG (CUSTOMER) --}}
                    @if(auth()->user()->role === 'customer')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('🧳 Hồ sơ của tôi') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            {{-- DROPDOWN THÔNG TIN TÀI KHOẢN (DESKTOP) --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-white/20 text-sm leading-4 font-bold rounded-xl text-cyan-100 bg-white/5 backdrop-blur-md hover:bg-white/10 hover:text-white focus:outline-none transition ease-in-out duration-150 group">
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full shadow-sm shadow-emerald-400"></span>
                                {{ Auth::user()->name }}
                            </div>
                            <div class="ms-1.5 group-hover:text-cyan-300">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-2 space-y-1 bg-slate-900/90 backdrop-blur-lg border border-white/10 rounded-[20px] shadow-2xl">
                            <x-dropdown-link :href="route('profile.edit')" class="hover:bg-white/10 rounded-lg text-cyan-200">
                                {{ __('👤 Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="hover:bg-rose-500/20 text-rose-300 rounded-lg">
                                    {{ __('🚨 Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- NÚT BẤM MENU REPSONSIVE (MOBILE) --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-xl text-cyan-100 bg-white/5 hover:text-white hover:bg-white/10 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- KHU VỰC ĐIỀU HƯỚNG MOBILE (OCEAN MOBILE WRAPPER)        --}}
    {{-- ======================================================= --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-950/70 backdrop-blur-xl border-t border-white/10 ocean-mobile-wrapper">
        <div class="pt-3 pb-4 space-y-1.5 px-4">
            <x-responsive-nav-link href="/" :active="request()->is('/')">
                {{ __('🏠 Xem Trang Chủ') }}
            </x-responsive-nav-link>

            {{-- 👑 MENU CHO ADMIN TRÊN MOBILE --}}
            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('👨‍💼 Admin Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.reviews.index')" :active="request()->routeIs('admin.reviews.*')">
                    {{ __('💬 Kiểm duyệt Đánh giá') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.feedbacks.index')" :active="request()->routeIs('admin.feedbacks.*')">
                    {{ __('📥 Quản lý góp ý') }}
                </x-responsive-nav-link>
            
            {{-- 📊 MENU CHO PARTNER TRÊN MOBILE --}}
            @elseif(auth()->user()->role === 'partner')
                <x-responsive-nav-link :href="route('partner.dashboard')" :active="request()->routeIs('partner.dashboard')">
                    {{ __('📊 Bảng điều khiển') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('partner.services.index')" :active="request()->routeIs('partner.services.*')">
                    {{ __('🏨 Quản lý Dịch vụ') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('partner.orders.index')" :active="request()->routeIs('partner.orders.*')">
                    {{ __('📋 Quản lý Đơn hàng') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('partner.feedbacks.index')" :active="request()->routeIs('partner.feedbacks.*')">
                    {{ __('✉️ Hộp thư phản hồi') }}
                </x-responsive-nav-link>
            
            {{-- 🧳 MENU CHO CUSTOMER TRÊN MOBILE --}}
            @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('🧳 Hồ sơ của tôi') }}
                </x-responsive-nav-link>
            @endif
        </div>

        {{-- BOTTOM USER CONTROL PANEL (MOBILE) --}}
        <div class="pt-4 pb-4 border-t border-white/10 bg-white/5 rounded-b-[24px]">
            <div class="px-5 flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-tr from-cyan-400 to-sky-400 rounded-full flex items-center justify-center font-black text-white text-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-bold text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-cyan-300">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="mt-4 space-y-1.5 px-4">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('👤 Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-rose-300 hover:bg-rose-500/20">
                        {{ __('🚨 Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

{{-- ========================================= --}}
{{-- 🌊 STYLE SYSTEM: OCEAN WAVE BACKGROUND    --}}
{{-- ========================================= --}}
<style>
.ocean-wave-bg {
    position: absolute;
    inset: 0;
    z-index: -10;
    background: linear-gradient(-45deg, #06b6d4, #0ea5e9, #2563eb, #22d3ee);
    background-size: 400% 400%;
    animation: gradientMoveNav 10s ease infinite;
    opacity: 0.85;
}

@keyframes gradientMoveNav {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.ocean-wave-bg::before,
.ocean-wave-bg::after {
    content: "";
    position: absolute;
    width: 200%;
    height: 200%;
    top: -50%;
    left: -50%;
    background: radial-gradient(circle at 50% 50%, rgba(255,255,255,0.15), transparent 60%);
    animation: waveMoveNav 12s linear infinite;
}

.ocean-wave-bg::after {
    animation-duration: 18s;
    opacity: 0.3;
    filter: blur(10px);
}

@keyframes waveMoveNav {
    0% { transform: translate(0,0) rotate(0deg); }
    50% { transform: translate(3%,2%) rotate(180deg); }
    100% { transform: translate(0,0) rotate(360deg); }
}

/* ĐÈ STYLE THẺ X-NAV-LINK BẰNG CSS ĐỂ TRÁNH LỖI COMPONENT */
.ocean-nav-wrapper a {
    color: rgba(207, 250, 254, 0.85) !important;
    font-weight: 700 !important;
    font-size: 0.875rem !important;
    border-radius: 999px !important;
    padding: 0.5rem 1.25rem !important;
    transition: all 0.3s ease !important;
    border: none !important; 
    margin-top: auto !important;
    margin-bottom: auto !important;
    display: inline-flex !important;
    align-items: center !important;
}

.ocean-nav-wrapper a:hover {
    background-color: rgba(255, 255, 255, 0.15) !important;
    color: white !important;
    transform: translateY(-1px) !important;
}

/* Style khi link đang active (Desktop) */
.ocean-nav-wrapper a.border-indigo-400,
.ocean-nav-wrapper a[class*="active"], 
.ocean-nav-wrapper a.text-gray-900 {
    background-color: rgba(255, 255, 255, 0.25) !important;
    color: white !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    font-weight: 800 !important;
}

/* ĐÈ STYLE MOBILE RESPONSIVE LINKS */
.ocean-mobile-wrapper a {
    display: block !important;
    width: 100% !important;
    padding: 0.75rem 1rem !important;
    border-radius: 12px !important;
    color: rgba(207, 250, 254, 0.85) !important;
    font-weight: 600 !important;
    border: none !important;
    transition: all 0.2s !important;
}

.ocean-mobile-wrapper a:hover {
    background-color: rgba(255, 255, 255, 0.1) !important;
    color: white !important;
    padding-left: 1.25rem !important;
}

.ocean-mobile-wrapper a.border-indigo-400,
.ocean-mobile-wrapper a[class*="active"] {
    background-color: rgba(6, 182, 212, 0.4) !important;
    color: white !important;
    border-left: 4px solid #22d3ee !important;
    font-weight: 700 !important;
}
</style>