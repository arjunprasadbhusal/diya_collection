<x-guest-layout>
    @section('title', 'Confirm Password')

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-midnight-900">Confirm Password</h2>
        <p class="text-sm text-gray-500 mt-1">This is a secure area. Please confirm your password before continuing.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <label for="password" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Password</label>
            <input id="password" type="password" name="password" required
                   placeholder="Enter your password"
                   class="input-daraz @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-daraz w-full py-4 text-sm shadow-lg shadow-daraz-500/30">
            <i class="fas fa-lock mr-2"></i> Confirm
        </button>
    </form>
</x-guest-layout>
