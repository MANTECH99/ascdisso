@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
<div class="flex items-center gap-4 mb-6">
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
    <h1 class="text-2xl font-bold">Commandes</h1>
</div>
    
    <!-- Filtres - Version mobile scrollable -->
    <div class="bg-white rounded-lg shadow-sm p-4 mb-6 overflow-x-auto">
        <div class="flex space-x-2 min-w-max">
            <a href="{{ route('admin.commandes.index', ['status' => 'en_attente']) }}" 
               class="px-4 py-2 rounded-lg whitespace-nowrap {{ $status == 'en_attente' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100' }}">
                En attente
            </a>
            <a href="{{ route('admin.commandes.index', ['status' => 'validee']) }}" 
               class="px-4 py-2 rounded-lg whitespace-nowrap {{ $status == 'validee' ? 'bg-green-100 text-green-800' : 'bg-gray-100' }}">
                Validées
            </a>
            <a href="{{ route('admin.commandes.index', ['status' => 'livree']) }}" 
               class="px-4 py-2 rounded-lg whitespace-nowrap {{ $status == 'livree' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100' }}">
                Livrées
            </a>
            <a href="{{ route('admin.commandes.index', ['status' => 'annulee']) }}" 
               class="px-4 py-2 rounded-lg whitespace-nowrap {{ $status == 'annulee' ? 'bg-red-100 text-red-800' : 'bg-gray-100' }}">
                Annulées
            </a>
        </div>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Version Desktop (table) -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden hidden md:block">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-medium">N°</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Client</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Téléphone</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Adresse</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Total</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Statut</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Date</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($commandes as $commande)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-bold">#{{ $commande->id }}</td>
                        <td class="px-4 py-3">{{ $commande->nom_complet }}</td>
                        <td class="px-4 py-3 text-sm">{{ $commande->telephone }}</td>
                        <td class="px-4 py-3 text-sm max-w-xs truncate">{{ $commande->adresse }}</td>
                        <td class="px-4 py-3 font-bold">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-xs {{ $commande->statut_badge }}">
                                {{ ucfirst($commande->statut) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">{{ $commande->created_at->format('d/m/Y H:i') }}</td>
<td class="px-4 py-3">
    <div class="flex space-x-2">
        <a href="{{ route('admin.commandes.show', $commande->id) }}" 
           class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600 transition">
            Détails
        </a>
        
        @if($commande->statut === 'en_attente')
            <form action="{{ route('admin.commandes.valider', $commande->id) }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center px-3 py-1 bg-green-500 text-white rounded-lg text-sm hover:bg-green-600 transition">
                    Valider
                </button>
            </form>
        @endif
        
        @if($commande->statut === 'validee')
            <form action="{{ route('admin.commandes.livrer', $commande->id) }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600 transition">
                    Livrer
                </button>
            </form>
        @endif
        
        @if(!in_array($commande->statut, ['livree', 'annulee']))
            <form action="{{ route('admin.commandes.annuler', $commande->id) }}" method="POST"
                  onsubmit="return confirm('Annuler cette commande ?')">
                @csrf
                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600 transition">
                    Annuler
                </button>
            </form>
        @endif
    </div>
</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                            Aucune commande trouvée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Version Mobile (cartes) -->
    <div class="space-y-4 md:hidden">
        @forelse($commandes as $commande)
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <span class="font-bold text-lg">#{{ $commande->id }}</span>
                        <span class="ml-2 px-2 py-1 rounded text-xs {{ $commande->statut_badge }}">
                            {{ ucfirst($commande->statut) }}
                        </span>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-green-600">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</div>
                        <div class="text-xs text-gray-500">{{ $commande->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
                
                <div class="space-y-2 mb-3">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="text-sm">{{ $commande->nom_complet }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="text-sm">{{ $commande->telephone }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-sm truncate">{{ $commande->adresse }}</span>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-2 pt-3 border-t">
                    <a href="{{ route('admin.commandes.show', $commande->id) }}" 
                       class="flex-1 text-center bg-blue-500 text-white px-3 py-2 rounded-lg text-sm">
                        Détails
                    </a>
                    
                    @if($commande->statut === 'en_attente')
                        <form action="{{ route('admin.commandes.valider', $commande->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-green-500 text-white px-3 py-2 rounded-lg text-sm">
                                Valider
                            </button>
                        </form>
                    @endif
                    
                    @if($commande->statut === 'validee')
                        <form action="{{ route('admin.commandes.livrer', $commande->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-blue-500 text-white px-3 py-2 rounded-lg text-sm">
                                Livrer
                            </button>
                        </form>
                    @endif
                    
                    @if(!in_array($commande->statut, ['livree', 'annulee']))
                        <form action="{{ route('admin.commandes.annuler', $commande->id) }}" method="POST"
                              onsubmit="return confirm('Annuler cette commande ?')" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-red-500 text-white px-3 py-2 rounded-lg text-sm">
                                Annuler
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-sm p-8 text-center text-gray-500">
                Aucune commande trouvée.
            </div>
        @endforelse
    </div>
    
    <div class="mt-4">
        {{ $commandes->links() }}
    </div>
</div>
@endsection