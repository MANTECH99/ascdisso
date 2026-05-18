@extends('layouts.app')

@section('title', $category->nom . ' - ASC Disso | Achat en ligne Sénégal')
@section('meta_description', 'Découvrez notre sélection de ' . $category->nom . ' sur ASC Disso. Meilleurs prix, livraison rapide au Sénégal.')
@section('meta_keywords', $category->nom . ', acheter ' . $category->nom . ' Sénégal, ' . $category->nom . ' Dakar, ' . $category->nom . ' pas cher')
@section('canonical_url', route('category.show', $category->id))

@section('content')
<div class="container max-w-7xl mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h1 class="text-2xl font-bold mb-2">{{ $category->nom }}</h1>
        <p class="text-gray-600 mb-6">{{ $products->total() }} produit(s) trouvé(s)</p>
        
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
            @forelse($products as $product)
                <div class="bg-white border rounded-lg overflow-hidden hover:shadow-lg transition">
                    <a href="{{ route('product.show', $product->slug) }}">
                        <img src="{{ $product->first_image_url }}" 
                        alt="{{ $product->nom }}" 
                        class="w-full h-40 object-contain bg-white p-2">
                        <div class="p-3">
                            <span class="text-xs bg-red-100 text-primary-red px-2 py-1 rounded">Boutique officiel</span>
                            <h3 class="font-medium text-sm mt-2 truncate">{{ $product->nom }}</h3>
                            <div class="mt-2">
                                <span class="font-bold text-lg">{{ number_format($product->prix, 0, ',', ' ') }} FCFA</span>
                                @if($product->prix_barre)
                                    <span class="text-gray-400 line-through text-sm ml-2">{{ number_format($product->prix_barre, 0, ',', ' ') }}</span>
                                    <span class="text-primary-red text-xs ml-1">-{{ $product->pourcentage_reduction }}%</span>
                                @endif
                            </div>
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-400 text-xs">
                                    @for($i = 1; $i <= 5; $i++)
                                        {{ $i <= round($product->average_rating) ? '★' : '☆' }}
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-500 ml-1">({{ $product->avis->count() }})</span>
                            </div>
                        </div>
                    </a>
                </div>
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