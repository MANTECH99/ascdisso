@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">

    {{-- Titre --}}
    <div class="mb-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 relative inline-block">
            Messages
            <span class="absolute left-0 -bottom-2 w-1/2 md:w-16 h-1 bg-primary-red rounded-full"></span>
        </h1>
    </div>

    @if($notifications->count() > 0)

        <div class="space-y-3 md:space-y-4">

            @foreach($notifications as $notification)

                <a href="{{ route('commande.recu', $notification->commande_id) }}"
                   class="block bg-white rounded-2xl border border-gray-100 shadow-sm p-3 md:p-4 hover:shadow-md transition">

                    <div class="flex items-center justify-between">

                        {{-- Partie gauche --}}
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

<div class="w-12 h-12 md:w-16 md:h-16 rounded-full {{ $bg }} flex items-center justify-center text-xl md:text-3xl flex-shrink-0">
    {{ $icon }}
</div>

                            {{-- Infos --}}
                            <div class="min-w-0">
                                <h3 class="font-bold text-sm md:text-xl text-gray-900 truncate">
                                    Commande #{{ $notification->commande_id }}
                                </h3>

                                <p class="text-gray-500 mt-1.5 md:mt-3 text-xs md:text-sm">
                                    {{ $notification->message }}
                                </p>
                            </div>

                        </div>

                        {{-- Partie droite --}}
                        <div class="text-right flex flex-col items-end flex-shrink-0 ml-2 md:ml-0">
                            <span class="text-gray-400 text-xs md:text-sm">
                                {{ $notification->created_at->format('d M Y') }}
                            </span>
                            <span class="text-gray-400 text-xs md:text-sm">
                                {{ $notification->created_at->format('H:i') }}
                            </span>
                            @if(!$notification->is_read)
                                <div class="w-2 h-2 md:w-3 md:h-3 bg-red-500 rounded-full mt-1.5 md:mt-3"></div>
                            @endif
                        </div>

                    </div>

                </a>

            @endforeach

        </div>

        <div class="mt-6">
            {{ $notifications->links() }}
        </div>

    @else

        {{-- Empty state --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12 text-center">
            <div class="w-20 h-20 md:w-28 md:h-28 mx-auto mb-4 md:mb-6 rounded-full bg-red-50 flex items-center justify-center text-3xl md:text-5xl">
                💬
            </div>
            <h2 class="text-lg md:text-2xl font-bold text-gray-900 mb-2 md:mb-3">
                Aucun message
            </h2>
            <p class="text-gray-500 text-sm md:text-base">
                Vous n'avez aucune notification pour le moment.
            </p>
        </div>

    @endif

</div>
@endsection