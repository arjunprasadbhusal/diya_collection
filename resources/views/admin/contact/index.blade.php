@extends('layouts.app')

@section('title', 'Contact Messages')

@section('content')
    <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8 shadow-sm">
        <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-daraz-600">Administration</span>
                <h1 class="text-2xl md:text-3xl font-bold text-midnight-900 mt-1">Contact Messages</h1>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-xs font-bold uppercase tracking-widest text-gray-400 border-b border-gray-100">
                        <th class="text-left pb-4 pl-4">From</th>
                        <th class="text-left pb-4">Subject</th>
                        <th class="text-left pb-4 hidden md:table-cell">Message</th>
                        <th class="text-center pb-4 hidden sm:table-cell">Date</th>
                        <th class="text-right pb-4 pr-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors {{ !$msg->is_read ? 'bg-daraz-50/50' : '' }}">
                        <td class="py-4 pl-4">
                            <p class="text-sm font-semibold text-midnight-900">{{ $msg->name }}</p>
                            <p class="text-xs text-gray-400">{{ $msg->email }}</p>
                        </td>
                        <td class="py-4">
                            <p class="text-sm font-medium text-gray-700">{{ $msg->subject }}</p>
                            @if(!$msg->is_read)
                                <span class="inline-block mt-1 px-2 py-0.5 bg-daraz-500 text-white text-[9px] font-bold rounded">New</span>
                            @endif
                        </td>
                        <td class="py-4 hidden md:table-cell">
                            <p class="text-sm text-gray-500 truncate max-w-xs">{{ $msg->message }}</p>
                        </td>
                        <td class="py-4 text-center hidden sm:table-cell text-xs text-gray-400">{{ $msg->created_at?->format('M d, Y') }}</td>
                        <td class="py-4 pr-4 text-right">
                            <div class="flex justify-end gap-2">
                                @if(!$msg->is_read)
                                    <form action="{{ route('admin.contact.read', $msg->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="px-3 py-2 text-xs font-semibold text-daraz-600 bg-daraz-50 rounded-lg hover:bg-daraz-100 transition-colors">
                                            <i class="fas fa-check mr-1"></i> Mark Read
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.contact.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-2 text-xs font-semibold text-red-500 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-16 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-envelope-open-text text-2xl text-gray-300"></i>
                            </div>
                            <p class="text-gray-400 text-sm">No messages yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="mt-6">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
@endsection
