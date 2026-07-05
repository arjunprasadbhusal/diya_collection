<section class="space-y-6">
    <header class="mb-6">
        <h2 class="text-lg font-bold text-red-600">Delete Account</h2>
        <p class="text-sm text-gray-500 mt-1">Once deleted, all your data will be permanently removed. Please download any data you wish to keep.</p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-6 py-3 bg-red-500 text-white text-sm font-semibold rounded-xl hover:bg-red-600 transition-all shadow-lg shadow-red-500/30">
        <i class="fas fa-trash mr-2"></i> Delete Account
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-midnight-900 mb-2">Are you sure?</h2>
            <p class="text-sm text-gray-500 mb-6">Enter your password to confirm account deletion. This action cannot be undone.</p>

            <div class="mb-6">
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" class="input-daraz" placeholder="Enter your password">
                @error('password', 'userDeletion')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-6 py-3 border border-gray-200 rounded-xl text-sm font-medium hover:bg-gray-50 transition-colors">
                    Cancel
                </x-secondary-button>
                <x-danger-button class="px-6 py-3 bg-red-500 text-white text-sm font-semibold rounded-xl hover:bg-red-600 transition-all">
                    <i class="fas fa-trash mr-2"></i> Delete Account
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
