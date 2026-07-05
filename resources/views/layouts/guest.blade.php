<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Diya Collection') }} | @yield('title', 'Sign In')</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-[#f5f5f5]">
        <div class="min-h-screen flex">
            {{-- Left Panel --}}
            <div class="hidden lg:flex lg:w-3/5 relative bg-gradient-to-br from-midnight-900 via-midnight-800 to-daraz-900 text-white flex-col justify-between p-16 overflow-hidden">
                <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiLz48L2c+PC9nPjwvc3ZnPg==')"></div>
                <div class="relative z-10">
                    <a href="/" class="inline-flex items-center gap-2">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center font-bold text-lg">D</div>
                        <span class="font-display text-xl font-bold">Diya</span>
                        <span class="font-display text-xl font-light text-daraz-400">Collection</span>
                    </a>
                </div>
                <div class="relative z-10 max-w-lg">
                    <span class="text-daraz-400 text-xs font-bold uppercase tracking-widest">Premium Boutique</span>
                    <h2 class="text-4xl font-bold mt-4 mb-6 leading-tight">
                        Where Style<br>Meets <span class="text-daraz-400">Sophistication</span>
                    </h2>
                    <p class="text-white/60 text-sm leading-relaxed">Curating timeless, sophisticated fashion with meticulous craftsmanship for individuals who demand distinct style and quality.</p>
                    <div class="flex gap-6 mt-10">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-daraz-400">10K+</p>
                            <p class="text-white/50 text-xs">Happy Customers</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-daraz-400">500+</p>
                            <p class="text-white/50 text-xs">Products</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-daraz-400">99%</p>
                            <p class="text-white/50 text-xs">Satisfaction</p>
                        </div>
                    </div>
                </div>
                <div class="relative z-10 text-white/40 text-xs">&copy; {{ date('Y') }} Diya Collection. Redefining modern luxury.</div>
            </div>

            {{-- Right Panel --}}
            <div class="w-full lg:w-2/5 flex flex-col justify-center items-center px-6 py-12 sm:px-16 bg-white min-h-screen">
                <div class="w-full max-w-md">
                    <div class="mb-8">
                        <a href="/" class="inline-flex items-center gap-2 lg:hidden mb-8">
                            <div class="w-9 h-9 bg-gradient-to-br from-daraz-500 to-daraz-700 rounded-xl flex items-center justify-center text-white font-bold text-sm">D</div>
                            <span class="font-display text-lg font-bold text-midnight-900">Diya</span>
                            <span class="font-display text-lg font-light text-daraz-500">Collection</span>
                        </a>
                        <a href="/" class="text-xs text-gray-400 hover:text-daraz-600 transition-colors flex items-center gap-2 mb-6">
                            <i class="fas fa-arrow-left text-[10px]"></i> Back to Home
                        </a>
                    </div>
                    <div class="bg-white">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
