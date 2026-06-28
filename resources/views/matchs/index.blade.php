@extends('layouts.app')

@section('title', 'Matchs - Résultats & Calendrier | ASC Disso')
@section('meta_description', 'Suivez tous les matchs de l\'ASC Disso : résultats, calendrier, scores en direct. Ne manquez aucune rencontre de votre club de Mboro.')
@section('meta_keywords', 'matchs ASC Disso, calendrier football Mboro, résultats ASC Disso, navétanes Mboro, live score Sénégal')
@section('canonical_url', route('matchs'))

@section('og_title', 'Matchs - Résultats & Calendrier | ASC Disso')
@section('og_description', 'Tous les matchs de l\'ASC Disso : résultats, scores en direct et prochaines rencontres.')
@section('og_image', asset('images/logo.png'))
@section('og_url', route('matchs'))

@section('content')
<div class="bg-gradient-to-br from-red-50 to-gray-50 min-h-screen">
    <!-- Hero Section -->
    <div class="bg-primary-dark text-white py-12">
        <div class="container mx-auto px-4">
            <div class="flex items-center space-x-4 mb-4">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold">Résultats & Calendrier</h1>
                    <p class="text-white/80 mt-1">Suivez tous les matchs de l'ASC Disso</p>
                </div>
            </div>
        </div>
    </div>

<!-- Stats Rapides -->
<div class="container mx-auto px-4 -mt-8">
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white rounded-xl shadow-lg p-4 flex items-center justify-around">
            <div class="text-center">
                <div class="text-xl font-bold text-green-600">{{ $stats['victoires'] }}</div>
                <div class="text-xs text-gray-500">Victoires</div>
            </div>
            <div class="text-center">
                <div class="text-xl font-bold text-gray-600">{{ $stats['nuls'] }}</div>
                <div class="text-xs text-gray-500">Nuls</div>
            </div>
            <div class="text-center">
                <div class="text-xl font-bold text-red-600">{{ $stats['defaites'] }}</div>
                <div class="text-xs text-gray-500">Défaites</div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 flex items-center justify-around">
            <div class="text-center">
                <div class="text-xl font-bold text-primary-red">{{ $stats['buts_marques'] }}</div>
                <div class="text-xs text-gray-500">Marqués</div>
            </div>
            <div class="text-center">
                <div class="text-xl font-bold text-gray-600">{{ $stats['buts_encaisses'] }}</div>
                <div class="text-xs text-gray-500">Encaissés</div>
            </div>
        </div>
    </div>
</div>

    <!-- Matchs -->
    <div class="container mx-auto px-4 py-8">
        <!-- Filtres -->
        <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
            <form action="{{ route('matchs') }}" method="GET" class="flex flex-wrap gap-2">
                <a href="{{ route('matchs') }}" 
                   class="px-4 py-2 {{ !request()->has('statut') ? 'bg-primary-red text-white' : 'bg-gray-100 text-gray-700' }} rounded-lg text-sm font-medium">
                    Tous
                </a>
                <a href="{{ route('matchs', ['statut' => 'termine']) }}" 
                   class="px-4 py-2 {{ request('statut') == 'termine' ? 'bg-primary-red text-white' : 'bg-gray-100 text-gray-700' }} rounded-lg text-sm font-medium">
                    Terminés
                </a>
                <a href="{{ route('matchs', ['statut' => 'en_cours']) }}" 
                   class="px-4 py-2 {{ request('statut') == 'en_cours' ? 'bg-primary-red text-white' : 'bg-gray-100 text-gray-700' }} rounded-lg text-sm font-medium">
                    Live
                </a>
                <a href="{{ route('matchs', ['statut' => 'a_venir']) }}" 
                   class="px-4 py-2 {{ request('statut') == 'a_venir' ? 'bg-primary-red text-white' : 'bg-gray-100 text-gray-700' }} rounded-lg text-sm font-medium">
                    À venir
                </a>
            </form>
        </div>

        <!-- Liste des matchs -->
        <div class="space-y-4">
            @forelse($matchs as $match)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                    <!-- Date et compétition -->
                    <div class="bg-gray-50 px-4 py-2 flex justify-between items-center border-b">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            @if($match->date_match)
    <span class="text-sm text-gray-600">{{ $match->date_formatee }}</span>
@else
    <span class="text-sm text-orange-600 font-medium">📅 Date</span>
