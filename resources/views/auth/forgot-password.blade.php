<x-guest-layout>
    @section('title', 'Forgot Password')

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-midnight-900">Forgot Password?</h2>
        <p class="text-sm text-gray-500 mt-1">No problem. Enter your email and we'll send you a reset link.</p>
    </div>

    <x-auth-session-status class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 text-sm font-medium rounded-xl" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
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

        <button type="submit" class="btn-daraz w-full py-4 text-sm shadow-lg shadow-daraz-500/30">
            <i class="fas fa-paper-plane mr-2"></i> Send Reset Link
        </button>

        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm text-daraz-600 hover:text-daraz-700 font-medium">Back to Sign In</a>
        </div>
    </form>
</x-guest-layout>
