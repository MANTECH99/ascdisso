@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

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
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 relative inline-block">
                Notifications
                <span class="absolute left-0 -bottom-2 w-1/2 md:w-16 h-1 bg-primary-red rounded-full"></span>
            </h1>
        </div>
        <form action="{{ route('admin.notifications.markAllRead') }}" method="POST">
            @csrf
            <button type="submit" class="text-primary-red hover:underline text-xs md:text-sm">
                Tout marquer comme lu
            </button>
        </form>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="space-y-3 md:space-y-4">
        @forelse($notifications as $notification)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-3 md:p-4 {{ $notification->is_read ? 'opacity-50' : 'border-l-4 border-primary-red' }}">
                <div class="flex justify-between items-start">
                    <div class="flex items-start gap-3 md:gap-4">
                        @php
                            $icon = '📦';
                            $bg = 'bg-red-50';
                            
                            if (str_contains($notification->message, 'validée')) {
                                $icon = '✅';
                                $bg = 'bg-green-50';
                            } elseif (str_contains($notification->message, 'livraison')) {
                                $icon = '🚚';
                                $bg = 'bg-yellow-50';
                            } elseif (str_contains($notification->message, 'annulée')) {
                                $icon = '❌';
                                $bg = 'bg-gray-100';
                            } elseif (str_contains($notification->message, 'Nouvelle commande')) {
                                $icon = '🛒';
                                $bg = 'bg-blue-50';
                            }
                        @endphp
                        
                        <div class="w-10 h-10 md:w-12 md:h-12 rounded-full {{ $bg }} flex items-center justify-center text-lg md:text-xl flex-shrink-0">
                            {{ $icon }}
                        </div>
                        
                        <div class="min-w-0">
                            <p class="text-gray-700 text-sm md:text-base {{ $notification->is_read ? '' : 'font-medium' }}">
                                {{ $notification->message }}
                            </p>
                            @if($notification->commande_id)
                                <a href="{{ route('admin.commandes.show', $notification->commande_id) }}" 
                                   class="text-primary-red text-xs md:text-sm hover:underline mt-1 inline-block">
                                    Voir la commande #{{ $notification->commande_id }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <span class="text-xs text-gray-400 whitespace-nowrap ml-2 md:ml-4">
                        {{ $notification->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12 text-center">
                <div class="w-20 h-20 md:w-28 md:h-28 mx-auto mb-4 md:mb-6 rounded-full bg-red-50 flex items-center justify-center text-3xl md:text-5xl">
                    🔔
                </div>
                <h2 class="text-lg md:text-2xl font-bold text-gray-900 mb-2 md:mb-3">
                    Aucune notification
                </h2>
                <p class="text-gray-500 text-sm md:text-base">
                    Aucune notification pour le moment.
                </p>
            </div>
        @endforelse
    </div>
    
    <div class="mt-6">
        {{ $notifications->links() }}
    </div>
</div>
@endsection