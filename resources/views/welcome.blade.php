@extends('layouts.master')

@section('title', 'Diya Collection | Premium Fashion Shopping')

@section('content')

{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-midnight-900 via-midnight-800 to-daraz-900 overflow-hidden">
  <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMjAgMzBhMTAgMTAgMCAwIDEgMC0yMCAxMCAxMCAwIDAgMSAwIDIweiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZmZmIiBzdHJva2Utb3BhY2l0eT0iMC4wMyIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9zdmc+')] opacity-50"></div>
  <div class="absolute top-1/2 -translate-y-1/2 right-0 w-96 h-96 bg-daraz-500/20 rounded-full blur-3xl"></div>
  <div class="absolute -bottom-20 left-1/2 -translate-x-1/2 w-[800px] h-40 bg-gradient-to-r from-transparent via-daraz-500/10 to-transparent blur-2xl"></div>
  
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="animate-fade-in">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-daraz-300 text-xs font-medium mb-6 border border-white/10">
          <span class="w-2 h-2 bg-daraz-400 rounded-full animate-pulse-soft"></span>
          New Season Collection 2026
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
          Elevate Your<br>
          <span class="text-daraz-400">Everyday Style</span>
        </h1>
        <p class="text-white/60 text-base md:text-lg max-w-lg mb-8 leading-relaxed">
          Discover curated fashion pieces that blend timeless elegance with modern comfort. Quality craftsmanship, delivered to your door.
        </p>
        <div class="flex flex-wrap gap-4">
          <a href="{{ route('products.index') }}" class="btn-daraz px-8 py-4 text-base shadow-xl shadow-daraz-500/25 hover:shadow-daraz-500/40">
            Shop Now <i class="fas fa-arrow-right ml-2"></i>
          </a>
          <a href="{{ route('about') }}" class="inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-lg hover:bg-white/20 transition-all font-medium border border-white/10">
            Learn More <i class="fas fa-play ml-2 text-xs"></i>
          </a>
        </div>
        <div class="flex flex-wrap gap-8 mt-10 pt-8 border-t border-white/10">
          <div>
            <p class="text-2xl font-bold text-white">10K+</p>
            <p class="text-white/40 text-sm">Happy Customers</p>
          </div>
          <div>
            <p class="text-2xl font-bold text-white">500+</p>
            <p class="text-white/40 text-sm">Premium Products</p>
          </div>
          <div>
            <p class="text-2xl font-bold text-white">99%</p>
            <p class="text-white/40 text-sm">Satisfaction Rate</p>
          </div>
        </div>
      </div>
      <div class="hidden lg:flex justify-center">
        <div class="relative w-80 h-80 md:w-96 md:h-96 rounded-3xl overflow-hidden shadow-2xl border border-white/10">
          <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=2070&auto=format&fit=crop"
               alt="Premium Fashion Collection"
               class="w-full h-full object-cover">
          <div class="absolute inset-0 bg-gradient-to-t from-midnight-900/60 via-transparent to-transparent"></div>
          <div class="absolute bottom-6 left-6 right-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-md rounded-full text-white text-xs font-semibold border border-white/20">
              <span class="w-2 h-2 bg-daraz-400 rounded-full"></span>
              Premium Collection
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Flash Sales Section --}}
<section class="py-10 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="card-daraz overflow-hidden border-daraz-200 border-2">
      <div class="bg-gradient-to-r from-daraz-500 to-daraz-700 px-6 py-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
          <div class="bg-white/20 backdrop-blur-sm rounded-xl px-4 py-2">
            <i class="fas fa-bolt text-white text-2xl"></i>
          </div>
          <div>
            <h3 class="text-white font-bold text-xl">Flash Sale</h3>
            <p class="text-daraz-200 text-sm">Limited time offers — grab them before they're gone!</p>
          </div>
        </div>
        <div class="flex items-center gap-3 text-white">
          <span class="text-sm font-medium">Ends in:</span>
          <div class="flex gap-2" id="flashCountdown">
            <div class="bg-white/20 backdrop-blur-sm rounded-lg px-3 py-2 text-center min-w-[50px]">
              <span class="text-xl font-bold block" id="hours">02</span>
              <span class="text-[9px] uppercase tracking-wider text-daraz-200">Hrs</span>
            </div>
            <div class="text-xl font-bold self-center">:</div>
            <div class="bg-white/20 backdrop-blur-sm rounded-lg px-3 py-2 text-center min-w-[50px]">
              <span class="text-xl font-bold block" id="minutes">45</span>
              <span class="text-[9px] uppercase tracking-wider text-daraz-200">Min</span>
            </div>
            <div class="text-xl font-bold self-center">:</div>
            <div class="bg-white/20 backdrop-blur-sm rounded-lg px-3 py-2 text-center min-w-[50px]">
              <span class="text-xl font-bold block" id="seconds">30</span>
              <span class="text-[9px] uppercase tracking-wider text-daraz-200">Sec</span>
            </div>
          </div>
        </div>
      </div>
      <div class="p-6">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
          @forelse($featuredProducts->take(6) as $product)
          <a href="{{ route('products.show', $product->id) }}" class="group">
            <div class="relative bg-gray-50 rounded-xl overflow-hidden aspect-[3/4] mb-3">
              @if($product->image)
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
              @else
                <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-300 text-xs">No Image</div>
              @endif
              <div class="absolute top-2 left-2 badge-sale text-[9px] px-2 py-0.5">
                -20%
              </div>
              <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <div class="absolute bottom-2 left-2 right-2 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                <span class="block w-full text-center bg-white text-midnight-900 text-[10px] font-bold py-2 rounded-lg uppercase tracking-wider shadow-lg">
                  Quick View
                </span>
              </div>
            </div>
            <h4 class="text-xs font-medium text-gray-700 line-clamp-2 leading-snug group-hover:text-daraz-600 transition-colors">{{ $product->name }}</h4>
            <div class="flex items-center gap-2 mt-1">
              <span class="text-sm font-bold text-daraz-600">Rs. {{ number_format($product->price, 2) }}</span>
              <span class="text-[10px] line-through text-gray-400">Rs. {{ number_format($product->price * 1.25, 2) }}</span>
            </div>
            <div class="mt-2 bg-daraz-50 rounded-full h-1.5 overflow-hidden">
              <div class="bg-daraz-500 h-full rounded-full" style="width: {{ rand(40, 90) }}%"></div>
            </div>
            <p class="text-[10px] text-daraz-600 font-medium mt-1">Sold: {{ rand(50, 200) }}</p>
          </a>
          @empty
          <div class="col-span-6 py-12 text-center text-gray-400 text-sm">
            <i class="fas fa-tag text-3xl mb-3 block text-gray-300"></i>
            Flash deals coming soon!
          </div>
          @endforelse
        </div>
        <div class="text-center mt-6">
          <a href="{{ route('products.index') }}" class="btn-daraz-outline px-10 text-xs">
            View All Deals <i class="fas fa-arrow-right ml-2"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Categories Grid --}}
