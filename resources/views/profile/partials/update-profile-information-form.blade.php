<section>
    <header class="mb-6">
        <h2 class="text-lg font-bold text-midnight-900">Profile Information</h2>
        <p class="text-sm text-gray-500 mt-1">Update your account's profile information and email address.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Name</label>
            <input id="name" name="name" type="text" class="input-daraz" :value="old('name', $user->name)" required autofocus>
            @error('name')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Email</label>
            <input id="email" name="email" type="email" class="input-daraz" :value="old('email', $user->email)" required>
            @error('email')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-amber-50 border border-amber-200 rounded-xl text-xs text-amber-700">
                    Your email address is unverified.
                    <button form="send-verification" class="underline font-semibold hover:text-amber-800 ml-1">Click here to re-send verification.</button>
                </div>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-xs font-medium text-green-600">A new verification link has been sent.</p>
                @endif
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-daraz text-xs"><i class="fas fa-save mr-2"></i> Save</button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-medium">
                    <i class="fas fa-check-circle mr-1"></i> Saved.
                </p>
            @endif
        </div>
    </form>
</section>
