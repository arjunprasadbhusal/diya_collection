@extends('layouts.master')

@section('title', 'My Profile')

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-14 h-14 bg-gradient-to-br from-daraz-500 to-daraz-700 rounded-2xl flex items-center justify-center text-white text-xl font-bold shadow-lg">
                    {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-midnight-900">{{ Auth::user()->name }}</h1>
                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