<section class="py-12 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
      <div>
        <h2 class="section-title">Shop by Category</h2>
        <p class="section-subtitle">Find what you're looking for</p>
      </div>
      <a href="{{ route('products.index') }}" class="text-daraz-600 hover:text-daraz-700 font-medium text-sm flex items-center gap-1">
        View All <i class="fas fa-arrow-right text-xs"></i>
      </a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">
      @forelse($categories as $category)
      <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group relative">
        <div class="aspect-[4/5] rounded-2xl overflow-hidden shadow-sm group-hover:shadow-xl transition-all duration-500 bg-gray-100">
          @if($category->image)
            <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
          @else
            <div class="w-full h-full bg-gradient-to-br from-daraz-100 to-daraz-200 flex items-center justify-center">
              <i class="fas fa-tag text-4xl text-daraz-400/60"></i>
            </div>
          @endif
          <div class="absolute inset-0 bg-gradient-to-t from-midnight-900/85 via-midnight-900/20 to-transparent group-hover:from-daraz-900/90 transition-all duration-500"></div>
          <div class="absolute bottom-0 left-0 right-0 p-5">
            <div class="flex items-center gap-2 mb-1">
              <span class="w-1.5 h-1.5 rounded-full bg-daraz-400"></span>
              <span class="text-[10px] font-semibold uppercase tracking-wider text-daraz-300">{{ $category->products_count ?? 0 }} Items</span>
            </div>
            <h3 class="text-base font-bold text-white group-hover:text-daraz-300 transition-colors">{{ $category->name }}</h3>
          </div>
          <div class="absolute top-4 right-4 w-8 h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-2 group-hover:translate-x-0">
            <i class="fas fa-arrow-right text-xs text-white"></i>
          </div>
        </div>
      </a>
      @empty
      <div class="col-span-6 py-12 text-center text-gray-400 text-sm border-2 border-dashed border-gray-200 rounded-xl">
        Categories coming soon!
      </div>
      @endforelse
    </div>
  </div>
