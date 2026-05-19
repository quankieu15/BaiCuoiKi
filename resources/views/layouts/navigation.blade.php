<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="/" class="text-2xl tracking-wider font-sans select-none flex items-center">
                        <span class="font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">HKT</span>
                        <span class="font-extrabold text-orange-500 ml-1.5 relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-orange-500 after:rounded-full">TRAVEL</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="/" :active="request()->is('/')">
                        {{ __('🏠 Xem Trang Chủ') }}
                    </x-nav-link>

                    @if(auth()->user()->role === 'customer')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Hồ sơ của tôi') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->user()->role === 'partner')
                        <x-nav-link :href="route('partner.dashboard')" :active="request()->routeIs('partner.dashboard')">
                            {{ __('Bảng điều khiển') }}
                        </x-nav-link>

                        <x-nav-link :href="route('partner.services.index')" :active="request()->routeIs('partner.services.*')">
                            {{ __('Quản lý Dịch vụ') }}
                        </x-nav-link>

                        <x-nav-link :href="route('partner.orders.index')" :active="request()->routeIs('partner.orders.index')">
                            {{ __('Quản lý Đơn hàng') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Tổng quan hệ thống') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.reviews.index')" :active="request()->routeIs('admin.reviews.*')">
                            {{ __('💬 Kiểm duyệt Đánh giá') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="/" :active="request()->is('/')">
                {{ __('🏠 Xem Trang Chủ') }}
            </x-responsive-nav-link>

            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Admin Dashboard') }}
                </x-responsive-nav-link>
                
                <x-responsive-nav-link :href="route('admin.reviews.index')" :active="request()->routeIs('admin.reviews.*')">
                    {{ __('💬 Kiểm duyệt Đánh giá') }}
                </x-responsive-nav-link>
            @elseif(auth()->user()->role === 'partner')
                <x-responsive-nav-link :href="route('partner.dashboard')" :active="request()->routeIs('partner.dashboard')">
                    {{ __('Bảng điều khiển') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('partner.services.index')" :active="request()->routeIs('partner.services.*')">
                    {{ __('Quản lý Dịch vụ') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('partner.orders.index')" :active="request()->routeIs('partner.orders.index')">
                    {{ __('Quản lý Đơn hàng') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Hồ sơ của tôi') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>