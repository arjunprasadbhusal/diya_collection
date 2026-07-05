@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')
    <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8 shadow-sm" x-data="{ deleteTarget: null }">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 pb-6 border-b border-gray-100">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-daraz-600">Administration</span>
                <h1 class="text-2xl md:text-3xl font-bold text-midnight-900 mt-1">Products</h1>
            </div>
            <a href="{{ route('admin.product.create') }}" class="btn-daraz text-xs">
                <i class="fas fa-plus mr-2"></i> Add Product
            </a>
        </div>

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
                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors"
                        x-data="{ editing: false, name: '{{ $product->name }}', price: '{{ $product->price }}', stock: '{{ $product->stock }}', category_id: '{{ $product->category_id }}' }">
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
                            <template x-if="!editing">
                                <div>
                                    <h3 class="text-sm font-semibold text-midnight-900">{{ $product->name }}</h3>
                                    <p class="text-xs text-gray-400">{{ $product->slug }}</p>
                                </div>
                            </template>
                            <template x-if="editing">
                                <input type="text" x-model="name" class="input-daraz text-sm px-3 py-2 w-full">
                            </template>
                        </td>
                        <td class="py-4 hidden md:table-cell">
                            <template x-if="!editing">
                                <span class="text-xs font-medium text-gray-600 bg-gray-100 px-3 py-1.5 rounded-lg">{{ $product->category->name }}</span>
                            </template>
                            <template x-if="editing">
                                <select x-model="category_id" class="input-daraz text-sm px-3 py-2">
                                    @foreach(\App\Models\Category::all() as $cat)
                                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </template>
                        </td>
                        <td class="py-4 text-center">
                            <template x-if="!editing">
                                <span class="text-sm font-bold text-daraz-600">${{ number_format($product->price, 2) }}</span>
                            </template>
                            <template x-if="editing">
                                <input type="number" step="0.01" x-model="price" class="input-daraz text-sm px-3 py-2 w-24 text-center">
                            </template>
                        </td>
                        <td class="py-4 text-center hidden sm:table-cell">
                            <template x-if="!editing">
                                <span class="text-xs font-semibold px-3 py-1.5 rounded-lg {{ $product->stock < 10 ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600' }}">
                                    {{ $product->stock }}
                                </span>
                            </template>
                            <template x-if="editing">
                                <input type="number" x-model="stock" class="input-daraz text-sm px-3 py-2 w-20 text-center">
                            </template>
                        </td>
                        <td class="py-4 pr-4 text-right">
                            <template x-if="!editing">
                                <div class="flex justify-end gap-2">
                                    <button @click="editing = true" class="px-4 py-2 text-xs font-semibold text-daraz-600 bg-daraz-50 rounded-lg hover:bg-daraz-100 transition-colors">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </button>
                                    <button @click="deleteTarget = {{ $product->id }}" class="px-4 py-2 text-xs font-semibold text-red-500 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </div>
                            </template>
                            <template x-if="editing">
                                <div class="flex justify-end gap-2">
                                    <button @click="editing = false" class="px-4 py-2 text-xs font-semibold text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                        Cancel
                                    </button>
                                    <form method="POST" action="{{ route('admin.product.update', $product->id) }}" @submit="editing = false">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="name" :value="name">
                                        <input type="hidden" name="price" :value="price">
                                        <input type="hidden" name="stock" :value="stock">
                                        <input type="hidden" name="category_id" :value="category_id">
                                        <button type="submit" class="px-4 py-2 text-xs font-semibold text-white bg-daraz-500 rounded-lg hover:bg-daraz-600 transition-colors">
                                            <i class="fas fa-save mr-1"></i> Save
                                        </button>
                                    </form>
                                </div>
                            </template>
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

        {{-- Delete Confirmation Modal --}}
        <div x-show="deleteTarget" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="deleteTarget = null"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 z-10 text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-red-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-trash-alt text-2xl text-red-500"></i>
                </div>
                <h3 class="text-lg font-bold text-midnight-900 mb-2">Delete Product?</h3>
                <p class="text-sm text-gray-500 mb-6">This action cannot be undone.</p>
                <div class="flex gap-3">
                    <button @click="deleteTarget = null" class="flex-1 px-4 py-3 text-sm font-semibold text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">
                        Cancel
                    </button>
                    <form method="POST" :action="'{{ route('admin.product.destroy', '__ID__') }}'.replace('__ID__', deleteTarget)" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full px-4 py-3 text-sm font-semibold text-white bg-red-500 rounded-xl hover:bg-red-600 transition-colors">
                            <i class="fas fa-trash mr-2"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
