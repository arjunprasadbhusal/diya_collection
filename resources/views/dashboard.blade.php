@extends('layouts.app')

@section('title', 'Dashboard Overview')

@section('content')
    {{-- Welcome Card --}}
    <div class="bg-gradient-to-r from-daraz-600 via-daraz-500 to-daraz-700 rounded-2xl p-8 md:p-10 text-white mb-8 relative overflow-hidden">
        <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiLz48L2c+PC9nPjwvc3ZnPg==')"></div>
        <div class="relative z-10">
            <span class="text-daraz-200 text-xs font-bold uppercase tracking-widest">Diya Collection Admin</span>
            <h1 class="text-3xl md:text-4xl font-bold mt-2">Good {{ now()->format('H') < 12 ? 'Morning' : (now()->format('H') < 17 ? 'Afternoon' : 'Evening') }}, {{ Auth::user()->name ?? 'Admin' }}</h1>
            <p class="text-daraz-100 text-sm mt-2">Here's what's happening with your store today.</p>
        </div>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold uppercase tracking-widest text-gray-400">Orders</span>
                <div class="w-10 h-10 bg-daraz-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-daraz-600"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-midnight-900">{{ number_format($orderCount ?? 0) }}</p>
            <p class="text-xs text-gray-400 mt-1">Total orders placed</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold uppercase tracking-widest text-gray-400">Revenue</span>
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-green-600"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-midnight-900">${{ number_format($revenueTotal ?? 0, 2) }}</p>
            <p class="text-xs text-gray-400 mt-1">Total revenue generated</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold uppercase tracking-widest text-gray-400">Products</span>
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-box text-blue-600"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-midnight-900">{{ number_format($productCount ?? 0) }}</p>
            <p class="text-xs text-gray-400 mt-1">Active inventory items</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold uppercase tracking-widest text-gray-400">Categories</span>
                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-tags text-purple-600"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-midnight-900">{{ number_format($categoryCount ?? 0) }}</p>
            <p class="text-xs text-gray-400 mt-1">Curated collections</p>
        </div>
    </div>

    {{-- Recent Orders + Quick Actions --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-sm font-bold uppercase tracking-wider text-gray-500">Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-xs text-daraz-600 hover:text-daraz-700 font-semibold">View All</a>
            </div>
            <div class="space-y-3">
                @forelse($recentOrders ?? [] as $order)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-midnight-900 rounded-xl flex items-center justify-center text-white text-xs font-bold">#{{ $order->id }}</div>
                        <div>
                            <p class="text-sm font-semibold text-midnight-900">{{ $order->first_name }} {{ $order->last_name }}</p>
                            <p class="text-xs text-gray-400">{{ $order->email }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full 
                            {{ $order->status === 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                            {{ $order->status === 'delivery' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $order->status === 'cancel' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}">
                            {{ $order->status }}
                        </span>
                        <p class="text-xs font-bold text-midnight-900 mt-1">${{ number_format($order->total, 2) }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-400 text-sm">No orders yet.</div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <h2 class="text-sm font-bold uppercase tracking-wider text-gray-500 mb-6">Quick Actions</h2>
            <div class="space-y-3">
                <a href="{{ route('admin.product.create') }}" class="flex items-center gap-3 p-4 bg-daraz-50 rounded-xl hover:bg-daraz-100 transition-colors group">
                    <div class="w-10 h-10 bg-daraz-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-midnight-900">Add Product</p>
                        <p class="text-xs text-gray-500">Create a new product</p>
                    </div>
                </a>
                <a href="{{ route('admin.category.create') }}" class="flex items-center gap-3 p-4 bg-green-50 rounded-xl hover:bg-green-100 transition-colors group">
                    <div class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                        <i class="fas fa-folder-plus"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-midnight-900">Add Category</p>
                        <p class="text-xs text-gray-500">Organize your products</p>
                    </div>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition-colors group">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-midnight-900">Manage Orders</p>
                        <p class="text-xs text-gray-500">Review and update orders</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
