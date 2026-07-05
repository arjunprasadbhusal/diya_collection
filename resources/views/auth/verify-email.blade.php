<x-guest-layout>
    @section('title', 'Verify Email')

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-midnight-900">Verify Your Email</h2>
        <p class="text-sm text-gray-500 mt-1">Thanks for signing up! Please verify your email address to get started.</p>
    </div>

    <div class="p-4 bg-blue-50 border border-blue-200 rounded-xl text-sm text-blue-700 mb-6">
        <i class="fas fa-envelope mr-2 text-blue-500"></i>
        We've sent a verification link to your email address.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-xl text-sm text-green-700">
            <i class="fas fa-check-circle mr-2 text-green-500"></i>
            A new verification link has been sent.
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-daraz w-full py-4 text-sm shadow-lg shadow-daraz-500/30">
                <i class="fas fa-paper-plane mr-2"></i> Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-daraz-outline w-full py-4 text-sm">
                <i class="fas fa-sign-out-alt mr-2"></i> Log Out
            </button>
        </form>
    </div>
</x-guest-layout>
