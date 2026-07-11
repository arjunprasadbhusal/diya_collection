@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
    <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8 shadow-sm">
        <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-daraz-600">Administration</span>
                <h1 class="text-2xl md:text-3xl font-bold text-midnight-900 mt-1">Orders</h1>
            </div>
        </div>

        <div class="overflow-x-auto" x-data="{ expanded: null }">
            <table class="w-full">
                <thead>
                    <tr class="text-xs font-bold uppercase tracking-widest text-gray-400 border-b border-gray-100">
                        <th class="text-left pb-4 pl-4">Order</th>
                        <th class="text-left pb-4">Customer</th>
                        <th class="text-center pb-4 hidden md:table-cell">Items</th>
                        <th class="text-center pb-4">Total</th>
                        <th class="text-center pb-4 hidden sm:table-cell">Payment</th>
                        <th class="text-right pb-4 pr-4">Status / Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders ?? [] as $order)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                        <td class="py-4 pl-4">
                            <span class="text-sm font-bold text-midnight-900">#{{ $order->id }}</span>
                        </td>
                        <td class="py-4">
                            <p class="text-sm font-semibold text-midnight-900">{{ $order->first_name }} {{ $order->last_name }}</p>
                            <p class="text-xs text-gray-400">{{ $order->email }}</p>
                        </td>
                        <td class="py-4 text-center hidden md:table-cell">
                            <button @click="expanded = expanded === {{ $order->id }} ? null : {{ $order->id }}" 
                                    class="text-sm font-medium text-daraz-600 hover:text-daraz-700 underline underline-offset-2">
                                {{ $order->items_count }} item(s)
                            </button>
                        </td>
                        <td class="py-4 text-center text-sm font-bold text-daraz-600">Rs. {{ number_format($order->total, 2) }}</td>
                        <td class="py-4 text-center hidden sm:table-cell">
                            <span class="text-xs font-medium text-gray-600 bg-gray-100 px-3 py-1.5 rounded-lg uppercase">{{ $order->payment_method }}</span>
                        </td>
                        <td class="py-4 pr-4 text-right">
                            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="flex flex-col items-end gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" 
                                        class="text-xs font-bold uppercase tracking-wider border border-gray-200 rounded-lg px-3 py-1.5 bg-white focus:ring-2 focus:ring-daraz-500/20 focus:border-daraz-500 outline-none">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }} class="text-amber-600">Pending</option>
                                    <option value="delivery" {{ $order->status === 'delivery' ? 'selected' : '' }} class="text-blue-600">Delivery</option>
                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }} class="text-green-600">Completed</option>
                                    <option value="cancel" {{ $order->status === 'cancel' ? 'selected' : '' }} class="text-red-600">Cancel</option>
                                </select>
                                <span class="text-[10px] text-gray-400">{{ $order->created_at?->format('M d, Y') }}</span>
                            </form>
                        </td>
                    </tr>
                    <tr x-show="expanded === {{ $order->id }}" x-cloak>
                        <td colspan="6" class="bg-gray-50 px-4 pb-4">
                            <div class="space-y-2">
                                @php $items = is_array($order->items) ? $order->items : (json_decode($order->items, true) ?? []); @endphp
                                @foreach($items as $item)
                                <div class="flex items-center gap-3 p-3 bg-white rounded-xl">
                                    <div class="w-12 h-14 bg-gray-100 rounded-lg overflow-hidden shrink-0">
                                        @php
                                            $img = $item['image'] ?? null;
                                            if ($img && !\Str::startsWith($img, ['http://', 'https://'])) {
                                                $img = \Illuminate\Support\Facades\Storage::disk('public')->exists($img)
                                                    ? \Illuminate\Support\Facades\Storage::url($img)
                                                    : asset($img);
                                            }
                                        @endphp
                                        @if($img)
                                            <img src="{{ $img }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-midnight-900 truncate">{{ $item['name'] ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-400">Qty: {{ $item['quantity'] ?? 0 }} × Rs. {{ number_format($item['price'] ?? 0, 2) }}</p>
                                        @if(!empty($item['size']))
                                            <span class="inline-block mt-1 px-2 py-0.5 bg-midnight-900 text-white text-[9px] font-semibold rounded">Size: {{ $item['size'] }}</span>
                                        @endif
                                    </div>
                                    <span class="text-sm font-bold text-daraz-600">Rs. {{ number_format(($item['quantity'] ?? 0) * ($item['price'] ?? 0), 2) }}</span>
                                </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-16 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-truck text-2xl text-gray-300"></i>
                            </div>
                            <p class="text-gray-400 text-sm">No orders yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
