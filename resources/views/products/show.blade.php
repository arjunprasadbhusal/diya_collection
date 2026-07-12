@extends('layouts.master')

@section('title', $product->name . ' | Diya Collection')

@section('content')

{{-- Breadcrumbs --}}
<div class="bg-white border-b border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
    <nav class="flex items-center gap-2 text-xs text-gray-400">
      <a href="/" class="hover:text-daraz-600 transition-colors">Home</a>
      <i class="fas fa-chevron-right text-[8px]"></i>
      <a href="{{ route('products.index') }}" class="hover:text-daraz-600 transition-colors">Shop</a>
      <i class="fas fa-chevron-right text-[8px]"></i>
      <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-daraz-600 transition-colors">{{ $product->category->name }}</a>
      <i class="fas fa-chevron-right text-[8px]"></i>
      <span class="text-gray-600 font-medium truncate max-w-[200px]">{{ $product->name }}</span>
    </nav>
  </div>
</div>

{{-- Product Detail --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
    {{-- Image Gallery --}}
    <div class="lg:col-span-5">
      <div class="relative bg-gray-50 rounded-2xl overflow-hidden shadow-sm group">
        @if($product->image)
          <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full aspect-[3/4] object-cover group-hover:scale-105 transition-transform duration-700">
        @else
          <div class="w-full aspect-[3/4] flex items-center justify-center bg-gray-100 text-gray-300 text-sm">No Image Available</div>
        @endif
        @if($product->is_new ?? false)
          <div class="absolute top-4 left-4 badge-new">New Arrival</div>
        @endif
        @if($product->stock > 0 && $product->stock < 10)
          <div class="absolute top-4 right-4 bg-red-500 text-white text-[10px] font-bold px-3 py-1.5 rounded-lg">
            Only {{ $product->stock }} left
          </div>
        @endif
      </div>
    </div>

    {{-- Product Info --}}
    <div class="lg:col-span-7 flex flex-col">
      <span class="text-xs font-semibold uppercase tracking-widest text-daraz-600 mb-2">{{ $product->category->name }}</span>
      
      <h1 class="text-2xl md:text-3xl font-bold text-midnight-900 mb-3">{{ $product->name }}</h1>
      
      {{-- Rating --}}
      <div class="flex items-center gap-3 mb-4">
        <div class="flex items-center gap-1">
          @for($i = 1; $i <= 5; $i++)
            <i class="fas fa-star {{ $i <= 4 ? 'text-amber-400' : 'text-gray-200' }} text-sm"></i>
          @endfor
        </div>
        <span class="text-sm text-gray-500">({{ rand(20, 150) }} reviews)</span>
        <span class="text-sm text-gray-300">|</span>
        <span class="text-sm text-green-600 font-medium"><i class="fas fa-check-circle mr-1"></i> Verified</span>
      </div>

      {{-- Price --}}
      <div class="flex items-baseline gap-3 mb-6">
        <span class="text-3xl font-bold text-daraz-600">Rs. {{ number_format($product->price, 2) }}</span>
        <span class="text-lg line-through text-gray-400">Rs. {{ number_format($product->price * 1.25, 2) }}</span>
        <span class="badge-sale text-xs">-20%</span>
      </div>

      {{-- Stock Status --}}
      <div class="mb-6">
        @if($product->stock > 5)
          <div class="flex items-center gap-2 text-sm text-green-600">
            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
            <span class="font-medium">In Stock</span>
            <span class="text-gray-400">({{ $product->stock }} available)</span>
          </div>
        @elseif($product->stock > 0)
          <div class="flex items-center gap-2 text-sm text-amber-600">
            <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
            <span class="font-medium">Low Stock</span>
            <span class="text-gray-400">(Only {{ $product->stock }} left)</span>
          </div>
        @else
          <div class="flex items-center gap-2 text-sm text-red-600">
            <span class="w-2 h-2 bg-red-500 rounded-full"></span>
            <span class="font-medium">Out of Stock</span>
          </div>
        @endif
      </div>

      {{-- Description --}}
      <div class="text-gray-600 text-sm leading-relaxed mb-8 p-5 bg-gray-50 rounded-xl">
        <p>{{ $product->description ?? 'Premium quality piece crafted with attention to detail. Perfect for those who appreciate timeless elegance and modern comfort.' }}</p>
      </div>

      {{-- Add to Cart Form --}}
      @if($product->stock > 0)
        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-6">
          @csrf
          
          {{-- Quantity Selector --}}
          <div class="flex items-center gap-4">
            <span class="text-sm font-semibold text-gray-700">Quantity:</span>
            <div class="flex border-2 border-gray-200 rounded-xl overflow-hidden" x-data="{ qty: 1 }">
              <button type="button" @click="if(qty > 1) qty--" class="px-4 py-2 hover:bg-gray-100 transition-colors text-gray-600 font-medium">-</button>
              <input type="number" name="quantity" :value="qty" min="1" max="{{ $product->stock }}" 
                     class="w-14 text-center border-0 text-sm font-semibold focus:outline-none focus:ring-0 p-0 bg-transparent text-midnight-900" readonly>
              <button type="button" @click="if(qty < {{ $product->stock }}) qty++" class="px-4 py-2 hover:bg-gray-100 transition-colors text-gray-600 font-medium">+</button>
            </div>
          </div>

          {{-- Size Selector --}}
          <div class="border-t border-gray-100 pt-6" x-data="{ selectedSize: '' }">
            <span class="text-sm font-semibold text-gray-700 block mb-3">Size:</span>
            <div class="flex flex-wrap gap-2">
              <template x-for="size in ['S', 'M', 'L', 'XL', 'XXL']" :key="size">
                <button type="button" @click="selectedSize = size"
                        :class="selectedSize === size ? 'bg-midnight-900 text-white border-midnight-900 shadow-md' : 'bg-white text-gray-700 border-gray-200 hover:border-midnight-900 hover:text-midnight-900'"
                        class="w-12 h-12 rounded-xl border-2 font-semibold text-sm transition-all duration-200">
                  <span x-text="size"></span>
                </button>
              </template>
              <input type="hidden" name="size" x-model="selectedSize">
            </div>
            <p class="text-xs mt-2" x-text="selectedSize ? 'Selected: ' + selectedSize : 'Please select a size'"
               :class="selectedSize ? 'text-green-600 font-medium' : 'text-gray-400'"></p>
          </div>

          {{-- Action Buttons --}}
          <div class="flex flex-col sm:flex-row gap-3">
            <button type="submit" class="btn-daraz flex-1 py-4 text-base shadow-lg shadow-daraz-500/30">
              <i class="fas fa-shopping-bag mr-2"></i> Add to Cart
            </button>

          </div>
        </form>
      @else
        <div class="space-y-4">
          <button disabled class="w-full bg-gray-200 text-gray-400 py-4 text-base font-semibold rounded-xl cursor-not-allowed">
            Out of Stock
          </button>
          <p class="text-xs text-gray-400 text-center">Notify me when this product is back in stock</p>
        </div>
      @endif

      {{-- Trust Badges --}}
      <div class="mt-8 pt-6 border-t border-gray-100">
        <div class="grid grid-cols-3 gap-4 text-center">
          <div class="p-3 rounded-xl bg-gray-50">
            <i class="fas fa-truck text-daraz-500 text-lg mb-1 block"></i>
            <span class="text-[10px] font-medium text-gray-600">Free Shipping Rs. 100+</span>
          </div>
          <div class="p-3 rounded-xl bg-gray-50">
            <i class="fas fa-undo text-daraz-500 text-lg mb-1 block"></i>
            <span class="text-[10px] font-medium text-gray-600">30-Day Returns</span>
          </div>
          <div class="p-3 rounded-xl bg-gray-50">
            <i class="fas fa-shield-alt text-daraz-500 text-lg mb-1 block"></i>
            <span class="text-[10px] font-medium text-gray-600">Secure Checkout</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Related Products --}}
