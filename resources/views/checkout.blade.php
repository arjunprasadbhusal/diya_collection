@extends('layouts.master')

@section('title', 'Checkout | Diya Collection')

@section('content')
    @php
        $user = auth()->user();
        $name = $user?->name ?? '';
        $nameParts = $name ? preg_split('/\s+/', trim($name), 2) : ['', ''];
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

        $subtotal = collect($cartItems)->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $tax = $subtotal * 0.08;
        $total = $subtotal + $tax;
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('cart.index') }}" class="w-10 h-10 flex items-center justify-center rounded-xl hover:bg-gray-100 transition-colors text-gray-400">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-midnight-900">Checkout</h1>
                <p class="text-sm text-gray-500">Complete your order</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            {{-- Checkout Form --}}
            <div class="lg:col-span-3">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                    <div class="space-y-8">
                        {{-- Contact --}}
                        <div class="card-daraz p-6">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="w-8 h-8 bg-daraz-500 text-white rounded-lg flex items-center justify-center text-sm font-bold">1</span>
                                <h2 class="text-base font-bold text-midnight-900">Contact Information</h2>
                            </div>
                            <div class="space-y-4">
                                <input type="email" name="email" placeholder="Email Address" 
                                       value="{{ old('email', $user?->email ?? '') }}"
                                       class="input-daraz @error('email') border-red-500 @enderror">
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                <label class="flex items-center gap-2 text-sm text-gray-500 cursor-pointer">
                                    <input type="checkbox" class="rounded border-gray-300 text-daraz-500 focus:ring-daraz-500">
                                    Keep me updated on new collections & offers
                                </label>
                            </div>
                        </div>

                        {{-- Shipping --}}
                        <div class="card-daraz p-6">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="w-8 h-8 bg-daraz-500 text-white rounded-lg flex items-center justify-center text-sm font-bold">2</span>
                                <h2 class="text-base font-bold text-midnight-900">Shipping Address</h2>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name', $firstName) }}" class="input-daraz @error('first_name') border-red-500 @enderror">
                                <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name', $lastName) }}" class="input-daraz @error('last_name') border-red-500 @enderror">
                                <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" class="col-span-2 input-daraz @error('phone') border-red-500 @enderror">
                                <input type="text" name="shipping_address_1" placeholder="Street Address" value="{{ old('shipping_address_1') }}" class="col-span-2 input-daraz @error('shipping_address_1') border-red-500 @enderror">
                                <input type="text" name="shipping_address_2" placeholder="Apartment, Suite, etc. (optional)" value="{{ old('shipping_address_2') }}" class="col-span-2 input-daraz">
                                <input type="text" name="shipping_city" placeholder="City" value="{{ old('shipping_city') }}" class="input-daraz @error('shipping_city') border-red-500 @enderror">
                                <input type="text" name="shipping_postal_code" placeholder="Postal Code" value="{{ old('shipping_postal_code') }}" class="input-daraz @error('shipping_postal_code') border-red-500 @enderror">
                            </div>
                        </div>

                        {{-- Payment --}}
                        <div class="card-daraz p-6">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="w-8 h-8 bg-daraz-500 text-white rounded-lg flex items-center justify-center text-sm font-bold">3</span>
                                <h2 class="text-base font-bold text-midnight-900">Payment Method</h2>
                            </div>
                            <label class="flex items-center gap-4 p-4 border-2 border-daraz-500 bg-daraz-50 rounded-xl cursor-pointer">
                                <input type="radio" name="payment_method" value="cod" checked class="w-5 h-5 text-daraz-500 focus:ring-daraz-500">
                                <div>
                                    <span class="font-semibold text-midnight-900">Cash on Delivery</span>
                                    <p class="text-xs text-gray-500">Pay when your order arrives at your doorstep</p>
                                </div>
                                <i class="fas fa-money-bill-wave text-2xl text-daraz-500 ml-auto"></i>
                            </label>
                        </div>

                        <button type="submit" class="btn-daraz w-full py-5 text-base shadow-lg shadow-daraz-500/30 {{ count($cartItems) > 0 ? '' : 'opacity-50 cursor-not-allowed' }}" 
                                {{ count($cartItems) > 0 ? '' : 'disabled' }}>
                            <i class="fas fa-lock mr-2"></i> Place Order — Rs. {{ number_format($total, 2) }}
                        </button>
                    </div>
                </form>
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-2">
                <div class="card-daraz p-6 sticky top-28">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-midnight-900 mb-6 pb-4 border-b border-gray-100">
                        Your Order
                    </h2>

                    <div class="space-y-4 mb-6">
                        @forelse($cartItems as $item)
                        <div class="flex items-center gap-3">
                            <div class="relative w-16 h-20 bg-gray-100 rounded-xl overflow-hidden shrink-0">
                                @if($item->product->image)
                                    <img src="{{ $item->product->image_url }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-300">N/A</div>
                                @endif
                                <span class="absolute -top-1.5 -right-1.5 bg-daraz-500 text-white text-[9px] w-5 h-5 flex items-center justify-center rounded-full font-bold">{{ $item->quantity }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-xs font-semibold text-midnight-900 truncate">{{ $item->product->name }}</h4>
                                <p class="text-[10px] text-gray-400">{{ $item->product->category->name ?? 'Fashion' }}</p>
                                @if($item->size ?? false)
                                    <span class="inline-block mt-1 px-2 py-0.5 bg-gray-100 text-gray-600 text-[9px] font-semibold rounded">Size: {{ $item->size }}</span>
                                @endif
                            </div>
                            <span class="text-xs font-bold text-midnight-900 whitespace-nowrap">Rs. {{ number_format($item->product->price * $item->quantity, 2) }}</span>
                        </div>
                        @empty
                        <div class="text-center py-8 text-gray-400 text-sm">Your cart is empty.</div>
                        @endforelse
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Subtotal</span>
                            <span class="font-semibold">Rs. {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Shipping</span>
                            <span class="text-green-600 font-semibold text-xs">FREE</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Tax (8%)</span>
                            <span class="font-semibold">Rs. {{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="border-t border-gray-100 pt-3 flex justify-between">
                            <span class="text-base font-bold text-midnight-900">Total</span>
                            <span class="text-xl font-bold text-daraz-600">Rs. {{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-gray-50 rounded-xl">
                        <div class="flex items-center gap-3 text-sm text-gray-600 mb-2">
                            <i class="fas fa-truck text-daraz-500"></i>
                            <span>Free shipping on orders over Rs. 100</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-600 mb-2">
                            <i class="fas fa-undo text-daraz-500"></i>
                            <span>30-day easy returns</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <i class="fas fa-lock text-daraz-500"></i>
                            <span>Secure SSL encrypted checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
