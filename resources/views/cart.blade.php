@extends('layouts.master')

@section('title', 'Shopping Cart | Diya Collection')

@section('content')
    @php
        $cartCount = collect($cartItems ?? [])->sum('quantity');
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-midnight-900">Shopping Cart</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $cartCount }} item(s) in your bag</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-daraz-600 hover:text-daraz-700 font-medium text-sm flex items-center gap-2">
                <i class="fas fa-arrow-left text-xs"></i> Continue Shopping
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Cart Items --}}
            <div class="lg:col-span-2 space-y-4">
                @forelse($cartItems ?? [] as $item)
                <div class="card-daraz p-4 md:p-6 flex flex-col sm:flex-row gap-4 animate-fade-in">
                    <div class="w-full sm:w-24 h-24 bg-gray-100 rounded-xl overflow-hidden shrink-0">
                        @if($item->product->image)
                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-300 font-bold uppercase">No Image</div>
                        @endif
                    </div>
                    <div class="flex-1 flex flex-col sm:flex-row justify-between gap-3">
                        <div class="flex-1">
                            <h3 class="text-sm font-semibold text-midnight-900">{{ $item->product->name }}</h3>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $item->product->category->name ?? 'Uncategorized' }}</p>
                            @if($item->size ?? false)
                                <span class="inline-block mt-2 px-2.5 py-0.5 bg-midnight-900 text-white text-[10px] font-semibold rounded-md">Size: {{ $item->size }}</span>
                            @endif
                            <p class="text-base font-bold text-daraz-600 mt-2">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                            @if($item->quantity > 1)
                                <p class="text-[10px] text-gray-400">${{ number_format($item->product->price, 2) }} each</p>
                            @endif
                        </div>
                        <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-between gap-3">
                            {{-- Quantity Controls --}}
                            <form action="{{ route('cart.update', Auth::check() ? $item->id : $item->cart_key) }}" method="POST" class="flex border-2 border-gray-200 rounded-xl overflow-hidden">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}" 
                                        class="px-3 py-1.5 text-sm hover:bg-gray-100 transition-colors text-gray-600 font-medium {{ $item->quantity <= 1 ? 'opacity-30 cursor-not-allowed' : '' }}" 
                                        {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                <span class="px-4 py-1.5 text-xs font-semibold border-x-2 border-gray-200 text-midnight-900 min-w-[32px] text-center">{{ $item->quantity }}</span>
                                <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}" class="px-3 py-1.5 text-sm hover:bg-gray-100 transition-colors text-gray-600 font-medium">+</button>
                            </form>
                            {{-- Remove --}}
                            <form action="{{ route('cart.remove', Auth::check() ? $item->id : $item->cart_key) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[10px] font-medium text-red-400 hover:text-red-600 transition-colors flex items-center gap-1">
                                    <i class="far fa-trash-alt"></i> Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-20 card-daraz">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gray-100 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-shopping-bag text-3xl text-gray-300"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Your cart is empty</h3>
                    <p class="text-gray-400 text-sm mb-6">Looks like you haven't added anything yet.</p>
                    <a href="{{ route('products.index') }}" class="btn-daraz inline-flex">
                        <i class="fas fa-store mr-2"></i> Start Shopping
                    </a>
                </div>
                @endforelse
            </div>

            {{-- Order Summary --}}
            @if(count($cartItems ?? []) > 0)
            <div class="lg:col-span-1">
                <div class="card-daraz p-6 sticky top-28">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-midnight-900 mb-6 pb-4 border-b border-gray-100">
                        Order Summary
                    </h2>
                    
                    @php
                        $subtotal = collect($cartItems)->sum(function($item) {
                            return $item->product->price * $item->quantity;
                        });
                        $tax = $subtotal * 0.08;
                        $total = $subtotal + $tax;
                        $shipping = $subtotal >= 100 ? 0 : 15;
                        $grandTotal = $total + $shipping;
                    @endphp

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Subtotal</span>
                            <span class="font-semibold text-midnight-900">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Shipping</span>
                            @if($shipping == 0)
                                <span class="text-green-600 font-semibold text-xs">FREE</span>
                            @else
                                <span class="font-semibold text-midnight-900">${{ number_format($shipping, 2) }}</span>
                            @endif
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Tax (8%)</span>
                            <span class="font-semibold text-midnight-900">${{ number_format($tax, 2) }}</span>
                        </div>
                        @if($subtotal < 100)
                        <div class="bg-daraz-50 p-3 rounded-xl text-center">
                            <p class="text-xs text-daraz-700 font-medium">
                                <i class="fas fa-truck mr-1"></i> Add ${{ number_format(100 - $subtotal, 2) }} more for free shipping
                            </p>
                            <div class="mt-2 bg-daraz-200 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-daraz-500 h-full rounded-full" style="width: {{ min(100, ($subtotal / 100) * 100) }}%"></div>
                            </div>
                        </div>
                        @endif
                        <div class="border-t border-gray-100 pt-4">
                            <div class="flex justify-between">
                                <span class="text-base font-bold text-midnight-900">Total</span>
                                <span class="text-xl font-bold text-daraz-600">${{ number_format($grandTotal, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('checkout') }}" class="btn-daraz w-full py-4 text-sm shadow-lg shadow-daraz-500/30">
                        <i class="fas fa-lock mr-2 text-xs"></i> Proceed to Checkout
                    </a>

                    <div class="mt-4 flex items-center justify-center gap-4 text-gray-300">
                        <i class="fab fa-cc-visa text-xl hover:text-gray-400 transition-colors"></i>
                        <i class="fab fa-cc-mastercard text-xl hover:text-gray-400 transition-colors"></i>
                        <i class="fab fa-cc-amex text-xl hover:text-gray-400 transition-colors"></i>
                        <i class="fab fa-cc-paypal text-xl hover:text-gray-400 transition-colors"></i>
                    </div>
                    <p class="text-center text-[10px] text-gray-400 mt-3">
                        <i class="fas fa-lock mr-1 text-daraz-500"></i> 100% Secure & Encrypted Checkout
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
