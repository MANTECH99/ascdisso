@extends('layouts.app')


@section('title', $product->nom . ' - ASC Disso')
@section('meta_description', Str::limit(strip_tags($product->description), 160) . ' | Achetez ' . $product->nom . ' au meilleur prix sur ASC Disso. Prix: ' . number_format($product->prix, 0, ',', ' ') . ' FCFA.')
@section('meta_keywords', $product->nom . ', ' . $product->category->nom . ', acheter ' . $product->nom . ' Sénégal, ' . $product->nom . ' prix Dakar')
@section('canonical_url', route('product.show', $product->id))

@section('og_title', $product->nom . ' - ' . number_format($product->prix, 0, ',', ' ') . ' FCFA | ASC Disso')
@section('og_description', Str::limit(strip_tags($product->description), 160))
@section('og_image', asset('storage/' . $product->images->first()->image_path))
@section('og_url', route('product.show', $product->id))
@section('og_type', 'product')



@section('content')
@php
$productSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'Product',
    'name' => $product->nom,
    'description' => Str::limit(strip_tags($product->description), 200),
    'image' => asset('storage/' . $product->images->first()->image_path),
    'sku' => (string) $product->id,
    'brand' => [
        '@type' => 'Brand',
        'name' => "Boutique Officiel de l'ASC Disso"
    ],
    'offers' => [
        '@type' => 'Offer',
        'url' => route('product.show', $product->id),
        'priceCurrency' => 'XOF',
        'price' => (string) $product->prix,
        'priceValidUntil' => now()->addYear()->format('Y-m-d'),
        'availability' => $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
        'itemCondition' => 'https://schema.org/NewCondition',
        
        // Informations de livraison
        'shippingDetails' => [
            '@type' => 'OfferShippingDetails',
            'shippingRate' => [
                '@type' => 'MonetaryAmount',
                'value' => '0',
                'currency' => 'XOF'
            ],
            'shippingDestination' => [
                '@type' => 'DefinedRegion',
                'addressCountry' => 'SN'
            ],
            'deliveryTime' => [
                '@type' => 'ShippingDeliveryTime',
                'handlingTime' => [
                    '@type' => 'QuantitativeValue',
                    'minValue' => 0,
                    'maxValue' => 1,
                    'unitCode' => 'DAY'
                ],
                'transitTime' => [
                    '@type' => 'QuantitativeValue',
                    'minValue' => 1,
                    'maxValue' => 3,
                    'unitCode' => 'DAY'
                ]
            ]
        ],
        
        // Politique de retour
        'hasMerchantReturnPolicy' => [
            '@type' => 'MerchantReturnPolicy',
            'returnPolicyCategory' => 'https://schema.org/MerchantReturnFiniteReturnWindow',
            'merchantReturnDays' => 7,
            'returnMethod' => 'https://schema.org/ReturnInStore',
            'returnFees' => 'https://schema.org/FreeReturn'
        ]
    ]
];

// Ajout des notes et avis si le produit en a
if ($product->avis->count() > 0) {
    $productSchema['aggregateRating'] = [
        '@type' => 'AggregateRating',
        'ratingValue' => round($product->average_rating, 1),
        'reviewCount' => $product->avis->count()
    ];
    
    $productSchema['review'] = $product->avis->take(5)->map(function ($avi) {
        return [
            '@type' => 'Review',
            'author' => [
                '@type' => 'Person',
                'name' => $avi->user->prenom . ' ' . $avi->user->nom
            ],
            'datePublished' => $avi->created_at->toIso8601String(),
            'reviewBody' => $avi->commentaire ?? '',
            'reviewRating' => [
                '@type' => 'Rating',
                'ratingValue' => $avi->note,
                'bestRating' => 5,
                'worstRating' => 1
            ]
        ];
    })->values()->toArray();
}
@endphp

