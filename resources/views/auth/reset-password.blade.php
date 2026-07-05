<x-guest-layout>
    @section('title', 'Reset Password')

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-midnight-900">Reset Password</h2>
        <p class="text-sm text-gray-500 mt-1">Choose a new password for your account.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required
                   class="input-daraz @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">New Password</label>
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
            <i class="fas fa-save mr-2"></i> Reset Password
        </button>
    </form>
</x-guest-layout>
