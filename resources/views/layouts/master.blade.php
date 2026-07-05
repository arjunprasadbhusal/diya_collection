<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Diya Collection · Premium Shopping')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @stack('styles')
</head>
<body class="min-h-screen flex flex-col">

  {{-- Top Announcement Bar --}}
  <div class="bg-gradient-to-r from-daraz-600 via-daraz-500 to-daraz-600 text-white text-center text-[11px] font-medium py-2.5 px-4 relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-30"></div>
    <div class="relative z-10 animate-fade-in">
      <span class="inline-block animate-pulse-soft mr-2">🔥</span>
      Free Shipping on orders over $100 — Use Code: <strong class="tracking-wider">DIYA100</strong>
      <a href="{{ route('products.index') }}" class="underline ml-2 font-semibold hover:no-underline">Shop Now</a>
    </div>
  </div>

  {{-- Main Header --}}
  <header class="bg-white shadow-sm sticky top-0 z-50 transition-all duration-300" id="mainHeader">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16 lg:h-20 gap-4">
        {{-- Mobile Menu Toggle --}}
        <button id="mobileMenuBtn" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-gray-100 transition-colors text-midnight-900">
          <i class="fas fa-bars text-lg"></i>
        </button>

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2 group">
          <div class="w-9 h-9 bg-gradient-to-br from-daraz-500 to-daraz-700 rounded-xl flex items-center justify-center text-white font-bold text-sm shadow-md group-hover:shadow-lg transition-all">
            D
          </div>
          <div class="hidden sm:block">
            <span class="font-display text-xl font-bold text-midnight-900 tracking-tight">Diya</span>
            <span class="font-display text-xl font-light text-daraz-500">Collection</span>
          </div>
        </a>

        {{-- Search Bar --}}
        <div class="hidden md:flex flex-1 max-w-2xl mx-4">
          <form action="{{ route('products.index') }}" method="GET" class="w-full relative group">
            <input type="text" name="search" placeholder="Search in Diya Collection..."
                   class="w-full pl-12 pr-4 h-11 bg-gray-100 border-2 border-transparent rounded-xl text-sm 
                          focus:bg-white focus:border-daraz-500 focus:ring-4 focus:ring-daraz-500/10 
                          transition-all duration-200 outline-none placeholder:text-gray-400">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-daraz-500 transition-colors"></i>
            <button type="submit" class="absolute right-1.5 top-1/2 -translate-y-1/2 bg-daraz-500 hover:bg-daraz-600 text-white text-sm px-5 py-1.5 rounded-lg transition-colors font-medium">
              Search
            </button>
          </form>
        </div>

        {{-- Right Icons --}}
        <div class="flex items-center gap-1 sm:gap-2">
          {{-- Search icon for mobile --}}
          <button id="mobileSearchBtn" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-gray-100 transition-colors text-midnight-900">
            <i class="fas fa-search"></i>
          </button>

          {{-- Wishlist --}}
          <a href="{{ route('products.index') }}" class="relative w-10 h-10 hidden sm:flex items-center justify-center rounded-lg hover:bg-gray-100 transition-colors text-midnight-900 group">
            <i class="far fa-heart text-lg group-hover:text-daraz-500 transition-colors"></i>
            <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-daraz-500 text-white text-[8px] font-bold flex items-center justify-center rounded-full">0</span>
          </a>

          {{-- Cart --}}
          <a href="{{ route('cart.index') }}" class="relative w-10 h-10 flex items-center justify-center rounded-lg hover:bg-gray-100 transition-colors text-midnight-900 group">
            <i class="fas fa-shopping-bag text-lg group-hover:text-daraz-500 transition-colors"></i>
            <span class="absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] bg-daraz-500 text-white text-[9px] font-bold flex items-center justify-center rounded-full px-1 shadow-sm">
              {{ $cartCount ?? 0 }}
            </span>
          </a>

          {{-- User --}}
          @guest
            <a href="{{ route('login') }}" class="hidden sm:flex items-center gap-2 px-4 h-10 rounded-lg hover:bg-gray-100 transition-colors text-midnight-900 group">
              <i class="far fa-user-circle text-xl group-hover:text-daraz-500 transition-colors"></i>
              <span class="text-sm font-medium hidden lg:block">Sign In</span>
            </a>
          @endguest
          @auth
            <div class="hidden sm:flex items-center gap-2">
              <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 h-10 rounded-lg hover:bg-gray-100 transition-colors group">
                <i class="far fa-user-circle text-xl group-hover:text-daraz-500 transition-colors"></i>
                <span class="text-sm font-medium hidden lg:block max-w-[100px] truncate">{{ Auth::user()->name }}</span>
              </a>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-red-50 transition-colors text-gray-400 hover:text-red-500">
                  <i class="fas fa-sign-out-alt"></i>
                </button>
              </form>
            </div>
          @endauth
        </div>
      </div>
    </div>

    {{-- Mobile Search Bar (toggled) --}}
    <div id="mobileSearch" class="hidden md:hidden px-4 pb-4 animate-slide-down">
      <form action="{{ route('products.index') }}" method="GET" class="relative">
        <input type="text" name="search" placeholder="Search products..."
               class="w-full pl-11 pr-4 h-11 bg-gray-100 rounded-xl text-sm focus:bg-white focus:border-daraz-500 focus:ring-4 focus:ring-daraz-500/10 transition-all outline-none border-2 border-transparent">
        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
      </form>
    </div>

    {{-- Category Nav --}}
    <div class="border-t border-gray-100 bg-white overflow-x-auto scrollbar-hide">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-1 py-2 text-sm whitespace-nowrap">
        <a href="{{ route('home') }}" class="px-3 py-1.5 rounded-lg hover:bg-daraz-50 hover:text-daraz-600 transition-colors font-medium {{ request()->routeIs('home') ? 'text-daraz-600 bg-daraz-50' : 'text-gray-600' }}">
          <i class="fas fa-home mr-1.5"></i>Home
        </a>
        <span class="text-gray-300">|</span>
        <a href="{{ route('products.index') }}" class="px-3 py-1.5 rounded-lg hover:bg-daraz-50 hover:text-daraz-600 transition-colors font-medium {{ request()->routeIs('products.*') ? 'text-daraz-600 bg-daraz-50' : 'text-gray-600' }}">
          <i class="fas fa-store mr-1.5"></i>All Products
        </a>
        @if(isset($categories) && count($categories) > 0)
          @foreach($categories->take(6) as $cat)
            <a href="{{ route('products.index', ['category' => $cat->slug]) }}" 
               class="px-3 py-1.5 rounded-lg hover:bg-daraz-50 hover:text-daraz-600 transition-colors text-gray-600">
              {{ $cat->name }}
            </a>
          @endforeach
        @endif
        <a href="{{ route('about') }}" class="px-3 py-1.5 rounded-lg hover:bg-daraz-50 hover:text-daraz-600 transition-colors text-gray-600">
          About Us
        </a>
        <a href="{{ route('contact') }}" class="px-3 py-1.5 rounded-lg hover:bg-daraz-50 hover:text-daraz-600 transition-colors text-gray-600">
          Contact
        </a>
      </div>
    </div>
  </header>

  {{-- Mobile Sidebar Overlay --}}
  <div id="mobileSidebarOverlay" class="fixed inset-0 bg-black/50 z-50 hidden lg:hidden" style="backdrop-filter: blur(4px);"></div>
  <div id="mobileSidebar" class="fixed top-0 left-0 bottom-0 w-72 bg-white z-50 transform -translate-x-full transition-transform duration-300 lg:hidden shadow-2xl overflow-y-auto">
    <div class="p-6 border-b border-gray-100">
      <div class="flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
          <div class="w-8 h-8 bg-gradient-to-br from-daraz-500 to-daraz-700 rounded-lg flex items-center justify-center text-white font-bold text-xs">D</div>
          <span class="font-display text-lg font-bold">Diya Collection</span>
        </a>
        <button id="mobileSidebarClose" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 transition-colors">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="p-4 space-y-1">
      @guest
        <a href="{{ route('login') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-daraz-50 text-daraz-600 font-semibold mb-4">
          <i class="fas fa-sign-in-alt"></i>
          Sign In / Register
        </a>
      @endguest
      @auth
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-daraz-50 text-daraz-600 font-semibold mb-4">
          <i class="far fa-user-circle"></i>
          {{ Auth::user()->name }}
        </a>
      @endauth
      <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 font-medium">
        <i class="fas fa-home w-5 text-center text-daraz-500"></i> Home
      </a>
      <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 font-medium">
        <i class="fas fa-store w-5 text-center text-daraz-500"></i> All Products
      </a>
      <div class="border-t border-gray-100 my-2 pt-2">
        <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 px-4 mb-2">Categories</p>
        @if(isset($categories) && count($categories) > 0)
          @foreach($categories->take(8) as $cat)
            <a href="{{ route('products.index', ['category' => $cat->slug]) }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-gray-50 transition-colors text-gray-600 text-sm">
              <span class="w-2 h-2 rounded-full bg-daraz-300"></span>
              {{ $cat->name }}
            </a>
          @endforeach
        @endif
      </div>
      <div class="border-t border-gray-100 my-2 pt-2">
        <a href="{{ route('about') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors text-gray-600">
          <i class="fas fa-info-circle w-5 text-center text-gray-400"></i> About Us
        </a>
        <a href="{{ route('contact') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors text-gray-600">
          <i class="fas fa-envelope w-5 text-center text-gray-400"></i> Contact
        </a>
      </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-100 bg-gray-50">
      <p class="text-xs text-gray-400 text-center">&copy; 2026 Diya Collection</p>
    </div>
  </div>

  {{-- Page Content --}}
  <main class="flex-1">
    @yield('content')
  </main>

  {{-- Footer --}}
  <footer class="bg-midnight-900 text-white">
    {{-- Newsletter Section --}}
    <div class="border-b border-white/10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
          <div>
            <h3 class="text-xl font-bold font-display">Subscribe to our newsletter</h3>
            <p class="text-white/60 text-sm mt-1">Get exclusive offers and new arrivals directly in your inbox.</p>
          </div>
          <form class="flex w-full md:w-auto gap-2">
            <input type="email" placeholder="Enter your email" 
                   class="flex-1 md:w-72 px-5 py-3 bg-white/10 border border-white/20 rounded-xl text-sm text-white placeholder:text-white/40 focus:outline-none focus:border-daraz-500 focus:ring-2 focus:ring-daraz-500/30 transition-all">
            <button type="submit" class="btn-daraz whitespace-nowrap">
              Subscribe <i class="fas fa-paper-plane ml-2 text-xs"></i>
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-10">
        {{-- Brand --}}
        <div class="lg:col-span-1">
          <div class="flex items-center gap-2 mb-5">
            <div class="w-10 h-10 bg-gradient-to-br from-daraz-500 to-daraz-700 rounded-xl flex items-center justify-center text-white font-bold text-base shadow-lg">D</div>
            <div>
              <span class="font-display text-xl font-bold">Diya</span>
              <span class="font-display text-xl font-light text-daraz-400">Collection</span>
            </div>
          </div>
          <p class="text-white/50 text-sm leading-relaxed mb-6">Premium fashion curated for the modern individual. Quality craftsmanship meets contemporary design.</p>
          <div class="flex gap-3">
            <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-daraz-500 transition-colors text-white/70 hover:text-white">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-daraz-500 transition-colors text-white/70 hover:text-white">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-daraz-500 transition-colors text-white/70 hover:text-white">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-daraz-500 transition-colors text-white/70 hover:text-white">
              <i class="fab fa-pinterest-p"></i>
            </a>
          </div>
        </div>

        {{-- Customer Service --}}
        <div>
          <h4 class="text-sm font-bold uppercase tracking-widest text-daraz-400 mb-5">Customer Service</h4>
          <ul class="space-y-3">
            <li><a href="#" class="text-white/60 hover:text-white transition-colors text-sm">Help Center</a></li>
            <li><a href="#" class="text-white/60 hover:text-white transition-colors text-sm">Order Tracking</a></li>
            <li><a href="{{ route('contact') }}" class="text-white/60 hover:text-white transition-colors text-sm">Contact Us</a></li>
            <li><a href="#" class="text-white/60 hover:text-white transition-colors text-sm">Returns & Exchanges</a></li>
            <li><a href="#" class="text-white/60 hover:text-white transition-colors text-sm">Shipping Info</a></li>
          </ul>
        </div>

        {{-- Quick Links --}}
        <div>
          <h4 class="text-sm font-bold uppercase tracking-widest text-daraz-400 mb-5">Quick Links</h4>
          <ul class="space-y-3">
            <li><a href="{{ route('about') }}" class="text-white/60 hover:text-white transition-colors text-sm">About Us</a></li>
            <li><a href="{{ route('products.index') }}" class="text-white/60 hover:text-white transition-colors text-sm">Shop All</a></li>
            <li><a href="#" class="text-white/60 hover:text-white transition-colors text-sm">New Arrivals</a></li>
            <li><a href="#" class="text-white/60 hover:text-white transition-colors text-sm">Sale</a></li>
            <li><a href="#" class="text-white/60 hover:text-white transition-colors text-sm">Gift Cards</a></li>
          </ul>
        </div>

        {{-- Policies --}}
        <div>
          <h4 class="text-sm font-bold uppercase tracking-widest text-daraz-400 mb-5">Policies</h4>
          <ul class="space-y-3">
            <li><a href="#" class="text-white/60 hover:text-white transition-colors text-sm">Privacy Policy</a></li>
            <li><a href="#" class="text-white/60 hover:text-white transition-colors text-sm">Terms of Service</a></li>
            <li><a href="#" class="text-white/60 hover:text-white transition-colors text-sm">Cookie Policy</a></li>
            <li><a href="#" class="text-white/60 hover:text-white transition-colors text-sm">Refund Policy</a></li>
          </ul>
        </div>

        {{-- Trust Badges --}}
        <div>
          <h4 class="text-sm font-bold uppercase tracking-widest text-daraz-400 mb-5">We Accept</h4>
          <div class="flex flex-wrap gap-2 mb-6">
            <div class="px-3 py-2 bg-white/10 rounded-lg text-white/60 text-xs font-medium">Visa</div>
            <div class="px-3 py-2 bg-white/10 rounded-lg text-white/60 text-xs font-medium">MC</div>
            <div class="px-3 py-2 bg-white/10 rounded-lg text-white/60 text-xs font-medium">Amex</div>
            <div class="px-3 py-2 bg-white/10 rounded-lg text-white/60 text-xs font-medium">PayPal</div>
            <div class="px-3 py-2 bg-white/10 rounded-lg text-white/60 text-xs font-medium">COD</div>
          </div>
          <div class="flex items-center gap-3 text-white/40 text-xs">
            <i class="fas fa-lock text-daraz-400"></i>
            <span>100% Secure Checkout</span>
          </div>
          <div class="flex items-center gap-3 text-white/40 text-xs mt-2">
            <i class="fas fa-truck text-daraz-400"></i>
            <span>Free Shipping $100+</span>
          </div>
          <div class="flex items-center gap-3 text-white/40 text-xs mt-2">
            <i class="fas fa-undo text-daraz-400"></i>
            <span>30-Day Returns</span>
          </div>
        </div>
      </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-white/10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="text-white/40 text-xs">&copy; {{ date('Y') }} Diya Collection. All rights reserved.</p>
        <div class="flex gap-6">
          <a href="#" class="text-white/40 hover:text-white transition-colors text-xs">Privacy</a>
          <a href="#" class="text-white/40 hover:text-white transition-colors text-xs">Terms</a>
          <a href="#" class="text-white/40 hover:text-white transition-colors text-xs">Cookies</a>
        </div>
      </div>
    </div>
  </footer>

  {{-- Floating Cart Button --}}
  <a href="{{ route('cart.index') }}" 
     class="fixed bottom-6 right-6 z-40 bg-daraz-500 text-white w-14 h-14 rounded-2xl shadow-xl 
            hover:bg-daraz-600 hover:scale-110 hover:shadow-2xl 
            transition-all duration-300 flex items-center justify-center group"
     id="floatingCart">
    <i class="fas fa-shopping-bag text-xl"></i>
    <span class="absolute -top-1.5 -right-1.5 min-w-[22px] h-[22px] bg-red-500 text-white text-[10px] font-bold flex items-center justify-center rounded-full px-1.5 shadow-lg">
      {{ $cartCount ?? 0 }}
    </span>
  </a>

  {{-- Scroll to Top --}}
  <button id="scrollToTop" 
          class="fixed bottom-24 right-6 z-40 w-11 h-11 bg-white shadow-lg rounded-xl 
                 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 
                 flex items-center justify-center text-midnight-900 border border-gray-200
                 opacity-0 invisible">
    <i class="fas fa-chevron-up"></i>
  </button>

  <script>
    // Mobile sidebar toggle
    document.addEventListener('DOMContentLoaded', function() {
      const menuBtn = document.getElementById('mobileMenuBtn');
      const sidebar = document.getElementById('mobileSidebar');
      const overlay = document.getElementById('mobileSidebarOverlay');
      const closeBtn = document.getElementById('mobileSidebarClose');
      const searchBtn = document.getElementById('mobileSearchBtn');
      const mobileSearch = document.getElementById('mobileSearch');
      const scrollBtn = document.getElementById('scrollToTop');

      if (menuBtn && sidebar && overlay) {
        const openSidebar = () => {
          sidebar.classList.remove('-translate-x-full');
          overlay.classList.remove('hidden');
          document.body.style.overflow = 'hidden';
        };
        const closeSidebar = () => {
          sidebar.classList.add('-translate-x-full');
          overlay.classList.add('hidden');
          document.body.style.overflow = '';
        };
        menuBtn.addEventListener('click', openSidebar);
        closeBtn?.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);
      }

      if (searchBtn && mobileSearch) {
        searchBtn.addEventListener('click', () => {
          mobileSearch.classList.toggle('hidden');
        });
      }

      // Scroll to top
      if (scrollBtn) {
        window.addEventListener('scroll', () => {
          if (window.scrollY > 400) {
            scrollBtn.classList.remove('opacity-0', 'invisible');
            scrollBtn.classList.add('opacity-100', 'visible');
          } else {
            scrollBtn.classList.add('opacity-0', 'invisible');
            scrollBtn.classList.remove('opacity-100', 'visible');
          }
        });
        scrollBtn.addEventListener('click', () => {
          window.scrollTo({ top: 0, behavior: 'smooth' });
        });
      }

      // Floating cart entrance animation
      const cart = document.getElementById('floatingCart');
      if (cart) {
        cart.style.opacity = '0';
        cart.style.transform = 'scale(0.5) translateY(20px)';
        setTimeout(() => {
          cart.style.transition = 'all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1)';
          cart.style.opacity = '1';
          cart.style.transform = 'scale(1) translateY(0)';
        }, 400);
      }

      // Header shadow on scroll
      const header = document.getElementById('mainHeader');
      if (header) {
        window.addEventListener('scroll', () => {
          if (window.scrollY > 10) {
            header.classList.add('shadow-md');
          } else {
            header.classList.remove('shadow-md');
          }
        });
      }
    });

    @stack('scripts')
  </script>
</body>
</html>
