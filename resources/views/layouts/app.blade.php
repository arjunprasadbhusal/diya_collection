<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin | Diya Collection')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
    <div class="min-h-screen">
        {{-- Sidebar --}}
        <aside class="fixed left-0 top-0 bottom-0 w-64 bg-midnight-900 text-white hidden md:flex flex-col z-40">
            <div class="p-6 border-b border-white/10">
                <a href="/" class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-gradient-to-br from-daraz-500 to-daraz-700 rounded-xl flex items-center justify-center text-white font-bold text-sm shadow-lg">D</div>
                    <div>
                        <span class="font-display text-lg font-bold">Diya</span>
                        <span class="font-display text-lg font-light text-daraz-400">Developer</span>
                    </div>
                </a>
            </div>

            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.dashboard') ? 'bg-daraz-500 text-white shadow-lg shadow-daraz-500/30' : 'text-white/60 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-chart-pie w-5 text-center"></i> Dashboard
                </a>
                <a href="{{ route('admin.category.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.category.*') ? 'bg-daraz-500 text-white shadow-lg shadow-daraz-500/30' : 'text-white/60 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-tags w-5 text-center"></i> Categories
                </a>
                <a href="{{ route('admin.product.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.product.*') ? 'bg-daraz-500 text-white shadow-lg shadow-daraz-500/30' : 'text-white/60 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-box w-5 text-center"></i> Products
                </a>
                <a href="{{ route('admin.orders.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.orders.*') ? 'bg-daraz-500 text-white shadow-lg shadow-daraz-500/30' : 'text-white/60 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-truck w-5 text-center"></i> Orders
                </a>
                <a href="{{ route('admin.contact.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.contact.*') ? 'bg-daraz-500 text-white shadow-lg shadow-daraz-500/30' : 'text-white/60 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-envelope w-5 text-center"></i> Messages
                </a>
                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('admin.users.*') ? 'bg-daraz-500 text-white shadow-lg shadow-daraz-500/30' : 'text-white/60 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-users w-5 text-center"></i> Users
                </a>

                <div class="border-t border-white/10 my-4 pt-4">
                    <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-white/40 hover:bg-white/10 hover:text-white transition-all">
                        <i class="fas fa-store w-5 text-center"></i> View Store
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-white/40 hover:bg-white/10 hover:text-white transition-all">
                        <i class="fas fa-user-cog w-5 text-center"></i> Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-white/40 hover:bg-red-500/20 hover:text-red-400 transition-all">
                            <i class="fas fa-sign-out-alt w-5 text-center"></i> Sign Out
                        </button>
                    </form>
                </div>
            </nav>

            <div class="p-4 border-t border-white/10">
                <a href="https://arjunprasadbhusal.com.np" target="_blank" class="text-xs text-white/30 text-center block hover:text-daraz-400 transition-colors">
                    Developed by <span class="font-semibold">Arjun Bhusal</span>
                </a>
            </div>
        </aside>

        {{-- Main Content Area --}}
        <div class="flex-1 flex flex-col min-h-screen md:ml-64">
            {{-- Top Bar --}}
            <header class="bg-white border-b border-gray-200 h-16 md:h-20 flex items-center justify-between px-4 md:px-8 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button id="adminSidebarToggle" class="md:hidden w-10 h-10 flex items-center justify-center rounded-xl hover:bg-gray-100 transition-colors text-gray-500">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    <div>
                        <p class="text-xs text-gray-400 font-medium">Developer Panel</p>
                        <h1 class="text-sm font-bold text-midnight-900 hidden sm:block">@yield('title', 'Dashboard')</h1>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center gap-3 px-4 py-2 bg-gray-50 rounded-xl">
                        <div class="w-8 h-8 bg-gradient-to-br from-daraz-500 to-daraz-700 rounded-lg flex items-center justify-center text-white text-xs font-bold">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="text-sm">
                            <p class="font-semibold text-midnight-900 text-xs">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-[10px] text-gray-400">{{ Auth::user()->email ?? '' }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-xs font-medium text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </button>
                    </form>
                </div>
            </header>

            {{-- Toast Alerts (top-right) --}}
            <div class="fixed top-20 right-4 sm:right-8 z-50 w-full max-w-sm space-y-3 pointer-events-none">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         class="pointer-events-auto bg-midnight-900 text-white p-4 rounded-xl shadow-2xl flex items-center justify-between text-sm font-medium animate-slide-down border-l-4 border-daraz-500">
                        <span><i class="fas fa-check-circle mr-2 text-daraz-400"></i> {{ session('success') }}</span>
                        <button @click="show = false" class="shrink-0 ml-4 text-gray-400 hover:text-white transition-colors"><i class="fas fa-times"></i></button>
                    </div>
                @endif
                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         class="pointer-events-auto bg-midnight-900 text-white p-4 rounded-xl shadow-2xl flex items-center justify-between text-sm font-medium animate-slide-down border-l-4 border-red-500">
                        <span><i class="fas fa-exclamation-circle mr-2 text-red-400"></i> {{ session('error') }}</span>
                        <button @click="show = false" class="shrink-0 ml-4 text-gray-400 hover:text-white transition-colors"><i class="fas fa-times"></i></button>
                    </div>
                @endif
            </div>

            {{-- Content --}}
            <main class="flex-1 p-4 md:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Mobile Sidebar --}}
    <div id="adminMobileOverlay" class="fixed inset-0 bg-black/50 z-50 hidden" style="backdrop-filter: blur(4px);"></div>
    <div id="adminMobileSidebar" class="fixed top-0 left-0 bottom-0 w-64 bg-midnight-900 text-white z-50 transform -translate-x-full transition-transform duration-300 md:hidden shadow-2xl">
        <div class="p-6 border-b border-white/10 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-gradient-to-br from-daraz-500 to-daraz-700 rounded-lg flex items-center justify-center text-white font-bold text-xs">D</div>
                <span class="font-display text-base font-bold">Diya Developer</span>
            </a>
            <button id="adminSidebarClose" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-white/10 transition-colors text-white/60">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="p-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-daraz-500 text-white' : 'text-white/60 hover:bg-white/10' }}">
                <i class="fas fa-chart-pie w-5 text-center"></i> Dashboard
            </a>
            <a href="{{ route('admin.category.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.category.*') ? 'bg-daraz-500 text-white' : 'text-white/60 hover:bg-white/10' }}">
                <i class="fas fa-tags w-5 text-center"></i> Categories
            </a>
            <a href="{{ route('admin.product.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.product.*') ? 'bg-daraz-500 text-white' : 'text-white/60 hover:bg-white/10' }}">
                <i class="fas fa-box w-5 text-center"></i> Products
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.orders.*') ? 'bg-daraz-500 text-white' : 'text-white/60 hover:bg-white/10' }}">
                <i class="fas fa-truck w-5 text-center"></i> Orders
            </a>
            <a href="{{ route('admin.contact.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.contact.*') ? 'bg-daraz-500 text-white' : 'text-white/60 hover:bg-white/10' }}">
                <i class="fas fa-envelope w-5 text-center"></i> Messages
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'bg-daraz-500 text-white' : 'text-white/60 hover:bg-white/10' }}">
                <i class="fas fa-users w-5 text-center"></i> Users
            </a>
            <div class="border-t border-white/10 my-4 pt-4">
                <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-white/40 hover:bg-white/10 hover:text-white">View Store</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-white/40 hover:bg-red-500/20 hover:text-red-400">Sign Out</button>
                </form>
            </div>
        </nav>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('adminSidebarToggle');
            const sidebar = document.getElementById('adminMobileSidebar');
            const overlay = document.getElementById('adminMobileOverlay');
            const close = document.getElementById('adminSidebarClose');
            if (toggle && sidebar && overlay) {
                const open = () => { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); document.body.style.overflow = 'hidden'; };
                const closeSidebar = () => { sidebar.classList.add('-translate-x-full'); overlay.classList.add('hidden'); document.body.style.overflow = ''; };
                toggle.addEventListener('click', open);
                close?.addEventListener('click', closeSidebar);
                overlay.addEventListener('click', closeSidebar);
            }
        });
    </script>
</body>
</html>
