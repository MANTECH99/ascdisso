@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
<div class="flex justify-between items-center mb-6">
    <div class="flex items-center gap-4">
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
        <h1 class="text-2xl font-bold">Produits</h1>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn-primary px-4 py-2 rounded-lg">
        + Nouveau produit
    </a>
</div>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Version Desktop (tableau) -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden hidden md:block">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-medium">Image</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Nom</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Catégorie</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Prix</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Stock</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Avis</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <img src="{{ $product->first_image_url }}" alt="{{ $product->nom }}" 
                                 class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $product->nom }}</td>
                        <td class="px-4 py-3 text-sm">{{ $product->category->nom }}</td>
                        <td class="px-4 py-3">
                            <span class="font-bold">{{ number_format($product->prix, 0, ',', ' ') }} FCFA</span>
                            @if($product->prix_barre)
                                <br>
                                <span class="text-xs text-gray-400 line-through">
                                    {{ number_format($product->prix_barre, 0, ',', ' ') }}
                                </span>
                                <span class="text-xs text-primary-red">-{{ $product->pourcentage_reduction }}%</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($product->stock > 10)
                                <span class="text-green-600">{{ $product->stock }}</span>
                            @elseif($product->stock > 0)
                                <span class="text-yellow-600">{{ $product->stock }}</span>
                            @else
                                <span class="text-red-600">Rupture</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            ⭐ {{ number_format($product->average_rating, 1) }}
                            <br>
                            <span class="text-gray-500">({{ $product->avis->count() }})</span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" 
                                   class="text-blue-500 hover:text-blue-700">✏️</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" 
                                      method="POST" onsubmit="return confirm('Supprimer ce produit ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                            Aucun produit pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Version Mobile (cartes) -->
    <div class="space-y-4 md:hidden">
        @forelse($products as $product)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="flex p-4 gap-4">
                    <!-- Image -->
                    <div class="flex-shrink-0">
                        <img src="{{ $product->first_image_url }}" alt="{{ $product->nom }}" 
                             class="w-20 h-20 object-cover rounded-lg">
                    </div>
                    
                    <!-- Infos produit -->
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-bold text-gray-800">{{ $product->nom }}</h3>
                                <p class="text-xs text-gray-500 mt-1">{{ $product->category->nom }}</p>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" 
                                   class="text-blue-500 hover:text-blue-700 text-xl">✏️</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" 
                                      method="POST" onsubmit="return confirm('Supprimer ce produit ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xl">🗑️</button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="mt-2">
                            <div class="flex items-baseline gap-2">
                                <span class="font-bold text-primary-red">{{ number_format($product->prix, 0, ',', ' ') }} FCFA</span>
                                @if($product->prix_barre)
                                    <span class="text-xs text-gray-400 line-through">
                                        {{ number_format($product->prix_barre, 0, ',', ' ') }}
                                    </span>
                                    <span class="text-xs text-green-600">-{{ $product->pourcentage_reduction }}%</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center mt-3">
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-600">Stock:</span>
                                @if($product->stock > 10)
                                    <span class="text-green-600 font-medium">{{ $product->stock }}</span>
                                @elseif($product->stock > 0)
                                    <span class="text-yellow-600 font-medium">{{ $product->stock }}</span>
                                @else
                                    <span class="text-red-600 font-medium">Rupture</span>
                                @endif
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="text-yellow-500">⭐</span>
                                <span class="text-sm font-medium">{{ number_format($product->average_rating, 1) }}</span>
                                <span class="text-xs text-gray-500">({{ $product->avis->count() }})</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-sm p-8 text-center text-gray-500">
                Aucun produit pour le moment.
            </div>
        @endforelse
    </div>
    
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection