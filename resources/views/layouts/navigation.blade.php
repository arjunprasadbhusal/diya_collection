<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    @php
        $dashboardUrl = Auth::user()->is_admin ? route('admin.dashboard') : route('home');
        $dashboardLabel = Auth::user()->is_admin ? __('Dashboard') : __('Home');
    @endphp
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <a href="{{ $dashboardUrl }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-daraz-500 to-daraz-700 rounded-lg flex items-center justify-center text-white font-bold text-xs">D</div>
                    <span class="font-display text-lg font-bold text-midnight-900 hidden sm:block">Diya</span>
                </a>
                <div class="hidden space-x-6 sm:flex">
                    <x-nav-link :href="$dashboardUrl" :active="Auth::user()->is_admin ? request()->routeIs('admin.dashboard') : request()->routeIs('home')" class="text-sm font-medium text-gray-600 hover:text-daraz-600 transition-colors">
                        {{ $dashboardLabel }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-4">
                <div class="flex items-center gap-3 px-4 py-2 bg-gray-50 rounded-xl">
                    <div class="w-8 h-8 bg-gradient-to-br from-daraz-500 to-daraz-700 rounded-lg flex items-center justify-center text-white text-xs font-bold">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    <span class="text-sm font-semibold text-midnight-900">{{ Auth::user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-xs font-medium text-red-500 hover:text-red-600 bg-red-50 hover:bg-red-100 px-4 py-2 rounded-lg transition-all">
                        <i class="fas fa-sign-out-alt mr-1"></i> Log Out
                    </button>
                </form>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition-colors">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="$dashboardUrl" :active="Auth::user()->is_admin ? request()->routeIs('admin.dashboard') : request()->routeIs('home')">
                {{ $dashboardLabel }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-3 border-t border-gray-100 px-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-daraz-500 to-daraz-700 rounded-xl flex items-center justify-center text-white font-bold text-sm">
                    {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                </div>
                <div>
                    <div class="font-medium text-sm text-midnight-900">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="fas fa-user-cog mr-2"></i> {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