<script type="application/ld+json">
{!! json_encode($productSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
</script>
<div class="max-w-7xl mx-auto px-4 py-6">
<!-- Fil d'Ariane (Breadcrumb) avec défilement horizontal masqué -->
<nav class="flex items-center space-x-2 text-sm text-gray-500 mb-4 overflow-x-auto scrollbar-hide whitespace-nowrap">
    <a href="{{ route('home') }}" class="hover:text-primary-red transition flex-shrink-0">Accueil</a>
    <span class="flex-shrink-0">›</span>
    @if($product->category)
        <a href="{{ route('category.show', $product->category->slug) }}" class="hover:text-primary-red transition flex-shrink-0">{{ $product->category->nom }}</a>
        <span class="flex-shrink-0">›</span>
    @endif
    <span class="text-gray-800 font-medium flex-shrink-0">{{ $product->nom }}</span>
</nav>
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<!-- Remplacer la galerie images actuelle par celle-ci -->
<!-- Galerie images -->
<div>
    <div class="swiper-container product-gallery rounded-lg overflow-hidden mb-4 relative bg-gray-100">
        <div class="swiper-wrapper">
            @foreach($product->images as $image)
<div class="swiper-slide" style="display: flex !important; align-items: center !important; justify-content: center !important; height: 400px !important;">
    <img src="{{ asset('storage/' . $image->image_path) }}" 
         alt="{{ $product->nom }}" 
         class="max-w-full max-h-96 object-contain" 
         style="max-height: 380px; width: auto;">
</div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
    
    <!-- Miniatures -->
    <div class="grid grid-cols-5 gap-2">
        @foreach($product->images->take(5) as $index => $image)
            <img src="{{ asset('storage/' . $image->image_path) }}" 
                 alt="{{ $product->nom }}" 
                 onclick="goToSlide({{ $index }})"
                 class="w-full h-20 object-cover rounded cursor-pointer border-2 hover:border-primary-red transition miniature-img"
                 data-index="{{ $index }}">
        @endforeach
    </div>
</div>
            
            <!-- Infos produit -->
            <div>
                <!-- Badge Boutique officielle -->
                <span class="bg-blue-800 text-white px-3 py-1 rounded text-sm font-medium">
                    Boutique officielle de l'ASC Disso
                </span>
                
                <!-- Nom -->
                <h1 class="text-2xl  mt-4">{{ $product->nom }} <svg class="w-4 h-4 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20" style="color: #3b82f6;">
    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
</svg></h1>
                
                <!-- Prix -->
                <div class="mt-4">
                    <span class="text-xl font-bold text-red-500">
                        {{ number_format($product->prix, 0, ',', ' ') }} FCFA
                    </span>
                    @if($product->prix_barre)
                        <span class="text-gray-400 line-through text-xl ml-3">
                            {{ number_format($product->prix_barre, 0, ',', ' ') }}
                        </span>
                        <span class="bg-red-500 text-white px-2 py-1 rounded text-sm ml-2">
                            -{{ $product->pourcentage_reduction }}%
                        </span>
                    @endif
                </div>
                
                <!-- Notes des avis -->
                <div class="mt-4 flex items-center space-x-2">
                    <div class="flex text-yellow-400">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($product->average_rating))
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    <span class="text-sm text-gray-600">({{ $product->avis->count() }} avis)</span>
                </div>
                
                <!-- Stock -->
                <div class="mt-2">
                    @if($product->stock > 0)
                        <span class="text-green-600 text-sm">✅ En stock ({{ $product->stock }} disponibles)</span>
                    @else
                        <span class="text-red-600 text-sm">❌ Rupture de stock</span>
                    @endif
                </div>
                
<!-- Bouton J'achète -->
<div class="mt-6">
    @if($product->stock > 0)
        <button id="buy-button" class="w-full bg-red-500 text-white py-3 rounded-lg font-bold hover:bg-red-700 transition flex items-center justify-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
            </svg>
            <span>J'achète</span>
        </button>
        
        <div id="quantity-selector" class="hidden items-center justify-center space-x-4 mt-4">
            <button onclick="updateQuantity(-1)" 
                    class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center text-xl font-bold hover:border-red-500 transition">
                -
            </button>
            <span id="quantity-display" class="text-2xl font-bold w-12 text-center">0</span>
            <button onclick="updateQuantity(1)" 
                    class="w-10 h-10 rounded-full bg-red-500 text-white flex items-center justify-center text-xl font-bold hover:bg-red-700 transition">
                +
            </button>
        </div>
    @else
        <button class="w-full bg-gray-400 text-white py-3 rounded-lg font-bold cursor-not-allowed flex items-center justify-center space-x-2" disabled>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
            </svg>
            <span>Rupture de stock</span>
        </button>
    @endif
</div>
                
                <!-- Promotions et aide -->
                <div class="mt-6 border-t pt-4 space-y-4">
                    <!-- Promotions -->
                    <div>
                        <h3 class="font-bold text-md mb-2">🎁 Promotions</h3>
                        <p class="text-sm text-gray-600">
                            Prépayez avec Orange Money ou Wave dès 10 000 FCFA et bénéficiez de la livraison gratuite, en point relais, jusqu'à 5 000 FCFA offerts.
                        </p>
                    </div>
                    
                    <!-- Aide -->
                    <div>
                        <h3 class="font-bold text-sm mb-2">📞 Besoin d'aide pour commander ?</h3>
                        <p class="text-sm text-gray-600">
                            Appelez nous au <span class="font-bold text-primary-red">33 922 56 56</span> ou <span class="font-bold text-primary-red">30 102 21 21</span>
                        </p>
                    </div>
                    
                    <!-- Partage -->
                    <div>
                        <h3 class="font-bold text-sm mb-2">📤 Partagez ce produit</h3>
                        <div class="flex items-center space-x-3">
                            <!-- WhatsApp -->
                            <a href="https://wa.me/?text={{ urlencode($product->nom . ' - ' . route('product.show', $product->id)) }}" 
                               target="_blank" 
                               class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </a>
                            
                            <!-- Twitter / X -->
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($product->nom) }}&url={{ urlencode(route('product.show', $product->id)) }}" 
                               target="_blank" 
                               class="w-10 h-10 bg-black text-white rounded-full flex items-center justify-center hover:bg-gray-800 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                            </a>
                            
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('product.show', $product->id)) }}" 
                               target="_blank" 
                               class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>

                                                        <!-- Instagram -->
                            <a href="https://www.instagram.com/" 
                            target="_blank" 
                            class="w-10 h-10 bg-gradient-to-br from-purple-500 via-pink-500 to-orange-400 text-white rounded-full flex items-center justify-center hover:from-purple-600 hover:via-pink-600 hover:to-orange-500 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Description -->
        <div class="mt-8 border-t pt-6">
            <h2 class="text-xl font-bold mb-4 px-4 py-2 inline-block w-full" style="background-color: #D3D4D2;">Description</h2>
            <div class="prose max-w-none text-gray-700 mt-4">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
        
        <!-- Avis et commentaires -->
        <div class="mt-8 border-t pt-6">
            <h2 class="text-xl font-bold mb-4 px-4 py-2 inline-block w-full" style="background-color: #D3D4D2;">Commentaires des clients</h2>
            
            @auth
                <form action="{{ route('avis.store') }}" method="POST" class="bg-gray-50 p-4 rounded-lg mb-6 mt-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Votre note</label>
                        <div class="flex space-x-1" id="star-rating">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="setRating({{ $i }})" 
                                        class="text-3xl text-gray-300 hover:text-yellow-400 transition star-btn" 
                                        data-rating="{{ $i }}">★</button>
                            @endfor
                        </div>
                        <input type="hidden" name="note" id="rating-input" value="5">
                    </div>
                    
                    <div class="mb-4">
                        <textarea name="commentaire" rows="3" 
                                  class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-primary-red focus:border-transparent" 
                                  placeholder="Partagez votre expérience avec ce produit..."></textarea>
                    </div>
                    
                    <button type="submit" class="bg-primary-red text-white px-6 py-2 rounded-lg hover:bg-red-700 transition font-medium">
                        Publier mon avis
                    </button>
                </form>
            @else
                <div class="bg-gray-50 p-4 rounded-lg mb-6 mt-4 text-center">
                    <p class="text-gray-600">
                        <a href="{{ route('login') }}" class="text-primary-red hover:underline font-bold">Connectez-vous</a> 
                        pour laisser un avis.
                    </p>
                </div>
            @endauth
            
            <!-- Liste des avis -->
            <div class="space-y-4">
                @forelse($avis as $avi)
                    <div class="border-b pb-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="font-medium">{{ $avi->user->prenom }} {{ $avi->user->nom }}</span>
                                <div class="flex text-yellow-400 text-sm">
                                    @for($i = 1; $i <= 5; $i++)
                                        {{ $i <= $avi->note ? '★' : '☆' }}
                                    @endfor
                                </div>
                            </div>
                            <span class="text-sm text-gray-500">{{ $avi->created_at->diffForHumans() }}</span>
                        </div>
                        @if($avi->commentaire)
                            <p class="mt-2 text-gray-700">{{ $avi->commentaire }}</p>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500 text-center">Aucun avis pour le moment. Soyez le premier à donner votre avis !</p>
                @endforelse
            </div>
            
            {{ $avis->links() }}
        </div>
        
        <!-- Produits similaires -->
        @if($relatedProducts->count() > 0)
            <div class="mt-8 border-t pt-6">
                <h2 class="text-xl font-bold mb-4 px-4 py-2 inline-block w-full" style="background-color: #D3D4D2;">Produits similaires</h2>
                <div class="grid grid-cols-2 md:grid-cols-6 gap-4 mt-4">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('product.show', $related->slug) }}"
                           class="group bg-white border rounded-lg overflow-hidden hover:shadow-md transition">
