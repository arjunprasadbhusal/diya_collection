<x-guest-layout>
    @section('title', 'Sign In')

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-midnight-900">Welcome Back</h2>
        <p class="text-sm text-gray-500 mt-1">Sign in to access your account</p>
    </div>

    <x-auth-session-status class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 text-sm font-medium rounded-xl" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   placeholder="name@example.com"
                   class="input-daraz @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-xs font-bold uppercase tracking-widest text-gray-500">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-daraz-600 hover:text-daraz-700 font-medium">Forgot?</a>
                @endif
            </div>
            <input id="password" type="password" name="password" required
                   placeholder="Enter your password"
                   class="input-daraz @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="remember" class="rounded border-gray-300 text-daraz-500 focus:ring-daraz-500">
            <span class="text-sm text-gray-600">Remember me</span>
        </label>

        <button type="submit" class="btn-daraz w-full py-4 text-sm shadow-lg shadow-daraz-500/30">
            <i class="fas fa-sign-in-alt mr-2"></i> Sign In
        </button>

        <div class="text-center pt-6 border-t border-gray-100">
            <span class="text-sm text-gray-500">Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-daraz-600 hover:text-daraz-700 font-semibold ml-1">Create one</a>
        </div>
    </form>
</x-guest-layout>
