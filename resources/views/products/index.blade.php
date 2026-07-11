@extends('layouts.master')

@section('title', 'Shop Collection | Diya Collection')

@section('content')

{{-- Page Header --}}
<div class="bg-gradient-to-r from-daraz-600 via-daraz-500 to-daraz-700 py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">The Collection</h1>
    <p class="text-daraz-100 text-sm md:text-base max-w-xl mx-auto">
      Discover our curated selection of premium fashion pieces
    </p>
  </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

  {{-- Filter Bar --}}
  <div class="card-daraz p-4 mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="flex flex-wrap items-center gap-2">
      <a href="{{ route('products.index', request()->only(['sort'])) }}" 
         class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all duration-200
                {{ !request()->has('category') ? 'bg-daraz-500 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
        All
      </a>
      @foreach($categories as $cat)
        <a href="{{ route('products.index', array_merge(request()->only(['sort']), ['category' => $cat->slug])) }}"
           class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all duration-200
                  {{ request('category') === $cat->slug ? 'bg-daraz-500 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
          {{ $cat->name }}
        </a>
      @endforeach
    </div>
    <div class="flex items-center gap-3 w-full sm:w-auto">
      <span class="text-xs text-gray-500 font-medium whitespace-nowrap">{{ $products->total() ?? 0 }} Products</span>
      <select onchange="location = this.value;" 
              class="bg-gray-50 border border-gray-200 text-sm rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-daraz-500/20 focus:border-daraz-500 outline-none">
        <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort') === 'newest' || !request()->has('sort') ? 'selected' : '' }}>Newest</option>
        <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
        <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
      </select>
    </div>
  </div>

  {{-- Product Grid --}}
  @if($products->isEmpty())
    <div class="text-center py-24">
      <div class="w-20 h-20 mx-auto mb-6 bg-gray-100 rounded-2xl flex items-center justify-center">
        <i class="fas fa-box-open text-3xl text-gray-300"></i>
      </div>
      <h3 class="text-xl font-semibold text-gray-700 mb-2">No products found</h3>
      <p class="text-gray-400 text-sm mb-6">Try adjusting your filters or check back later.</p>
      <a href="{{ route('products.index') }}" class="btn-daraz">Clear Filters</a>
    </div>
  @else
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-5">
      @foreach($products as $product)
        <div class="group card-daraz-hover overflow-hidden animate-fade-in">
          <a href="{{ route('products.show', $product->id) }}" class="block">
            <div class="relative aspect-[3/4] bg-gray-100 overflow-hidden">
              @if($product->image)
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
              @else
                <div class="w-full h-full flex items-center justify-center text-gray-300 text-xs">No Image</div>
              @endif
              @if($loop->index < 3)
                <div class="absolute top-2 left-2 badge-new text-[9px]">New</div>
              @endif
            </div>
          </a>
          <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-midnight-900 text-white py-2.5 text-[10px] font-bold uppercase tracking-wider hover:bg-daraz-600 transition-colors">
              <i class="fas fa-shopping-bag mr-1.5"></i> Add to Cart
            </button>
          </form>
          <div class="p-3">
            <span class="text-[9px] font-semibold uppercase tracking-widest text-daraz-600">{{ $product->category->name ?? 'Fashion' }}</span>
            <a href="{{ route('products.show', $product->id) }}">
              <h4 class="text-xs font-semibold text-gray-800 mt-0.5 line-clamp-2 hover:text-daraz-600 transition-colors leading-snug">{{ $product->name }}</h4>
            </a>
            <div class="flex items-center gap-1 mt-1.5">
              @for($i = 1; $i <= 5; $i++)
                <i class="fas fa-star text-[8px] {{ $i <= 4 ? 'text-amber-400' : 'text-gray-200' }}"></i>
              @endfor
            </div>
            <div class="flex items-center gap-1.5 mt-1.5">
              <span class="text-sm font-bold text-daraz-600">Rs. {{ number_format($product->price, 2) }}</span>
              @if($loop->index % 3 == 0)
                <span class="text-[10px] line-through text-gray-400">Rs. {{ number_format($product->price * 1.25, 2) }}</span>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-12 flex justify-center">
      {{ $products->appends(request()->query())->links('pagination::tailwind') }}
    </div>
  @endif
</div>

{{-- Custom Pagination Styles --}}
@push('styles')
<style>
  nav[role="navigation"] .relative.inline-flex items-center {
    @apply rounded-lg border border-gray-200 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors;
  }
  nav[role="navigation"] .relative.inline-flex.items-center.bg-white {
    @apply border-daraz-500 bg-daraz-50 text-daraz-600;
  }
</style>
@endpush

@endsection
