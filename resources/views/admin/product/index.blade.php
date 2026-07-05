@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')
    <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8 shadow-sm">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 pb-6 border-b border-gray-100">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-daraz-600">Administration</span>
                <h1 class="text-2xl md:text-3xl font-bold text-midnight-900 mt-1">Products</h1>
            </div>
            <a href="{{ route('admin.product.create') }}" class="btn-daraz text-xs">
                <i class="fas fa-plus mr-2"></i> Add Product
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 text-sm font-medium rounded-xl flex items-center gap-3">
                <i class="fas fa-check-circle text-green-500"></i> {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-xs font-bold uppercase tracking-widest text-gray-400 border-b border-gray-100">
                        <th class="text-left pb-4 pl-4">Image</th>
                        <th class="text-left pb-4">Product</th>
                        <th class="text-left pb-4 hidden md:table-cell">Category</th>
                        <th class="text-center pb-4">Price</th>
                        <th class="text-center pb-4 hidden sm:table-cell">Stock</th>
                        <th class="text-right pb-4 pr-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                        <td class="py-4 pl-4">
                            <div class="w-12 h-12 bg-gray-100 rounded-xl overflow-hidden">
                                @if($product->image)
                                    <img src="{{ $product->image_url }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300 text-[10px]">—</div>
                                @endif
                            </div>
                        </td>
                        <td class="py-4">
                            <h3 class="text-sm font-semibold text-midnight-900">{{ $product->name }}</h3>
                            <p class="text-xs text-gray-400">{{ $product->slug }}</p>
                        </td>
                        <td class="py-4 hidden md:table-cell">
                            <span class="text-xs font-medium text-gray-600 bg-gray-100 px-3 py-1.5 rounded-lg">{{ $product->category->name }}</span>
                        </td>
                        <td class="py-4 text-center text-sm font-bold text-daraz-600">${{ number_format($product->price, 2) }}</td>
                        <td class="py-4 text-center hidden sm:table-cell">
                            <span class="text-xs font-semibold px-3 py-1.5 rounded-lg {{ $product->stock < 10 ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="py-4 pr-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="px-4 py-2 text-xs font-semibold text-daraz-600 bg-daraz-50 rounded-lg hover:bg-daraz-100 transition-colors">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-4 py-2 text-xs font-semibold text-red-500 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-16 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-box-open text-2xl text-gray-300"></i>
                            </div>
                            <p class="text-gray-400 text-sm">No products yet. Add your first product!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
