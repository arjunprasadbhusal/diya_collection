<section>
    <header class="mb-6">
        <h2 class="text-lg font-bold text-midnight-900">Update Password</h2>
        <p class="text-sm text-gray-500 mt-1">Ensure your account is using a strong password.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="input-daraz" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">New Password</label>
            <input id="update_password_password" name="password" type="password" class="input-daraz" autocomplete="new-password">
            @error('password', 'updatePassword')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="input-daraz" autocomplete="new-password">
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-daraz text-xs"><i class="fas fa-save mr-2"></i> Save</button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-medium">
                    <i class="fas fa-check-circle mr-1"></i> Saved.
                </p>
            @endif
        </div>
    </form>
</section>
