@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">
    <h1 class="text-2xl font-bold mb-6">Messages</h1>
    
    @if($notifications->count() > 0)
        <div class="space-y-3">
            @foreach($notifications as $notification)
                <div class="bg-white rounded-lg shadow-sm p-4 {{ $notification->is_read ? 'opacity-75' : 'border-l-4 border-primary-red' }}">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-700">{{ $notification->message }}</p>
                            @if($notification->commande_id)
                                <a href="{{ route('commande.recu', $notification->commande_id) }}" 
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
            @endforeach
        </div>
        
        {{ $notifications->links() }}
    @else
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <div class="text-6xl mb-4">📭</div>
            <p class="text-gray-600">Aucun message pour le moment.</p>
        </div>
    @endif
</div>
@endsection