<div class="relative w-full h-44 overflow-hidden">
    <img src="{{ $related->first_image_url }}" 
         alt="{{ $related->nom }}" 
         class="w-full h-full object-contain group-hover:scale-105 transition duration-300">
</div>
                            <div class="p-2">
                                <h3 class="text-sm font-medium truncate">{{ $related->nom }}</h3>
                                <span class="font-bold text-primary-red">{{ number_format($related->prix, 0, ',', ' ') }} FCFA</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
let quantity = 0;
var productGallery; // Déclarer en dehors


document.addEventListener('DOMContentLoaded', function() {
    productGallery = new Swiper('.product-gallery', {  // Retirer le "var" devant
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
    
    const buyButton = document.getElementById('buy-button');
    if (buyButton) {
        buyButton.addEventListener('click', function() {
            this.classList.add('hidden');
            document.getElementById('quantity-selector').classList.remove('hidden');
            document.getElementById('quantity-selector').classList.add('flex');
            quantity = 1;
            document.getElementById('quantity-display').textContent = quantity;
            addToCart();
        });
    }
    
    const ratingInput = document.getElementById('rating-input');
    if (ratingInput) {
        setRating(5);
    }
});

function updateQuantity(change) {
    quantity = Math.max(0, quantity + change);
    document.getElementById('quantity-display').textContent = quantity;
    
    if (quantity === 0) {
        document.getElementById('quantity-selector').classList.add('hidden');
        document.getElementById('quantity-selector').classList.remove('flex');
        document.getElementById('buy-button').classList.remove('hidden');
        updateCart(0);
    } else {
        updateCart(quantity);
    }
}

function addToCart() {
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            product_id: {{ $product->id }},
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.cartCount !== undefined) {
            document.querySelector('.cart-count').textContent = data.cartCount;
        }
    });
}