</section>

{{-- Featured Products --}}
<section class="py-12 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
      <div>
        <h2 class="section-title">Featured Products</h2>
        <p class="section-subtitle">Our handpicked selection for you</p>
      </div>
      <a href="{{ route('products.index') }}" class="text-daraz-600 hover:text-daraz-700 font-medium text-sm flex items-center gap-1">
        See More <i class="fas fa-arrow-right text-xs"></i>
      </a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5">
      @forelse($featuredProducts as $product)
      <div class="group card-daraz-hover overflow-hidden">
        <a href="{{ route('products.show', $product->id) }}" class="block">
          <div class="relative aspect-[3/4] bg-gray-50 overflow-hidden">
            @if($product->image)
              <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            @else
              <div class="w-full h-full flex items-center justify-center text-gray-300 text-xs">No Image</div>
            @endif
            @if($loop->index < 2)
              <div class="absolute top-3 left-3 badge-new">New</div>
            @endif
          </div>
        </a>
        <a href="{{ route('products.show', $product->id) }}" class="block w-full bg-midnight-900 text-white py-3 text-center text-xs font-bold uppercase tracking-wider hover:bg-daraz-600 transition-colors">
          <i class="fas fa-eye mr-2"></i> Quick View
        </a>
        <div class="p-4">
          <span class="text-[10px] font-semibold uppercase tracking-widest text-daraz-600">{{ $product->category->name ?? 'Fashion' }}</span>
          <a href="{{ route('products.show', $product->id) }}">
            <h4 class="text-sm font-semibold text-gray-800 mt-1 line-clamp-2 hover:text-daraz-600 transition-colors leading-snug">{{ $product->name }}</h4>
          </a>
          <div class="flex items-center gap-1 mt-2 mb-2">
            @for($i = 1; $i <= 5; $i++)
              <i class="fas fa-star text-[10px] {{ $i <= 4 ? 'text-amber-400' : 'text-gray-200' }}"></i>
            @endfor
            <span class="text-[10px] text-gray-400 ml-1">({{ rand(10, 99) }})</span>
          </div>
          <div class="flex items-center gap-2">
            <span class="text-lg font-bold text-daraz-600">Rs. {{ number_format($product->price, 2) }}</span>
            @if($loop->index % 2 == 0)
              <span class="text-xs line-through text-gray-400">Rs. {{ number_format($product->price * 1.25, 2) }}</span>
              <span class="text-[10px] font-bold text-red-500 bg-red-50 px-1.5 py-0.5 rounded">-20%</span>
            @endif
          </div>
          <div class="mt-2 flex items-center gap-1 text-[10px]">
            <i class="fas fa-truck text-daraz-500"></i>
            <span class="text-gray-500">Free shipping</span>
          </div>
        </div>
      </div>
      @empty
      <div class="col-span-5 py-20 text-center border-2 border-dashed border-gray-200 rounded-xl">
        <i class="fas fa-box-open text-4xl text-gray-300 mb-4 block"></i>
        <p class="text-gray-400 text-sm">Products coming soon. Stay tuned!</p>
      </div>
      @endforelse
    </div>
  </div>
</section>

