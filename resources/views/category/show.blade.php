@extends('layouts.app')

@section('title', $category->nom . ' - ASC Disso | Achat en ligne Sénégal')
@section('meta_description', 'Découvrez notre sélection de ' . $category->nom . ' sur ASC Disso. Meilleurs prix, livraison rapide au Sénégal.')
@section('meta_keywords', $category->nom . ', acheter ' . $category->nom . ' Sénégal, ' . $category->nom . ' Dakar, ' . $category->nom . ' pas cher')
@section('canonical_url', route('category.show', $category->id))

@section('content')

@php
    $bannerImage = 'images/aas.png';
    if ($category->nom == 'Accessoires') {
        $bannerImage = 'images/accessoiress.png';
    } elseif ($category->nom == 'Maillot loisir') {
        $bannerImage = 'images/maillots.png';
    } elseif ($category->nom == 'Mode Homme') {
        $bannerImage = 'images/lacostes.png';
    }
@endphp

<!-- ========== DESKTOP LAYOUT ========== -->
<div class="hidden md:block">
    <div class="max-w-7xl mx-auto px-4 py-6">
        
        <!-- Bannière -->
        <div class="mb-6">
            <div class="w-full rounded-lg overflow-hidden shadow-sm">
                <img src="{{ asset($bannerImage) }}" 
                     alt="Bannière {{ $category->nom }}" 
                     class="w-full h-auto object-cover">
            </div>
        </div>
                                    <!-- Fil d'Ariane (Breadcrumb) avec défilement horizontal masqué -->
<nav class="flex items-center space-x-2 text-sm text-gray-500 mb-4 overflow-x-auto scrollbar-hide whitespace-nowrap">
    <a href="{{ route('home') }}" class="hover:text-primary-red text-lg transition flex-shrink-0">Accueil</a>
    <span class="flex-shrink-0">›</span>
    <span class="text-gray-800 text-lg font-medium flex-shrink-0">{{ $category->nom }}</span>
</nav>
        <!-- Grille Produits -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <p class="text-gray-600 mb-6">{{ $products->total() }} produit(s) trouvé(s)</p>
            
            <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                @forelse($products as $product)
                    <a href="{{ route('product.show', $product->slug) }}" class="group hover:shadow-md transition rounded-lg p-2 hover:bg-gray-50">
                        <div class="relative w-full h-44 rounded-2xl bg-gray-100 overflow-hidden mb-2">
                            <img src="{{ $product->first_image_url }}" 
                                 alt="{{ $product->nom }}" 
                                 class="w-full h-full object-contain group-hover:scale-105 transition duration-300">
                            @if($product->pourcentage_reduction)
                                <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                    -{{ $product->pourcentage_reduction }}%
                                </span>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-sm mt-2 truncate">{{ $product->nom }}</h3>
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
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Aucun produit dans cette catégorie pour le moment.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

<!-- ========== MOBILE ========== -->
<div class="container mx-auto px-4 py-6 md:hidden">
    
    <!-- Bannière -->
    <div class="mb-6">
        <div class="w-full rounded-lg overflow-hidden shadow-sm">
            <img src="{{ asset($bannerImage) }}" 
                 alt="Bannière {{ $category->nom }}" 
                 class="w-full h-auto object-cover">
        </div>
    </div>
                                        <!-- Fil d'Ariane (Breadcrumb) avec défilement horizontal masqué -->
<nav class="flex items-center space-x-2 text-sm text-gray-500 mb-4 overflow-x-auto scrollbar-hide whitespace-nowrap">
    <a href="{{ route('home') }}" class="hover:text-primary-red text-lg transition flex-shrink-0">Accueil</a>
    <span class="flex-shrink-0">›</span>
    <span class="text-gray-800 text-lg font-medium flex-shrink-0">{{ $category->nom }}</span>
</nav>
    <!-- Grille Produits -->
    <div class="bg-white rounded-lg shadow-sm p-2">
        <p class="text-gray-600 mb-4">{{ $products->total() }} produit(s) trouvé(s)</p>
        
        <div class="grid grid-cols-2 gap-2">
            @forelse($products as $product)
                <a href="{{ route('product.show', $product->slug) }}" class="group rounded-lg p-2 hover:shadow transition">
                    <div class="relative w-full h-44 rounded-2xl bg-gray-100 overflow-hidden mb-2">
                        <img src="{{ $product->first_image_url }}" 
                             alt="{{ $product->nom }}" 
                             class="w-full h-full object-contain group-hover:scale-105 transition duration-300">
                        @if($product->pourcentage_reduction)
                            <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                -{{ $product->pourcentage_reduction }}%
                            </span>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-sm mt-2 truncate">{{ $product->nom }}</h3>
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
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">Aucun produit dans cette catégorie pour le moment.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</div>

@endsection