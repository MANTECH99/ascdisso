@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">
    <div class="flex justify-between items-center mb-6">
<div class="flex items-center gap-4">
    <a href="{{ route('admin.dashboard') }}" 
       class="text-gray-600 hover:text-gray-900 transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="h-6 w-6" 
             fill="none" 
             viewBox="0 0 24 24" 
             stroke="currentColor">
            <path stroke-linecap="round" 
                  stroke-linejoin="round" 
                  stroke-width="2" 
                  d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
    </a>
    <h1 class="text-2xl font-bold">Notifications</h1>
</div>
        <form action="{{ route('admin.notifications.markAllRead') }}" method="POST">
            @csrf
            <button type="submit" class="text-primary-red hover:underline text-sm">
                Tout marquer comme lu
            </button>
        </form>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="space-y-3">
        @forelse($notifications as $notification)
            <div class="bg-white rounded-lg shadow-sm p-4 {{ $notification->is_read ? 'opacity-50' : 'border-l-4 border-primary-red' }}">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-700 {{ $notification->is_read ? '' : 'font-medium' }}">
                            {{ $notification->message }}
                        </p>
                        @if($notification->commande_id)
                            <a href="{{ route('admin.commandes.show', $notification->commande_id) }}" 
                               class="text-primary-red text-sm hover:underline mt-1 inline-block">
                                Voir la commande #{{ $notification->commande_id }}
                            </a>
                        @endif
                    </div>
                    <span class="text-xs text-gray-500 whitespace-nowrap ml-4">
                        {{ $notification->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <div class="text-6xl mb-4">🔔</div>
                <p class="text-gray-600">Aucune notification pour le moment.</p>
            </div>
        @endforelse
    </div>
    
    <div class="mt-4">
        {{ $notifications->links() }}
    </div>
</div>
@endsection