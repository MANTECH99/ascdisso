@extends('layouts.app')


@section('title', 'ASC Disso - Boutique Officielle | Shopping en ligne au Sénégal')
@section('meta_description', 'Découvrez les meilleures offres sur ASC Disso. maillot loisir, lacoste, coque téléphone, bracelet et plus. Livraison rapide partout au Sénégal. Paiement Cash ou Wave.')
@section('meta_keywords', 'ASC Disso, shopping Sénégal, boutique mboro, acheter maillot Sénégal, lacoste homme Sénégal, vétement homme Sénégal, électronique Dakar')
@section('canonical_url', url('/'))

@section('og_title', 'ASC Disso - Boutique Officielle au Sénégal')
@section('og_description', 'Les meilleures offres shopping au Sénégal. Livraison rapide, paiement sécurisé.')
@section('og_image', asset('images/logo.png'))
@section('og_url', url('/'))

@section('content')

<!-- ========== DESKTOP LAYOUT ========== -->
<div class="hidden md:block">
    <div class="max-w-7xl mx-auto px-4 py-6">
        
        <!-- Rangée du haut : Sidebar + Bannière + Infos -->
        <div class="grid grid-cols-12 gap-4 mb-8">
            
<!-- Gauche : Sidebar Catégories -->
<div class="col-span-2">
    <div class="bg-white rounded-lg shadow-sm h-full" style="height: 350px;">
        <h3 class="font-bold text-lg p-4 border-b">Catégories</h3>
<div class="p-2 overflow-y-auto scrollbar-hide hover:scrollbar-default" style="height: calc(350px - 60px);">
    @foreach($categories->take(10) as $category)
        <a href="{{ route('category.show', $category->slug) }}" 
           class="flex items-center space-x-3 py-3   px-2 hover:bg-gray-50 rounded transition {{ !$loop->last ? 'border-b' : '' }}">
            <img src="{{ asset('storage/' . $category->image) }}" 
                 alt="{{ $category->nom }}"
                 class="w-8 h-8 object-cover rounded-full">
            <span class="text-sm truncate">{{ $category->nom }}</span>
        </a>
    @endforeach
</div>
    </div>
</div>
            
<!-- Centre : Bannière -->
<div class="col-span-8">
    <div class="swiper-container rounded-lg overflow-hidden" style="height: 350px; position: relative;">
        <div class="swiper-wrapper">
            @foreach($banners as $banner)
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $banner->image_path) }}" 
                         alt="Banner"
                         class="w-full h-full object-cover">
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination" style="position: absolute; bottom: 10px; left: 0; right: 0; z-index: 10;"></div>
    </div>
</div>
            
            <!-- Droite : Infos -->
            <div class="col-span-2 bg-white rounded-lg shadow-sm p-4 flex flex-col justify-center" style="height: 350px;">
                <div class="space-y-4">
                    <div class="text-center border-b pb-3">
                        <div class="text-2xl mb-2">🎧</div>
                        <h4 class="font-bold text-xs">Centre d'assistance</h4>
                        <p class="text-xs text-gray-600 mt-1">Guide du service client</p>
                    </div>
                    <div class="text-center border-b pb-3">
                        <div class="text-2xl mb-2">📞</div>
                        <h4 class="font-bold text-xs">Commandez au</h4>
                        <p class="text-red-500 font-bold text-sm mt-1">33 922 56 56</p>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl mb-2">🛍️</div>
                        <h4 class="font-bold text-xs">Achetez sur ASC Disso</h4>
                        <p class="text-xs text-gray-600 mt-1">Faites votre shop ici</p>
                    </div>
                </div>
            </div>
            
        </div>
        
       <!-- Grille Catégories -->
<div class="mb-8">
    <div class="flex items-center justify-between mb-4 px-6 py-2 w-full" style="background-color: #D3D4D2;">
        <h2 class="text-xl font-bold">Découvrez les offres de nos catégories</h2>
        <div class="flex items-center space-x-2">
            <span class="text-sm font-medium">Termine dans :</span>
            <div class="flex items-center space-x-1 bg-white px-3 py-1 rounded">
                <span id="hours-desktop" class="font-bold text-lg">20</span><span class="text-lg">h</span>
                <span class="text-lg">:</span>
                <span id="minutes-desktop" class="font-bold text-lg">24</span><span class="text-lg">m</span>
                <span class="text-lg">:</span>
                <span id="seconds-desktop" class="font-bold text-lg">25</span><span class="text-lg">s</span>
            </div>
        </div>
        <div class="flex items-center bg-primary-red text-white px-3 py-1 rounded">
            <span>⚡</span>
            <span class="font-bold text-sm ml-1">Vente Flash</span>
        </div>
    </div>
    <div class="grid grid-cols-6 gap-4">
        @foreach($categories as $category)
            <a href="{{ route('category.show', $category->slug) }}" 
               class="flex flex-col items-center hover:opacity-80 transition">
                <div class="w-full h-28 rounded-2xl overflow-hidden mb-2">
                    <img src="{{ asset('storage/' . $category->image) }}" 
                         alt="{{ $category->nom }}" 
                         class="w-full h-full object-cover">
                </div>
                <span class="text-xs font-medium text-center">{{ $category->nom }}</span>
            </a>
        @endforeach
    </div>
