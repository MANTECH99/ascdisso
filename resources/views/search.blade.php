@extends('layouts.app')

@section('content')
<div class="container max-w-7xl mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Résultats pour "{{ $query }}"</h1>
        <p class="text-gray-600">{{ $products->total() }} produit(s) trouvé(s)</p>
    </div>
    
    @if($products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
            @foreach($products as $product)
<div class="bg-white border rounded-lg overflow-hidden hover:shadow-lg transition">
    <a href="{{ route('product.show', $product->id) }}">
        <div class="relative w-full h-44 rounded-2xl overflow-hidden mb-2">
            <img src="{{ $product->first_image_url }}" 
                 alt="{{ $product->nom }}" 
                 class="w-full h-full object-contain group-hover:scale-105 transition duration-300">
            @if($product->pourcentage_reduction)
                <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                    -{{ $product->pourcentage_reduction }}%
                </span>
            @endif
        </div>
        <div class="p-3">
            <span class="text-xs bg-red-100 text-primary-red px-2 py-1 rounded">Boutique officiel</span>
            <h3 class="font-medium text-sm mt-2 truncate">{{ $product->nom }}</h3>
            <span class="text-xs text-gray-500">{{ $product->category->nom }}</span>
            <div class="mt-2">
                <span class="font-bold text-lg">{{ number_format($product->prix, 0, ',', ' ') }} FCFA</span>
                @if($product->prix_barre)
                    <span class="text-gray-400 line-through text-sm ml-2">{{ number_format($product->prix_barre, 0, ',', ' ') }}</span>
                    <span class="text-primary-red text-xs ml-1">-{{ $product->pourcentage_reduction }}%</span>
                @endif
            </div>
        </div>
    </a>
</div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <div class="text-6xl mb-4">🔍</div>
            <p class="text-gray-600 mb-4">Aucun produit trouvé pour "{{ $query }}"</p>
            <a href="{{ route('home') }}" class="text-primary-red hover:underline">
                Retour à l'accueil
            </a>
        </div>
    @endif
</div>
@endsection