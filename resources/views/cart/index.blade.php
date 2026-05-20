@extends('layouts.app')

@section('content')
<div class="container max-w-7xl mx-auto px-4 py-6">
    <div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800 relative inline-block">
Mon Panier
                <span class="absolute left-0 -bottom-2 w-1/2 h-1 bg-primary-red rounded-full"></span>
    </h1>
    </div>
    
    @if(count($cartItems) > 0)
        <!-- Version Desktop -->
        <div class="hidden md:block bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium">Image</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Nom</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Prix unitaire</th>
                        <th class="px-6 py-3 text-center text-sm font-medium">Quantité</th>
                        <th class="px-6 py-3 text-right text-sm font-medium">Total</th>
                        <th class="px-6 py-3 text-center text-sm font-medium">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr class="border-b">
                            <td class="px-6 py-4">
<img src="{{ $item['product']->first_image_url }}" 
    alt="{{ $item['product']->nom }}" 
    class="w-16 h-16 object-contain rounded">
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('product.show', $item['product']->slug) }}" class="hover:text-primary-red">
                                    {{ $item['product']->nom }}
                                </a>
                            </td>
                            <td class="px-6 py-4">{{ number_format($item['product']->prix, 0, ',', ' ') }} FCFA</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <button onclick="updateCartItem({{ $item['product']->id }}, {{ $item['quantity'] - 1 }})" 
                                            class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:border-primary-red">
                                        -
                                    </button>
                                    <span class="w-8 text-center">{{ $item['quantity'] }}</span>
                                    <button onclick="updateCartItem({{ $item['product']->id }}, {{ $item['quantity'] + 1 }})" 
                                            class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:border-primary-red">
                                        +
                                    </button>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right font-bold">
                                {{ number_format($item['subtotal'], 0, ',', ' ') }} FCFA
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="removeCartItem({{ $item['product']->id }})" 
                                        class="text-red-500 hover:text-red-700">
                                    🗑️
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Total Desktop -->
            <div class="flex justify-end p-6 bg-gray-50 border-t">
                <div class="text-right">
                    <span class="text-lg font-bold">Total : </span>
                    <span class="text-2xl font-bold text-primary-red">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                </div>
            </div>
            
            <!-- Boutons Desktop -->
            <div class="flex justify-between p-6">
                <a href="{{ route('home') }}" class="border border-gray-300 px-6 py-3 rounded-lg hover:bg-gray-50">
                    Continuer mes achats
                </a>
                <a href="{{ route('checkout') }}" class="btn-primary px-8 py-3 rounded-lg text-lg">
                    Passer la commande
                </a>
            </div>
        </div>

        <!-- Version Mobile -->
        <div class="md:hidden space-y-4">
            @foreach($cartItems as $item)
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <div class="flex space-x-4">
                        <!-- Image produit -->
<img src="{{ $item['product']->first_image_url }}" 
     alt="{{ $item['product']->nom }}" 
     class="w-24 h-24 object-contain rounded-lg flex-shrink-0">
                        
                        <!-- Infos produit -->
                        <div class="flex-1">
                            <a href="{{ route('product.show', $item['product']->slug) }}" 
                               class="font-medium text-sm line-clamp-2 hover:text-primary-red">
                                {{ $item['product']->nom }}
                            </a>
                            
                            <div class="mt-2 text-sm">
                                <span class="font-bold text-primary-red">
                                    {{ number_format($item['subtotal'], 0, ',', ' ') }} FCFA
                                </span>
                                @if($item['quantity'] > 1)
                                    <span class="text-gray-400 text-xs ml-2">
                                        ({{ number_format($item['product']->prix, 0, ',', ' ') }} FCFA/unité)
                                    </span>
                                    @else
                                    <span class="text-gray-400 line-through text-xs ml-2">
                                       {{ number_format($item['product']->prix_barre, 0, ',', ' ') }} FCFA
                                    </span>  
                                @endif
                            </div>
                            
                            <!-- Quantité + Supprimer -->
                            <div class="flex items-center justify-between mt-3">
                                <div class="flex items-center space-x-2">
                                    <button onclick="updateCartItem({{ $item['product']->id }}, {{ $item['quantity'] - 1 }})" 
                                            class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-sm hover:border-red-500">
                                        -
                                    </button>
                                    <span class="w-8 text-center text-sm font-medium">{{ $item['quantity'] }}</span>
                                    <button onclick="updateCartItem({{ $item['product']->id }}, {{ $item['quantity'] + 1 }})" 
                                            class="w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center text-sm hover:bg-red-700">
                                        +
                                    </button>
                                </div>
                                
                                <button onclick="removeCartItem({{ $item['product']->id }})" 
                                        class="text-gray-400 hover:text-red-500">
                                    🗑️
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
            <!-- Total Mobile -->
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold">Total</span>
                    <span class="text-xl font-bold text-primary-red">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                </div>
            </div>
            
            <!-- Boutons Mobile -->
            <div class="space-y-3">
                <a href="{{ route('checkout') }}" 
                   class="block w-full bg-red-500 text-white text-center py-3 rounded-lg font-bold text-lg hover:bg-red-700 transition">
                    Passer la commande
                </a>
                <a href="{{ route('home') }}" 
                   class="block w-full border border-gray-300 text-center py-3 rounded-lg hover:bg-gray-50 transition">
                    Continuer mes achats
                </a>
            </div>
        </div>
    @else
        <div class="   p-12 text-center">
            <div class="text-6xl mb-4">🛒</div>
            <h2 class="text-xl font-bold mb-2">Votre panier est vide</h2>
            <p class="text-gray-600 mb-6">Découvrez nos produits et ajoutez-les à votre panier</p>
            <a href="{{ route('home') }}" class="btn-primary px-8 py-3 rounded-lg">
                Voir les produits
            </a>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
function updateCartItem(productId, quantity) {
    fetch('/cart/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}

function removeCartItem(productId) {
    if (confirm('Voulez-vous retirer ce produit du panier ?')) {
        fetch('/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: 0
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}
</script>
@endsection