</div>

<!-- Bannière Promo Desktop -->
<div class="mb-8">
    <div class="w-full rounded-lg overflow-hidden shadow-sm">
        <img src="{{ asset('images/test.png') }}" 
             alt="Bannière promotionnelle" 
             class="w-full h-auto object-cover">
    </div>
</div>
        
<!-- Grille Produits -->
<div>
<div class="overflow-hidden mb-4" style="background-color: #D3D4D2;">
    <div class="animate-slide-left-right flex whitespace-nowrap" style="width: max-content;">
        <h2 class="text-xl text-center font-bold px-6 py-2 inline-block">
            Les meilleures offres et promotions avec livraison rapide
        </h2>
        <h2 class="text-xl text-center font-bold px-6 py-2 inline-block">
            Les meilleures offres et promotions avec livraison rapide
        </h2>
        <h2 class="text-xl text-center font-bold px-6 py-2 inline-block">
            Les meilleures offres et promotions avec livraison rapide
        </h2>
        <h2 class="text-xl text-center font-bold px-6 py-2 inline-block">
            Les meilleures offres et promotions avec livraison rapide
        </h2>
    </div>
</div>
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
            @foreach($products as $product)
                <a href="{{ route('product.show', $product->slug) }}" class="group hover:shadow-md transition rounded-lg p-2 hover:bg-gray-50">
<div class="relative w-full h-44 rounded-2xl bg-gray-100 overflow-hidden mb-2">
    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
         alt="{{ $product->nom }}" 
         class="w-full h-full object-contain group-hover:scale-105 transition duration-300">
    @if($product->pourcentage_reduction)
        <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
            -{{ $product->pourcentage_reduction }}%
        </span>
    @endif
</div>
                    <div>
                        
                        <h3 class=" text-sm mt-2 truncate">{{ $product->nom }}</h3>
                                        <!-- Notes des avis -->
                <div class="mt-3 flex items-center space-x-2">
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
<span class="text-green-600 text-sm flex items-center gap-1">
  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
  </svg>
  En stock
</span>
                    @else
                        <span class="text-red-600 text-sm">❌ Rupture de stock</span>
                    @endif
                </div>
                        <div class="mt-2">
                            <span class="font-bold text-lg">{{ number_format($product->prix, 0, ',', ' ') }} FCFA</span>
                            @if($product->prix_barre)
                                <span class="text-gray-400 line-through text-sm ml-2">{{ number_format($product->prix_barre, 0, ',', ' ') }}</span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
        
    </div>
</div>

<!-- ========== MOBILE ========== -->
<div class="container mx-auto px-4 py-6 md:hidden">
    
    <div class="mb-6">
        <div class="swiper-container rounded-lg overflow-hidden shadow-sm" style="position: relative;">
            <div class="swiper-wrapper">
                @foreach($banners as $banner)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner" class="w-full h-48 object-cover">
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination" style="bottom: 10px !important;"></div>
        </div>
    </div>
    
   <div class="mt-8">
    <div class="mb-4 px-4 py-2 w-full" style="background-color: #D3D4D2;">
        <h2 class="text-lg font-bold mb-2">Découvrez  notre collection dans</h2>
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-1">
                <span class="text-xs"></span>
                <div class="flex items-center space-x-1 bg-white px-2 py-1 rounded text-sm">
                    <span id="hours-mobile" class="font-bold">20</span><span>h</span>
                    <span>:</span>
                    <span id="minutes-mobile" class="font-bold">24</span><span>m</span>
                    <span>:</span>
                    <span id="seconds-mobile" class="font-bold">30</span><span>s</span>
                </div>
            </div>
            <div class="flex items-center bg-red-500 text-white px-2 py-1 rounded text-xs">
                <span>⚡</span>
                <span class="font-bold ml-1">Vente Flash</span>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4">
        @foreach($categories as $category)
            <a href="{{ route('category.show', $category->slug) }}" 
               class="flex flex-col items-center hover:opacity-80 transition">
                <div class="w-full h-20 rounded-2xl overflow-hidden mb-2">
                    <img src="{{ asset('storage/' . $category->image) }}" 
                         alt="{{ $category->nom }}" 
                         class="w-full h-full object-cover">
                </div>
                <span class="text-xs font-medium text-center">{{ $category->nom }}</span>
            </a>
        @endforeach
    </div>
