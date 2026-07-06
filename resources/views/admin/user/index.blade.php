@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8 shadow-sm" x-data="{ deleteTarget: null }">
        <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-daraz-600">Administration</span>
                <h1 class="text-2xl md:text-3xl font-bold text-midnight-900 mt-1">Users</h1>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-xs font-bold uppercase tracking-widest text-gray-400 border-b border-gray-100">
                        <th class="text-left pb-4 pl-4">Name</th>
                        <th class="text-left pb-4">Email</th>
                        <th class="text-center pb-4 hidden sm:table-cell">Registered</th>
                        <th class="text-center pb-4">Orders</th>
                        <th class="text-right pb-4 pr-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                        <td class="py-4 pl-4">
                            <p class="text-sm font-semibold text-midnight-900">{{ $user->name }}</p>
                        </td>
                        <td class="py-4">
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </td>
                        <td class="py-4 hidden sm:table-cell text-center">
                            <span class="text-sm text-gray-400">{{ $user->created_at->format('d M Y') }}</span>
                        </td>
                        <td class="py-4 text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-daraz-100 text-daraz-700 text-sm font-bold">{{ $user->orders_count }}</span>
                        </td>
                        <td class="py-4 pr-4 text-right">
                            <button @click="deleteTarget = {{ $user->id }}" class="px-4 py-2 text-xs font-semibold text-red-500 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                <i class="fas fa-trash mr-1"></i> Delete
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-400">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>

        {{-- Delete Confirmation Modal --}}
        <div x-show="deleteTarget" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="deleteTarget = null"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 z-10 text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-red-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-trash-alt text-2xl text-red-500"></i>
                </div>
                <h3 class="text-lg font-bold text-midnight-900 mb-2">Delete User?</h3>
                <p class="text-sm text-gray-500 mb-6">This action cannot be undone.</p>
                <div class="flex gap-3">
                    <button @click="deleteTarget = null" class="flex-1 px-4 py-3 text-sm font-semibold text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">
                        Cancel
                    </button>
                    <form method="POST" :action="'{{ route('admin.users.destroy', '__ID__') }}'.replace('__ID__', deleteTarget)" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full px-4 py-3 text-sm font-semibold text-white bg-red-500 rounded-xl hover:bg-red-600 transition-colors">
                            <i class="fas fa-trash mr-2"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