function updateCart(quantity) {
    fetch('/cart/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            product_id: {{ $product->id }},
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.cartCount !== undefined) {
            document.querySelector('.cart-count').textContent = data.cartCount;
        }
    });
}

function setRating(rating) {
    const ratingInput = document.getElementById('rating-input');
    if (ratingInput) {
        ratingInput.value = rating;
    }
    
    document.querySelectorAll('.star-btn').forEach((btn, index) => {
        if (index < rating) {
            btn.classList.add('text-yellow-400');
            btn.classList.remove('text-gray-300');
        } else {
            btn.classList.remove('text-yellow-400');
            btn.classList.add('text-gray-300');
        }
    });
}

// Fonction pour aller à un slide spécifique quand on clique sur une miniature
function goToSlide(index) {
    productGallery.slideToLoop(index);
    
    // Changer la bordure active
    document.querySelectorAll('.miniature-img').forEach(img => {
        img.classList.remove('border-primary-red');
        img.classList.add('border-transparent');
    });
    document.querySelector(`.miniature-img[data-index="${index}"]`).classList.add('border-primary-red');
}
</script>

<style>
.product-gallery .swiper-pagination {
    position: absolute !important;
    bottom: 10px !important;
    left: 0 !important;
    right: 0 !important;
    z-index: 10 !important;
}

.swiper-pagination-bullet {
    background: white !important;
    opacity: 0.7;
    width: 8px;
    height: 8px;
}

.swiper-pagination-bullet-active {
    background: #E81E25 !important;
    opacity: 1;
}

.cursor-pointer {
    transition: all 0.3s ease;
}

.cursor-pointer:hover {
    border-color: #E81E25 !important;
    transform: scale(1.05);
}
.product-gallery .swiper-slide {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.product-gallery .swiper-wrapper {
    align-items: center;
}

.product-gallery img {
    max-width: 100%;
    max-height: 380px;
    width: auto !important;
    height: auto !important;
    object-fit: contain !important;
}
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
@endsection