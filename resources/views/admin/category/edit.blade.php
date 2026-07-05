@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
    <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8 shadow-sm max-w-2xl mx-auto">
        <div class="mb-8 pb-6 border-b border-gray-100">
            <a href="{{ route('admin.category.index') }}" class="text-xs text-daraz-600 hover:text-daraz-700 font-semibold mb-4 inline-flex items-center gap-1">
                <i class="fas fa-arrow-left text-[10px]"></i> Back to Categories
            </a>
            <h1 class="text-2xl md:text-3xl font-bold text-midnight-900 mt-1">Edit Category</h1>
        </div>

        <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PATCH')
            
            <div>
                <label for="name" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Category Name</label>
                <input type="text" name="name" id="name" required value="{{ old('name', $category->name) }}"
                       class="input-daraz text-base @error('name') border-red-500 @enderror"
                       placeholder="e.g. Evening Gowns">
                @error('name')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Display Image</label>
                <div class="relative group">
                    <input type="file" name="image" id="image" class="hidden" onchange="previewImage(event)">
                    <label for="image" class="cursor-pointer block">
                        <div id="image-placeholder" class="w-full h-48 border-2 border-dashed border-gray-200 rounded-xl flex-col items-center justify-center group-hover:border-daraz-500 transition-colors bg-gray-50 {{ $category->image ? 'hidden' : 'flex' }}">
                            <i class="fas fa-image text-3xl text-gray-300 group-hover:text-daraz-500 mb-3 transition-colors"></i>
                            <span class="text-xs font-semibold text-gray-400 group-hover:text-daraz-600 transition-colors">Click to Change Image</span>
                        </div>
                        <img id="image-preview" src="{{ $category->image ? $category->image_url : '' }}" 
                             class="w-full h-48 object-cover rounded-xl border border-gray-200 {{ $category->image ? 'block' : 'hidden' }}">
                    </label>
                </div>
                @error('image')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-daraz w-full py-4 text-sm shadow-lg shadow-daraz-500/30">
                <i class="fas fa-save mr-2"></i> Update Category
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
                    preview.classList.add('block');
                    placeholder.classList.add('hidden');
                    placeholder.classList.remove('flex');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
