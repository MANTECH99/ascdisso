@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-lg mx-auto px-4">
        <!-- Carte principale style reçu -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            
            <!-- En-tête avec logo/bordure décorative -->
            <div class="bg-green-500 h-2"></div>
            
            <div class="p-6">
                <!-- Logo et succès -->
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Commande confirmée !</h2>
                    <p class="text-gray-500 text-sm mt-1">Merci pour votre commande</p>
                </div>

                <!-- Ligne séparatrice décorative -->
                <div class="border-t-2 border-dashed border-gray-200 my-6"></div>

                <!-- Informations commande -->
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">N° de commande</span>
                        <span class="font-bold text-gray-800">#{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Date</span>
                        <span class="font-medium text-sm">{{ $commande->created_at->format('d/m/Y à H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Statut</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ ucfirst($commande->statut) }}
                        </span>
                    </div>
                </div>

                <!-- Ligne séparatrice -->
                <div class="border-t border-gray-200 my-4"></div>

                <!-- Articles commandés -->
                <div class="space-y-4 mb-6">
                    <h3 class="font-bold text-gray-800 text-sm uppercase tracking-wide">Articles commandés</h3>
                    
                    @foreach($commande->commandeProducts as $item)
                    <div class="flex items-center space-x-3 py-2 border-b border-gray-100 last:border-0">
                        <!-- Image du produit centrée avec object-contain pour voir l'image entière -->
                        <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0 overflow-hidden p-1">
                            <img src="{{ $item->product->first_image_url }}" 
                                 alt="{{ $item->product->nom }}" 
                                 class="max-w-full max-h-full object-contain">
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 truncate">{{ $item->product->nom }}</p>
                            <p class="text-xs text-gray-500">{{ number_format($item->prix_unitaire, 0, ',', ' ') }} FCFA / unité</p>
                            <div class="flex items-center space-x-2 mt-1">
                                <span class="text-xs font-medium bg-gray-200 px-2 py-0.5 rounded">Qté: {{ $item->quantite }}</span>
                            </div>
                        </div>
                        
                        <div class="text-right flex-shrink-0">
                            <p class="text-sm font-bold text-gray-800">{{ number_format($item->sous_total, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Ligne séparatrice double -->
                <div class="border-t-2 border-double border-gray-200 my-4"></div>

                <!-- Résumé du paiement -->
                <div class="space-y-2 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 text-sm">Sous-total</span>
                        <span class="font-medium text-sm">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 text-sm">Livraison</span>
                        <span class="font-medium text-sm text-green-600">Gratuite</span>
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                        <span class="font-bold text-gray-800">Total</span>
                        <span class="text-xl font-bold text-red-500">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</span>
                    </div>
                </div>

                <!-- Ligne séparatrice décorative -->
                <div class="border-t-2 border-dashed border-gray-200 my-6"></div>

                <!-- Détails de livraison et paiement -->
                <div class="space-y-4 mb-6">
                    <!-- Adresse de livraison avec format nom/adresse/téléphone alignés -->
                    <div>
                        <h3 class="font-bold text-gray-800 text-sm uppercase tracking-wide mb-2">
                            📍 Adresse de livraison
                        </h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Nom :</span>
                                <span class="font-medium text-sm text-right">{{ $commande->nom_complet }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Adresse :</span>
                                <span class="text-sm text-gray-600 text-right max-w-[200px]">{{ $commande->adresse }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Téléphone :</span>
                                <span class="text-sm text-gray-600">+221 {{ $commande->telephone }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Mode de paiement et livraison (parallèle aux autres sections) -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Mode de paiement :</span>
                            <span class="font-medium text-sm">{{ $commande->mode_paiement === 'livraison' ? 'À la livraison' : 'Wave' }}</span>
                        </div>
                        <div class="border-t border-gray-200 my-2"></div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Statut paiement :</span>
                            <span class="font-medium text-sm {{ $commande->statut_paiement === 'paye' ? 'text-green-600' : 'text-orange-500' }}">
                                {{ $commande->statut_paiement === 'paye' ? 'Payé' : 'En attente' }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Mode de livraison -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Mode de livraison :</span>
                            <span class="font-medium text-sm">{{ $commande->mode_livraison }}</span>
                        </div>
                    </div>
                </div>

                <!-- Message de remerciement -->
                <div class="text-center text-xs text-gray-500 mb-6 p-3 bg-gray-50 rounded-lg">
                    <p>En cas de question, contactez notre service client</p>
                    <p class="font-medium">+221 76 616 69 56</p>
                </div>

                <!-- Boutons d'action -->
                <div class="space-y-3">
                    <a href="{{ route('commandes.index') }}" 
                       class="block w-full bg-red-500 text-white text-center py-3 px-4 rounded-lg font-medium hover:bg-red-600 transition-colors duration-200 text-sm">
                        Voir mes commandes
                    </a>
                    <a href="{{ route('home') }}" 
                       class="block w-full border border-gray-300 text-gray-700 text-center py-3 px-4 rounded-lg font-medium hover:bg-gray-50 transition-colors duration-200 text-sm">
                        Retour à l'accueil
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6 text-xs text-gray-400">
            <p>ASC DISSO © {{ date('Y') }}</p>
            <p class="mt-1">Reçu généré le {{ now()->format('d/m/Y à H:i') }}</p>
        </div>
    </div>
</div>
@endsection