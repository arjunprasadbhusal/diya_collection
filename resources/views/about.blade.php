@extends('layouts.master')

@section('title', 'Our Story | Diya Collection')

@section('content')
{{-- Hero --}}
<section class="relative bg-gradient-to-br from-midnight-900 via-midnight-800 to-daraz-900 py-20 md:py-32 overflow-hidden">
  <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiLz48L2c+PC9nPjwvc3ZnPg==')"></div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
    <span class="text-daraz-400 text-sm font-bold uppercase tracking-widest">Our Story</span>
    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mt-4 mb-6">Defining Modern Luxury</h1>
    <p class="text-white/60 text-lg max-w-2xl mx-auto">Crafting timeless pieces that blend heritage craftsmanship with contemporary design since 2024.</p>
  </div>
</section>

{{-- Content --}}
<section class="py-16 md:py-24">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
      <div>
        <span class="text-daraz-600 text-sm font-bold uppercase tracking-widest">Craftsmanship & Heritage</span>
        <h2 class="text-3xl md:text-4xl font-bold text-midnight-900 mt-3 mb-6">Where Elegance Meets<br>Everyday Comfort</h2>
        <div class="space-y-4 text-gray-600 leading-relaxed">
          <p>Diya Collection was born out of a passion for timeless elegance and meticulous craftsmanship. We believe that luxury is not just about a brand name, but about the story behind every stitch, the quality of every fiber, and the feeling of wearing something truly exceptional.</p>
          <p>Our pieces are curated from the finest artisans around the globe, ensuring that each item in our collection meets the highest standards of quality and ethical production.</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn-daraz mt-8">
          Explore Collection <i class="fas fa-arrow-right ml-2"></i>
        </a>
      </div>
      <div class="relative">
        <div class="aspect-[4/5] bg-gradient-to-br from-daraz-100 to-daraz-200 rounded-3xl overflow-hidden shadow-xl">
          <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover mix-blend-multiply">
        </div>
        <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-xl px-6 py-4 hidden md:block">
          <p class="text-3xl font-bold text-daraz-600">500+</p>
          <p class="text-xs text-gray-500">Premium Products</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Values --}}
<section class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <span class="text-daraz-600 text-sm font-bold uppercase tracking-widest">Our Values</span>
      <h2 class="text-3xl md:text-4xl font-bold text-midnight-900 mt-3">What We Stand For</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="card-daraz-hover p-8 text-center">
        <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-daraz-100 flex items-center justify-center">
          <i class="fas fa-clock text-2xl text-daraz-600"></i>
        </div>
        <h3 class="text-lg font-bold text-midnight-900 mb-3">Timeless Design</h3>
        <p class="text-gray-500 text-sm">Aesthetic that transcends seasons and trends. Created to be cherished for years to come.</p>
      </div>
      <div class="card-daraz-hover p-8 text-center">
        <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-daraz-100 flex items-center justify-center">
          <i class="fas fa-hand-holding-heart text-2xl text-daraz-600"></i>
        </div>
        <h3 class="text-lg font-bold text-midnight-900 mb-3">Ethical Spirit</h3>
        <p class="text-gray-500 text-sm">Commitment to transparency, fair wages, and sustainable practices across our supply chain.</p>
      </div>
      <div class="card-daraz-hover p-8 text-center">
        <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-daraz-100 flex items-center justify-center">
          <i class="fas fa-gem text-2xl text-daraz-600"></i>
        </div>
        <h3 class="text-lg font-bold text-midnight-900 mb-3">Pure Quality</h3>
        <p class="text-gray-500 text-sm">Only the finest materials and craftsmanship make it into our collections. No compromises.</p>
      </div>
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-white">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-midnight-900 mb-4">Ready to Elevate Your Style?</h2>
    <p class="text-gray-500 text-lg mb-8 max-w-xl mx-auto">Browse our curated collection and discover pieces that speak to your unique sense of style.</p>
    <a href="{{ route('products.index') }}" class="btn-daraz px-10 py-4 text-base">
      Shop Now <i class="fas fa-arrow-right ml-2"></i>
    </a>
  </div>
</section>
@endsection