@if(!$relatedProducts->isEmpty())
<section class="bg-gray-50 py-12 mt-8">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
      <div>
        <h2 class="section-title">You May Also Like</h2>
        <p class="section-subtitle">Complete your look with these picks</p>
      </div>
      <a href="{{ route('products.index') }}" class="text-daraz-600 hover:text-daraz-700 font-medium text-sm">View All</a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
      @foreach($relatedProducts as $related)
        <div class="group card-daraz-hover overflow-hidden">
          <a href="{{ route('products.show', $related->id) }}" class="block">
            <div class="relative aspect-[3/4] bg-gray-100 overflow-hidden">
              @if($related->image)
                <img src="{{ $related->image_url }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
              @else
                <div class="w-full h-full flex items-center justify-center text-gray-300 text-xs">No Image</div>
              @endif
            </div>
          </a>
          <form action="{{ route('cart.add', $related->id) }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-midnight-900 text-white py-2 text-[10px] font-bold uppercase tracking-wider hover:bg-daraz-600 transition-colors">
              <i class="fas fa-shopping-bag mr-1.5"></i> Add to Cart
            </button>
          </form>
          <div class="p-3">
            <span class="text-[9px] font-semibold uppercase tracking-widest text-daraz-600">{{ $related->category->name }}</span>
            <a href="{{ route('products.show', $related->id) }}">
              <h4 class="text-xs font-semibold text-gray-800 mt-0.5 line-clamp-2 hover:text-daraz-600 transition-colors">{{ $related->name }}</h4>
            </a>
            <span class="text-sm font-bold text-daraz-600 mt-1 block">Rs. {{ number_format($related->price, 2) }}</span>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

@endsection