</div>

<!-- Bannière Promo Mobile -->
<div class="mt-8">
    <div class="w-full rounded-lg overflow-hidden shadow-sm">
        <img src="{{ asset('images/test.png') }}" 
             alt="Bannière promotionnelle" 
             class="w-full h-auto object-cover">
    </div>
</div>
    
<div class="mt-8">
<div class="overflow-hidden" style="background-color: #D3D4D2;">
@php
    $mois = \Carbon\Carbon::now()->locale('fr')->translatedFormat('F');
@endphp

<div class="animate-slide-left-right flex whitespace-nowrap" style="width: max-content;">
    @for ($i = 0; $i < 4; $i++)
        <h2 class="text-xl font-bold px-4 py-2 inline-block">
            Les meilleures offres en {{ ucfirst($mois) }}
        </h2>
    @endfor
</div>
</div>
    <div class="bg-white rounded-b-lg shadow-sm p-2">
        <div class="grid grid-cols-2 gap-2">
            @foreach($products as $product)
                <a href="{{ route('product.show', $product->slug) }}" class="group  rounded-lg p-2 hover:shadow transition">
<div class="relative w-full h-44 rounded-2xl bg-gray-100 overflow-hidden mb-2">
    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
         alt="{{ $product->nom }}" 
         class="w-full h-full object-contain group-hover:scale-105 transition duration-300">
    @if($product->pourcentage_reduction)
        <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
            -{{ $product->pourcentage_reduction }}%
        </span>
    @endif
</div>
                    <div>

                        <h3 class=" text-sm mt-2 truncate">{{ $product->nom }}</h3>
                                                                <!-- Notes des avis -->
                <div class="mt-2 flex items-center space-x-2">
                    <div class="flex text-yellow-400">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($product->average_rating))
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    <span class="text-sm text-gray-600">avis</span>
                </div>
                                <!-- Stock -->
                <div class="mt-2">
                    @if($product->stock > 0)
<span class="text-green-600 text-sm flex items-center gap-1">
  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
  </svg>
  En stock
</span>
                    @else
                        <span class="text-red-600 text-sm">❌ Rupture de stock</span>
                    @endif
                </div>
                        <div class="mt-2">
                            <span class="font-bold text-lg">{{ number_format($product->prix, 0, ',', ' ') }} FCFA</span>
                            @if($product->prix_barre)
                                <span class="text-gray-400 line-through text-sm ml-2">{{ number_format($product->prix_barre, 0, ',', ' ') }}</span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
    
</div>
@endsection

@section('scripts')
<script>
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: {
            delay: 3000,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });




    // Compteur desktop
function startCountdownDesktop() {
    let hours = 20;
    let minutes = 24;
    let seconds = 30;
    
    setInterval(() => {
        if (seconds > 0) {
            seconds--;
        } else {
            if (minutes > 0) {
                minutes--;
                seconds = 59;
            } else {
                if (hours > 0) {
                    hours--;
                    minutes = 59;
                    seconds = 59;
                }
            }
        }
        
        document.getElementById('hours-desktop').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes-desktop').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds-desktop').textContent = seconds.toString().padStart(2, '0');
    }, 1000);
}

// Compteur mobile
function startCountdownMobile() {
    let hours = 20;
    let minutes = 24;
    let seconds = 30;
    
    setInterval(() => {
        if (seconds > 0) {
            seconds--;
        } else {
            if (minutes > 0) {
                minutes--;
                seconds = 59;
            } else {
                if (hours > 0) {
                    hours--;
                    minutes = 59;
                    seconds = 59;
                }
            }
        }
        
        document.getElementById('hours-mobile').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes-mobile').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds-mobile').textContent = seconds.toString().padStart(2, '0');
    }, 1000);
}

// Démarrer les compteurs
startCountdownDesktop();
startCountdownMobile();
</script>

<style>
.swiper-container .swiper-pagination {
    position: absolute !important;
    bottom: 10px !important;
    left: 0 !important;
    right: 0 !important;
    transform: none !important;
    text-align: center;
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

/* Masquer la scrollbar par défaut */
.scrollbar-hide::-webkit-scrollbar {
    width: 0px;
    background: transparent;
}

.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

/* Afficher la scrollbar au survol */
.scrollbar-hide:hover::-webkit-scrollbar {
    width: 6px;
}

.scrollbar-hide:hover::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.scrollbar-hide:hover::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

.scrollbar-hide:hover::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}

.scrollbar-hide:hover {
    -ms-overflow-style: auto;
    scrollbar-width: thin;
}

@keyframes slideLeftRight {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

.animate-slide-left-right {
    animation: slideLeftRight 10s linear infinite;
}
</style>
@endsection