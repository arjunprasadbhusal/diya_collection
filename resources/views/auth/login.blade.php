<x-guest-layout>
    @section('title', 'Sign In')

    <div class="text-center mb-8">
        <div class="w-16 h-16 mx-auto mb-5 bg-gradient-to-br from-daraz-500 to-daraz-700 rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg shadow-daraz-500/30">
            <i class="fas fa-user"></i>
        </div>
        <h2 class="text-2xl font-bold text-midnight-900">Welcome Back</h2>
        <p class="text-sm text-gray-500 mt-1">Sign in to your Diya Collection account</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Email Address</label>
            <div class="relative">
                <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 text-sm"></i>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       placeholder="name@example.com"
                       class="w-full pl-11 pr-4 h-12 bg-gray-50 border-2 border-gray-200 rounded-xl text-sm focus:bg-white focus:border-daraz-500 focus:ring-4 focus:ring-daraz-500/10 transition-all outline-none @error('email') border-red-500 @enderror">
            </div>
            @error('email')
                <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-xs font-bold uppercase tracking-widest text-gray-500">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-daraz-600 hover:text-daraz-700 font-medium transition-colors">Forgot password?</a>
                @endif
            </div>
            <div class="relative">
                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 text-sm"></i>
                <input id="password" type="password" name="password" required
                       placeholder="Enter your password"
                       class="w-full pl-11 pr-4 h-12 bg-gray-50 border-2 border-gray-200 rounded-xl text-sm focus:bg-white focus:border-daraz-500 focus:ring-4 focus:ring-daraz-500/10 transition-all outline-none @error('password') border-red-500 @enderror">
            </div>
            @error('password')
                <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <label class="flex items-center gap-3 cursor-pointer group">
            <div class="relative w-5 h-5">
                <input type="checkbox" name="remember" class="peer sr-only">
                <div class="w-5 h-5 border-2 border-gray-300 rounded-md peer-checked:bg-daraz-500 peer-checked:border-daraz-500 transition-all group-hover:border-daraz-400"></div>
                <i class="fas fa-check absolute inset-0 flex items-center justify-center text-[10px] text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
            </div>
            <span class="text-sm text-gray-600 group-hover:text-gray-800 transition-colors">Keep me signed in</span>
        </label>

        <button type="submit" class="w-full h-12 bg-gradient-to-r from-daraz-500 to-daraz-700 hover:from-daraz-600 hover:to-daraz-800 text-white font-bold text-sm rounded-xl shadow-lg shadow-daraz-500/30 hover:shadow-xl hover:shadow-daraz-500/40 transition-all duration-200 flex items-center justify-center gap-2">
            <i class="fas fa-sign-in-alt"></i> Sign In
        </button>

        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
            <div class="relative flex justify-center"><span class="bg-white px-4 text-xs text-gray-400">New to Diya Collection?</span></div>
        </div>

        <a href="{{ route('register') }}" class="w-full h-12 flex items-center justify-center gap-2 border-2 border-gray-200 hover:border-daraz-500 text-gray-700 hover:text-daraz-600 font-semibold text-sm rounded-xl transition-all duration-200 group">
            <i class="fas fa-user-plus group-hover:text-daraz-500"></i> Create an Account
        </a>
    </form>
</x-guest-layout>