{{-- Banner Section --}}
<section class="py-10 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <a href="{{ route('products.index') }}" class="group relative rounded-2xl overflow-hidden h-48 md:h-56">
        <div class="absolute inset-0 bg-gradient-to-r from-midnight-900/80 to-transparent z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-daraz-500 to-daraz-800"></div>
        <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiLz48L2c+PC9nPjwvc3ZnPg==')"></div>
        <div class="absolute inset-0 z-20 flex items-center px-8">
          <div>
            <span class="text-daraz-300 text-xs font-bold uppercase tracking-widest">Summer Collection</span>
            <h3 class="text-white text-2xl md:text-3xl font-bold mt-1">Up to 40% Off</h3>
            <p class="text-white/70 text-sm mt-1">On selected styles. Limited time only.</p>
            <span class="inline-flex items-center mt-4 text-white font-semibold text-sm group-hover:underline">
              Shop Sale <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
            </span>
          </div>
        </div>
      </a>
      <a href="{{ route('products.index') }}" class="group relative rounded-2xl overflow-hidden h-48 md:h-56">
        <div class="absolute inset-0 bg-gradient-to-r from-midnight-900/80 to-transparent z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-midnight-800 to-midnight-900"></div>
        <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiLz48L2c+PC9nPjwvc3ZnPg==')"></div>
        <div class="absolute inset-0 z-20 flex items-center px-8">
          <div>
            <span class="text-daraz-300 text-xs font-bold uppercase tracking-widest">New Arrivals</span>
            <h3 class="text-white text-2xl md:text-3xl font-bold mt-1">Premium Quality</h3>
            <p class="text-white/70 text-sm mt-1">Ethically sourced, timeless designs.</p>
            <span class="inline-flex items-center mt-4 text-white font-semibold text-sm group-hover:underline">
              Explore <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
            </span>
          </div>
        </div>
      </a>
    </div>
  </div>
</section>

{{-- Brand Values --}}
<section class="py-12 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
      <div class="text-center p-6 rounded-2xl bg-gray-50 hover:bg-daraz-50 transition-colors group">
        <div class="w-14 h-14 mx-auto mb-4 rounded-xl bg-daraz-100 flex items-center justify-center group-hover:bg-daraz-500 transition-colors">
          <i class="fas fa-truck text-2xl text-daraz-600 group-hover:text-white transition-colors"></i>
        </div>
        <h4 class="font-semibold text-gray-800 text-sm">Free Shipping</h4>
        <p class="text-xs text-gray-500 mt-1">On orders over Rs. 100</p>
      </div>
      <div class="text-center p-6 rounded-2xl bg-gray-50 hover:bg-daraz-50 transition-colors group">
        <div class="w-14 h-14 mx-auto mb-4 rounded-xl bg-daraz-100 flex items-center justify-center group-hover:bg-daraz-500 transition-colors">
          <i class="fas fa-undo text-2xl text-daraz-600 group-hover:text-white transition-colors"></i>
        </div>
        <h4 class="font-semibold text-gray-800 text-sm">Easy Returns</h4>
        <p class="text-xs text-gray-500 mt-1">30-day return policy</p>
      </div>
      <div class="text-center p-6 rounded-2xl bg-gray-50 hover:bg-daraz-50 transition-colors group">
        <div class="w-14 h-14 mx-auto mb-4 rounded-xl bg-daraz-100 flex items-center justify-center group-hover:bg-daraz-500 transition-colors">
          <i class="fas fa-lock text-2xl text-daraz-600 group-hover:text-white transition-colors"></i>
        </div>
        <h4 class="font-semibold text-gray-800 text-sm">Secure Payment</h4>
        <p class="text-xs text-gray-500 mt-1">100% encrypted checkout</p>
      </div>
      <div class="text-center p-6 rounded-2xl bg-gray-50 hover:bg-daraz-50 transition-colors group">
        <div class="w-14 h-14 mx-auto mb-4 rounded-xl bg-daraz-100 flex items-center justify-center group-hover:bg-daraz-500 transition-colors">
          <i class="fas fa-headset text-2xl text-daraz-600 group-hover:text-white transition-colors"></i>
        </div>
        <h4 class="font-semibold text-gray-800 text-sm">24/7 Support</h4>
        <p class="text-xs text-gray-500 mt-1">Dedicated concierge team</p>
      </div>
    </div>
  </div>
</section>

{{-- Flash Countdown Script --}}
@push('scripts')
<script>
  // Countdown timer (2 hours from page load)
  const totalSeconds = 2 * 60 * 60 + 45 * 60 + 30;
  let remaining = totalSeconds;
  
  function updateCountdown() {
    const h = Math.floor(remaining / 3600);
    const m = Math.floor((remaining % 3600) / 60);
    const s = remaining % 60;
    document.getElementById('hours').textContent = String(h).padStart(2, '0');
    document.getElementById('minutes').textContent = String(m).padStart(2, '0');
    document.getElementById('seconds').textContent = String(s).padStart(2, '0');
    if (remaining > 0) remaining--;
  }
  updateCountdown();
  setInterval(updateCountdown, 1000);
</script>
@endpush

@endsection
