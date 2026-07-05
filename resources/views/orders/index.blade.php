@extends('layouts.master')

@section('title', 'My Orders | Diya Collection')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-midnight-900">My Orders</h1>
                <p class="text-sm text-gray-500 mt-1">View and manage your orders</p>
            </div>
            <a href="{{ route('products.index') }}" class="btn-daraz-outline text-sm px-5 py-2.5">
                <i class="fas fa-store mr-2"></i> Continue Shopping
            </a>
        </div>

        @forelse($orders as $order)
            <div class="card-daraz p-6 mb-4 animate-fade-in">
                <div class="flex items-start justify-between mb-4 pb-4 border-b border-gray-100">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-gray-400">Order #{{ $order->id }}</span>
                        <p class="text-xs text-gray-400 mt-0.5">Placed on {{ $order->created_at?->format('M d, Y \a\t h:i A') }}</p>
                    </div>
                    <div class="text-right">
                        <span class="text-lg font-bold text-daraz-600">${{ number_format($order->total, 2) }}</span>
                        <p class="text-[10px] text-gray-400">{{ $order->items_count }} item(s)</p>
                    </div>
                </div>

                <div class="space-y-3">
                    @php $items = is_array($order->items) ? $order->items : (json_decode($order->items, true) ?? []); @endphp
                    @foreach($items as $item)
                        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                            <div class="w-16 h-20 bg-gray-200 rounded-lg overflow-hidden shrink-0">
                                @php
                                    $img = $item['image'] ?? null;
                                    if ($img && !\Str::startsWith($img, ['http://', 'https://'])) {
                                        $img = asset($img);
                                    }
                                @endphp
                                @if($img)
                                    <img src="{{ $img }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300 text-[10px]">N/A</div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-semibold text-midnight-900 truncate">{{ $item['name'] ?? 'N/A' }}</h4>
                                <p class="text-xs text-gray-400">Qty: {{ $item['quantity'] ?? 0 }} × ${{ number_format($item['price'] ?? 0, 2) }}</p>
                                @if(!empty($item['size']))
                                    <span class="inline-block mt-1 px-2 py-0.5 bg-midnight-900 text-white text-[9px] font-semibold rounded">Size: {{ $item['size'] }}</span>
                                @endif
                            </div>
                            <span class="text-sm font-bold text-midnight-900">${{ number_format(($item['quantity'] ?? 0) * ($item['price'] ?? 0), 2) }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                    <div>
                        @php
                            $statusColors = [
                                'pending' => 'bg-amber-100 text-amber-700',
                                'delivery' => 'bg-blue-100 text-blue-700',
                                'completed' => 'bg-green-100 text-green-700',
                                'cancel' => 'bg-red-100 text-red-700',
                            ];
                            $statusLabel = $order->status ?? 'pending';
                        @endphp
                        <span class="inline-block px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider {{ $statusColors[$statusLabel] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ $statusLabel }}
                        </span>
                    </div>
                    <div class="flex items-center gap-3">
                        @if($order->status === 'pending')
                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-xs font-medium text-red-500 hover:text-red-700 underline underline-offset-2">
                                    <i class="fas fa-times-circle mr-1"></i> Cancel
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="card-daraz p-16 text-center">
                <div class="w-20 h-20 mx-auto mb-6 bg-gray-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-truck text-3xl text-gray-300"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">No orders yet</h3>
                <p class="text-gray-400 text-sm mb-6">Looks like you haven't placed any orders yet.</p>
                <a href="{{ route('products.index') }}" class="btn-daraz inline-flex">
                    <i class="fas fa-store mr-2"></i> Start Shopping
                </a>
            </div>
        @endforelse

        @if($orders->hasPages())
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
