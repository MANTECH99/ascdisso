@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    
    <!-- En-tête avec nom de l'admin et date -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Tableau de bord</h1>
            <p class="text-sm text-gray-500">Bienvenue, {{ Auth::user()->prenom }} {{ Auth::user()->nom }}</p>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-600">{{ now()->format('d/m/Y') }}</p>
            <p class="text-xs text-gray-500">{{ now()->format('H:i') }}</p>
        </div>
    </div>
    
    <!-- Menu rapide admin -->
    <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
        <div class="grid grid-cols-2 md:grid-cols-6 gap-3">
            <a href="{{ route('admin.commandes.index') }}" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-50 transition">
                <span class="text-2xl mb-1">📋</span>
                <span class="text-xs font-medium">Commandes</span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-50 transition">
                <span class="text-2xl mb-1">🛍️</span>
                <span class="text-xs font-medium">Produits</span>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-50 transition">
                <span class="text-2xl mb-1">📂</span>
                <span class="text-xs font-medium">Catégories</span>
            </a>
            <a href="{{ route('admin.banners.index') }}" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-50 transition">
                <span class="text-2xl mb-1">🖼️</span>
                <span class="text-xs font-medium">Bannières</span>
            </a>
            <a href="{{ route('admin.notifications.index') }}" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-50 transition relative">
                <span class="text-2xl mb-1">🔔</span>
                <span class="text-xs font-medium">Notifications</span>
                <span id="notif-badge" class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden"></span>
            </a>
            <a href="{{ route('home') }}" target="_blank" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-50 transition">
                <span class="text-2xl mb-1">🏠</span>
                <span class="text-xs font-medium">Voir le site</span>
            </a>
        </div>
    </div>
    
    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-primary-red">
            <div class="flex justify-between items-start">
                <div>
                    <div class="text-sm text-gray-600 mb-1">Commandes totales</div>
                    <div class="text-3xl font-bold text-primary-dark">{{ $totalCommandes }}</div>
                </div>
                <div class="text-3xl">📦</div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-yellow-500">
            <div class="flex justify-between items-start">
                <div>
                    <div class="text-sm text-gray-600 mb-1">En attente</div>
                    <div class="text-3xl font-bold text-yellow-600">{{ $commandesEnAttente }}</div>
                </div>
                <div class="text-3xl">⏳</div>
            </div>
            @if($commandesEnAttente > 0)
                <a href="{{ route('admin.commandes.index', ['status' => 'en_attente']) }}" 
                   class="text-xs text-primary-red hover:underline mt-2 inline-block">
                    Voir les commandes en attente →
                </a>
            @endif
        </div>
        
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <div class="text-sm text-gray-600 mb-1">Produits en ligne</div>
                    <div class="text-3xl font-bold text-blue-600">{{ $totalProduits }}</div>
                </div>
                <div class="text-3xl">🛍️</div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <div class="text-sm text-gray-600 mb-1">Chiffre d'affaires</div>
                    <div class="text-3xl font-bold text-green-600">{{ number_format($chiffreAffaires, 0, ',', ' ') }}</div>
                    <div class="text-xs text-gray-500">FCFA</div>
                </div>
                <div class="text-3xl">💰</div>
            </div>
        </div>
    </div>
    
    <!-- Graphiques rapides (statistiques supplémentaires) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="font-bold mb-2">📊 Répartition des commandes</h3>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-yellow-600">⏳ En attente</span>
                    <span class="font-bold">{{ $commandesEnAttente }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-green-600">✅ Validées</span>
                    <span class="font-bold">{{ \App\Models\Commande::where('statut', 'validee')->count() }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-blue-600">🚚 Livrées</span>
                    <span class="font-bold">{{ \App\Models\Commande::where('statut', 'livree')->count() }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-red-600">❌ Annulées</span>
                    <span class="font-bold">{{ \App\Models\Commande::where('statut', 'annulee')->count() }}</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="font-bold mb-2">👥 Clients</h3>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span>Total clients inscrits</span>
                    <span class="font-bold">{{ $totalClients }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span>Commandes ce mois</span>
                    <span class="font-bold">{{ \App\Models\Commande::whereMonth('created_at', now()->month)->count() }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span>CA du mois</span>
                    <span class="font-bold">{{ number_format(\App\Models\Commande::whereMonth('created_at', now()->month)->where('statut', '!=', 'annulee')->sum('total'), 0, ',', ' ') }} FCFA</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="font-bold mb-2">📈 Produits populaires</h3>
            <div class="space-y-2">
                @php
                    $topProducts = \App\Models\CommandeProduct::select('product_id')
                        ->selectRaw('SUM(quantite) as total_quantite')
                        ->groupBy('product_id')
                        ->orderByDesc('total_quantite')
                        ->take(5)
                        ->get();
                @endphp
                
                @forelse($topProducts as $item)
                    <div class="flex justify-between text-sm">
                        <span class="truncate">{{ $item->product->nom ?? 'Produit supprimé' }}</span>
                        <span class="font-bold">{{ $item->total_quantite }} vendus</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Aucune vente pour le moment</p>
                @endforelse
            </div>
        </div>
    </div>
    
<!-- Commandes récentes -->
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Commandes récentes</h2>
        <a href="{{ route('admin.commandes.index') }}" class="text-primary-red hover:underline text-sm">
            Voir toutes les commandes →
        </a>
    </div>
    
    <!-- Version Desktop (tableau) -->
    <div class="overflow-x-auto hidden md:block">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-medium">N°</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Client</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Téléphone</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Total</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Paiement</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Statut</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Date</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($commandesRecentes as $commande)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-bold">#{{ $commande->id }}</td>
                        <td class="px-4 py-3">
                            <span class="font-medium">{{ $commande->nom_complet }}</span>
                            @if($commande->user_id)
                                <span class="text-xs text-green-500 block">👤 Compte</span>
                            @else
                                <span class="text-xs text-gray-400 block">👥 Invité</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">{{ $commande->telephone }}</td>
                        <td class="px-4 py-3 font-bold">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                        <td class="px-4 py-3">
                            <span class="text-xs px-2 py-1 rounded {{ $commande->mode_paiement === 'livraison' ? 'bg-gray-100 text-gray-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $commande->mode_paiement === 'livraison' ? '💵 Cash' : '📱 Wave' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-xs {{ $commande->statut_badge }}">
                                @if($commande->statut === 'en_attente')
                                    ⏳ En attente
                                @elseif($commande->statut === 'validee')
                                    ✅ Validée
                                @elseif($commande->statut === 'livree')
                                    🚚 Livrée
                                @else
                                    ❌ Annulée
                                @endif
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div>{{ $commande->created_at->format('d/m/Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $commande->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.commandes.show', $commande->id) }}" 
                                   class="text-blue-500 hover:text-blue-700" title="Voir détails">
                                    👁️
                                </a>
                                
                                @if($commande->statut === 'en_attente')
                                    <form action="{{ route('admin.commandes.valider', $commande->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-500 hover:text-green-700" title="Valider">
                                            ✅
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                            <div class="text-4xl mb-2">📭</div>
                            <p>Aucune commande pour le moment</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Version Mobile (cartes) -->
    <div class="space-y-3 md:hidden">
        @forelse($commandesRecentes as $commande)
            <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors">
                <!-- En-tête de la carte -->
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-lg">#{{ $commande->id }}</span>
                            <span class="px-2 py-1 rounded text-xs {{ $commande->statut_badge }}">
                                @if($commande->statut === 'en_attente')
                                    ⏳ En attente
                                @elseif($commande->statut === 'validee')
                                    ✅ Validée
                                @elseif($commande->statut === 'livree')
                                    🚚 Livrée
                                @else
                                    ❌ Annulée
                                @endif
                            </span>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $commande->created_at->format('d/m/Y à H:i') }}
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-primary-red">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</div>
                        <span class="text-xs px-2 py-1 rounded {{ $commande->mode_paiement === 'livraison' ? 'bg-gray-100 text-gray-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $commande->mode_paiement === 'livraison' ? '💵 Cash' : '📱 Wave' }}
                        </span>
                    </div>
                </div>
                
                <!-- Infos client -->
                <div class="space-y-2 mb-3">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="font-medium text-sm">{{ $commande->nom_complet }}</span>
                        @if($commande->user_id)
                            <span class="text-xs text-green-500">(Compte)</span>
                        @else
                            <span class="text-xs text-gray-400">(Invité)</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="text-sm">{{ $commande->telephone }}</span>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex gap-2 pt-3 border-t">
                    <a href="{{ route('admin.commandes.show', $commande->id) }}" 
                       class="flex-1 text-center bg-blue-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-600 transition">
                        👁️ Détails
                    </a>
                    
                    @if($commande->statut === 'en_attente')
                        <form action="{{ route('admin.commandes.valider', $commande->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-green-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-green-600 transition">
                                ✅ Valider
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-8 text-gray-500">
                <div class="text-4xl mb-2">📭</div>
                <p>Aucune commande pour le moment</p>
            </div>
        @endforelse
    </div>
</div>
</div>
@endsection

@section('scripts')
<script>
// Vérifier les notifications non lues
fetch('{{ route("admin.notifications.unreadCount") }}')
    .then(response => response.json())
    .then(data => {
        if (data.count > 0) {
            const badge = document.getElementById('notif-badge');
            badge.textContent = data.count;
            badge.classList.remove('hidden');
        }
    });
</script>
@endsection