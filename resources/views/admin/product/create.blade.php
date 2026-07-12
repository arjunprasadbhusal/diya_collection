@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
    <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8 shadow-sm max-w-4xl mx-auto">
        <div class="mb-8 pb-6 border-b border-gray-100">
            <a href="{{ route('admin.product.index') }}" class="text-xs text-daraz-600 hover:text-daraz-700 font-semibold mb-4 inline-flex items-center gap-1">
                <i class="fas fa-arrow-left text-[10px]"></i> Back to Products
            </a>
            <h1 class="text-2xl md:text-3xl font-bold text-midnight-900 mt-1">New Product</h1>
        </div>

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Left: Info --}}
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Product Name</label>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                               class="input-daraz text-base @error('name') border-red-500 @enderror"
                               placeholder="e.g. Silk Evening Gown">
                        @error('name') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Category</label>
                        <select name="category_id" id="category_id" required
                                class="input-daraz @error('category_id') border-red-500 @enderror">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Price (Rs.)</label>
                            <input type="number" step="0.01" name="price" id="price" required value="{{ old('price') }}"
                                   class="input-daraz @error('price') border-red-500 @enderror" placeholder="0.00">
                            @error('price') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="stock" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Stock</label>
                            <input type="number" name="stock" id="stock" required value="{{ old('stock', 0) }}"
                                   class="input-daraz @error('stock') border-red-500 @enderror" placeholder="0">
                            @error('stock') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Description</label>
                        <textarea name="description" id="description" rows="5"
                                  class="input-daraz resize-none @error('description') border-red-500 @enderror"
                                  placeholder="Describe this premium piece...">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Right: Image --}}
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Product Image</label>
                    <div class="relative group">
                        <input type="file" name="image" id="image" class="hidden" onchange="previewImage(event)">
                        <label for="image" class="cursor-pointer block">
                            <div id="image-placeholder" class="w-full aspect-[3/4] border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center group-hover:border-daraz-500 transition-colors bg-gray-50">
                                <i class="fas fa-camera text-4xl text-gray-300 group-hover:text-daraz-500 mb-4 transition-colors"></i>
                                <span class="text-sm font-semibold text-gray-400 group-hover:text-daraz-600 transition-colors">Upload Image</span>
                                <span class="text-[10px] text-gray-300 mt-1">High resolution recommended</span>
                            </div>
                            <img id="image-preview" class="hidden w-full aspect-[3/4] object-cover rounded-2xl border border-gray-200 shadow-sm">
                        </label>
                    </div>
                    @error('image') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit" class="btn-daraz w-full py-4 text-sm shadow-lg shadow-daraz-500/30">
                <i class="fas fa-plus-circle mr-2"></i> Create Product
            </button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('image-placeholder');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
