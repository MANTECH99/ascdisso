@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-4xl">
    <!-- En-tête avec flèche de retour -->
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
        <h1 class="text-2xl font-bold">Commande #{{ $commande->id }}</h1>
    </div>
    
    <!-- Version Desktop (3 colonnes) -->
    <div class="hidden md:grid md:grid-cols-3 gap-6 mb-6">
        <!-- Infos client -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="font-bold mb-4">👤 Client</h3>
            <p class="font-medium">{{ $commande->nom_complet }}</p>
            <p class="text-sm text-gray-600">{{ $commande->telephone }}</p>
            <p class="text-sm text-gray-600 mt-2">{{ $commande->adresse }}</p>
            @if($commande->user)
                <p class="text-xs text-gray-500 mt-2">Compte : {{ $commande->user->email }}</p>
            @else
                <p class="text-xs text-gray-500 mt-2">Commande invité</p>
            @endif
        </div>
        
        <!-- Infos commande -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="font-bold mb-4">📦 Commande</h3>
            <p><span class="text-sm text-gray-600">Date :</span> {{ $commande->created_at->format('d/m/Y à H:i') }}</p>
            <p><span class="text-sm text-gray-600">Statut :</span> 
                <span class="px-2 py-1 rounded text-xs {{ $commande->statut_badge }}">
                    {{ ucfirst($commande->statut) }}
                </span>
            </p>
            <p><span class="text-sm text-gray-600">Paiement :</span>
                            @if($commande->mode_paiement === 'livraison')
                                À la livraison
                            @elseif($commande->mode_paiement === 'wave')
                                Wave
                            @elseif($commande->mode_paiement === 'orange_money')
                                Orange Money
                            @endif</p>
            <p><span class="text-sm text-gray-600">Livraison :</span> {{ $commande->mode_livraison }}</p>
        </div>
        
        <!-- Montants -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="font-bold mb-4">💰 Montants</h3>
            <p class="text-sm text-gray-600">Sous-total : {{ number_format($commande->sous_total, 0, ',', ' ') }} FCFA</p>
            <p class="text-sm text-gray-600">Quantité : {{ $commande->quantite_totale }}</p>
            <p class="text-xl font-bold text-primary-red mt-2">
                Total : {{ number_format($commande->total, 0, ',', ' ') }} FCFA
            </p>
            <p class="text-sm mt-2">
                Statut paiement : 
                @if($commande->statut_paiement === 'non_paye')
                    <span class="text-yellow-600">⚠️ Non payé</span>
                @else
                    <span class="text-green-600">✅ Payé</span>
                @endif
            </p>
        </div>
    </div>
    
    <!-- Version Mobile (cartes empilées) -->
    <div class="space-y-4 md:hidden mb-6">
        <!-- Infos client -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h3 class="font-bold mb-3 text-lg">👤 Client</h3>
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-medium">{{ $commande->nom_complet }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <span class="text-sm">{{ $commande->telephone }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-sm">{{ $commande->adresse }}</span>
                </div>
                @if($commande->user)
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-xs text-gray-500">{{ $commande->user->email }}</span>
                    </div>
                @else
                    <span class="text-xs text-gray-500 ml-7">Commande invité</span>
                @endif
            </div>
        </div>
        
        <!-- Infos commande -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h3 class="font-bold mb-3 text-lg">📦 Commande</h3>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Date :</span>
                    <span class="text-sm">{{ $commande->created_at->format('d/m/Y à H:i') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Statut :</span>
                    <span class="px-2 py-1 rounded text-xs {{ $commande->statut_badge }}">
                        {{ ucfirst($commande->statut) }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Paiement :</span>
                    <span class="text-sm">{{ $commande->mode_paiement === 'livraison' ? 'Cash' : 'Wave' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Livraison :</span>
                    <span class="text-sm">{{ $commande->mode_livraison }}</span>
                </div>
            </div>
        </div>
        
        <!-- Montants -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h3 class="font-bold mb-3 text-lg">💰 Montants</h3>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Sous-total :</span>
                    <span class="text-sm">{{ number_format($commande->sous_total, 0, ',', ' ') }} FCFA</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Quantité totale :</span>
                    <span class="text-sm">{{ $commande->quantite_totale }}</span>
                </div>
                <div class="flex justify-between border-t pt-2 mt-2">
                    <span class="font-bold">Total :</span>
                    <span class="font-bold text-primary-red">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</span>
                </div>
                <div class="flex justify-between mt-2">
                    <span class="text-sm text-gray-600">Statut paiement :</span>
                    @if($commande->statut_paiement === 'non_paye')
                        <span class="text-yellow-600">⚠️ Non payé</span>
                    @else
                        <span class="text-green-600">✅ Payé</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Produits - Version Desktop -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 hidden md:block">
        <h3 class="font-bold mb-4">📦 Produits commandés</h3>
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left">Image</th>
                    <th class="px-4 py-3 text-left">Produit</th>
                    <th class="px-4 py-3 text-center">Quantité</th>
                    <th class="px-4 py-3 text-right">Prix unitaire</th>
                    <th class="px-4 py-3 text-right">Sous-total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commande->commandeProducts as $item)
                    <tr class="border-b">
                        <td class="px-4 py-3">
                            <img src="{{ $item->product->first_image_url }}" 
                                 alt="{{ $item->product->nom }}" 
                                 class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="px-4 py-3">{{ $item->product->nom }}</td>
                        <td class="px-4 py-3 text-center">{{ $item->quantite }}</td>
                        <td class="px-4 py-3 text-right">{{ number_format($item->prix_unitaire, 2) }} FCFA</td>
                        <td class="px-4 py-3 text-right font-bold">{{ number_format($item->sous_total, 2) }} FCFA</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Produits - Version Mobile (cartes produits) -->
    <div class="space-y-3 md:hidden mb-6">
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h3 class="font-bold mb-3 text-lg">📦 Produits commandés</h3>
            <div class="space-y-3">
                @foreach($commande->commandeProducts as $item)
                    <div class="flex gap-3 border-b pb-3 last:border-0">
                        <img src="{{ $item->product->first_image_url }}" 
                             alt="{{ $item->product->nom }}" 
                             class="w-16 h-16 object-cover rounded">
                        <div class="flex-1">
                            <h4 class="font-medium text-sm">{{ $item->product->nom }}</h4>
                            <div class="flex justify-between mt-2">
                                <span class="text-xs text-gray-600">Quantité: {{ $item->quantite }}</span>
                                <span class="text-xs text-gray-600">{{ number_format($item->prix_unitaire, 0) }} FCFA</span>
                            </div>
                            <div class="flex justify-between mt-1">
                                <span class="text-sm font-bold">Sous-total:</span>
                                <span class="text-sm font-bold text-primary-red">{{ number_format($item->sous_total, 0) }} FCFA</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- Actions - Version Desktop -->
    <div class="bg-white rounded-lg shadow-sm p-6 hidden md:block">
        <h3 class="font-bold mb-4">⚡ Actions</h3>
        <div class="flex space-x-3">
            @if($commande->statut === 'en_attente')
                <form action="{{ route('admin.commandes.valider', $commande->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">
                        ✅ Valider la commande
                    </button>
                </form>
            @endif
            
            @if($commande->statut === 'validee')
                <form action="{{ route('admin.commandes.livrer', $commande->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                        🚚 Marquer comme livrée
                    </button>
                </form>
            @endif
            
            @if(!in_array($commande->statut, ['livree', 'annulee']))
                <form action="{{ route('admin.commandes.annuler', $commande->id) }}" method="POST"
                      onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?')">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600">
                        ❌ Annuler la commande
                    </button>
                </form>
            @endif
        </div>
    </div>
    
    <!-- Actions - Version Mobile (boutons pleine largeur) -->
    <div class="bg-white rounded-lg shadow-sm p-4 md:hidden">
        <h3 class="font-bold mb-3 text-lg">⚡ Actions</h3>
        <div class="space-y-2">
            @if($commande->statut === 'en_attente')
                <form action="{{ route('admin.commandes.valider', $commande->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 font-medium">
                        ✅ Valider la commande
                    </button>
                </form>
            @endif
            
            @if($commande->statut === 'validee')
                <form action="{{ route('admin.commandes.livrer', $commande->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 font-medium">
                        🚚 Marquer comme livrée
                    </button>
                </form>
            @endif
            
            @if(!in_array($commande->statut, ['livree', 'annulee']))
                <form action="{{ route('admin.commandes.annuler', $commande->id) }}" method="POST"
                      onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?')">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 font-medium">
                        ❌ Annuler la commande
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection