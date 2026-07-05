<x-guest-layout>
    @section('title', 'Create Account')

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-midnight-900">Create Account</h2>
        <p class="text-sm text-gray-500 mt-1">Join Diya Collection today</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                   placeholder="John Doe"
                   class="input-daraz @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   placeholder="name@example.com"
                   class="input-daraz @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Password</label>
            <input id="password" type="password" name="password" required
                   placeholder="Min. 8 characters"
                   class="input-daraz @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   placeholder="Repeat your password"
                   class="input-daraz">
        </div>

        <button type="submit" class="btn-daraz w-full py-4 text-sm shadow-lg shadow-daraz-500/30">
            <i class="fas fa-user-plus mr-2"></i> Create Account
        </button>

        <div class="text-center pt-6 border-t border-gray-100">
            <span class="text-sm text-gray-500">Already have an account?</span>
            <a href="{{ route('login') }}" class="text-daraz-600 hover:text-daraz-700 font-semibold ml-1">Sign in</a>
        </div>
    </form>
</x-guest-layout>