@endif
                        </div>
                        <span class="text-xs font-semibold text-gray-500 uppercase">{{ $match->competition }}</span>
                    </div>
                    
                    <div class="p-4">
                            {{-- 👇 AJOUTER CES 8 LIGNES 👇 --}}
    @if($match->statut === 'a_venir' && !$match->date_match)
        <div class="flex justify-center mb-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-800">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Date à confirmer
            </span>
        </div>
    @endif
    {{-- 👆 FIN DE L'AJOUT 👆 --}}
                        <!-- Match en cours -->
                        @if($match->statut === 'en_cours')
                            <div class="flex justify-center mb-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                    <span class="w-2 h-2 bg-red-500 rounded-full mr-2 animate-pulse"></span>
                                    EN DIRECT • {{ $match->minute }}'
                                </span>
                            </div>
                        @endif
                        
                        <div class="flex items-center justify-between">
<!-- Équipe domicile -->
<div class="flex-1 text-center">
    <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-2 overflow-hidden">
        @if($match->logo_domicile_url)
            <img src="{{ $match->logo_domicile_url }}" 
                 alt="{{ $match->equipe_domicile }}" 
                 class="w-full h-full object-contain p-1">
        @elseif($match->equipe_domicile === 'ASC Disso')
            <img src="{{ asset('images/logo.png') }}" alt="ASC Disso" class="w-12 h-12">
        @else
            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                <span class="text-lg font-bold text-gray-500">
                    {{ substr($match->equipe_domicile, 0, 2) }}
                </span>
            </div>
        @endif
    </div>
    <h3 class="font-bold text-gray-800 text-sm">{{ $match->equipe_domicile }}</h3>
</div>
                            
                            <!-- Score -->
                            <div class="flex-shrink-0 mx-4">
                                @if($match->statut === 'a_venir')
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-gray-400">VS</div>
                                        <div class="text-sm text-gray-500 mt-1">
    @if($match->date_match)
        {{ $match->heure }}
    @else
        --:--
    @endif
</div>
                                    </div>
                                @elseif($match->statut === 'en_cours')
                                    <div class="bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl px-6 py-3">
                                        <div class="text-3xl font-bold text-center">
                                            {{ $match->score }}
                                        </div>
                                    </div>
                                @else
                                    <div class="bg-gray-800 text-white rounded-xl px-6 py-3">
                                        <div class="text-3xl font-bold text-center">
                                            {{ $match->score }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
<!-- Équipe extérieur -->
<div class="flex-1 text-center">
    <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-2 overflow-hidden">
        @if($match->logo_exterieur_url)
            <img src="{{ $match->logo_exterieur_url }}" 
                 alt="{{ $match->equipe_exterieur }}" 
                 class="w-full h-full object-contain p-1">
        @elseif($match->equipe_exterieur === 'ASC Disso')
            <img src="{{ asset('images/logo.png') }}" alt="ASC Disso" class="w-12 h-12">
        @elseif(!$match->equipe_exterieur || $match->equipe_exterieur === 'À déterminer')
            {{-- 👇 NOUVEAU : Adversaire pas encore connu 👇 --}}
            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                <span class="text-2xl font-bold text-orange-500">?</span>
            </div>
        @else
            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                <span class="text-lg font-bold text-gray-500">
                    {{ substr($match->equipe_exterieur, 0, 2) }}
                </span>
            </div>
        @endif
    </div>
    <h3 class="font-bold text-gray-800 text-sm">
        {{ $match->equipe_exterieur ?: 'À déterminer' }}
    </h3>
</div>
                        </div>
                        
                        <!-- Buteurs et Stade -->
                        @if(($match->statut === 'termine' || $match->statut === 'en_cours') && ($match->buteurs_domicile || $match->buteurs_exterieur))
                            <div class="mt-4 pt-4 border-t">
                                <div class="grid grid-cols-2 gap-4 text-xs">
                                    <div>
                                        @foreach($match->buteurs_domicile as $buteur)
                                            <div class="flex items-center space-x-1 text-green-600">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                                                </svg>
                                                <span>{{ $buteur }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div>
                                        @foreach($match->buteurs_exterieur as $buteur)
                                            <div class="flex items-center space-x-1 text-gray-600">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                                                </svg>
                                                <span>{{ $buteur }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        @if($match->stade)
                            <div class="mt-3 flex items-center justify-center space-x-2 text-gray-500 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $match->stade }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">Aucun match trouvé</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $matchs->links() }}
        </div>
    </div>
</div>

<style>
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
@endsection