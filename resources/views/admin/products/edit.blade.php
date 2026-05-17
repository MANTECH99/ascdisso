@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-3xl">
    <h1 class="text-2xl font-bold mb-6">Modifier le produit</h1>
    
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" 
          class="bg-white rounded-lg shadow-sm p-6">
        @csrf
        @method('PUT')
        
        <!-- Images actuelles -->
        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">Images actuelles ({{ $product->images->count() }})</label>
            <div class="grid grid-cols-5 gap-2">
                @foreach($product->images as $image)
                    <div class="relative">
                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                             alt="{{ $product->nom }}" 
                             class="w-full h-24 object-cover rounded">
                        @if($product->images->count() > 5)
                            <form action="{{ route('admin.products.deleteImage', $image->id) }}" method="POST" class="absolute top-1 right-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs"
                                        onclick="return confirm('Supprimer cette image ?')">
                                    ×
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-2">Catégorie *</label>
                <select name="category_id" class="w-full border rounded-lg px-4 py-2" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Nom du produit *</label>
                <input type="text" name="nom" value="{{ old('nom', $product->nom) }}" 
                       class="w-full border rounded-lg px-4 py-2" required>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Description</label>
            <textarea name="description" rows="5" 
                      class="w-full border rounded-lg px-4 py-2">{{ old('description', $product->description) }}</textarea>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-2">Prix (FCFA) *</label>
                <input type="number" name="prix" value="{{ old('prix', $product->prix) }}" step="0.01" min="0"
                       class="w-full border rounded-lg px-4 py-2" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Prix barré (FCFA)</label>
                <input type="number" name="prix_barre" value="{{ old('prix_barre', $product->prix_barre) }}" step="0.01" min="0"
                       class="w-full border rounded-lg px-4 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">% Réduction</label>
                <input type="number" name="pourcentage_reduction" value="{{ old('pourcentage_reduction', $product->pourcentage_reduction) }}" min="0" max="99"
                       class="w-full border rounded-lg px-4 py-2">
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Stock *</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0"
                   class="w-full border rounded-lg px-4 py-2" required>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Ajouter des images supplémentaires</label>
            <input type="file" name="images[]" accept="image/*" multiple
                   class="w-full border rounded-lg px-4 py-2">
            <span class="text-xs text-gray-500">Laissez vide pour ne pas ajouter d'images</span>
        </div>
        
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.products.index') }}" 
               class="border border-gray-300 px-6 py-2 rounded-lg hover:bg-gray-50">
                Annuler
            </a>
            <button type="submit" class="btn-primary px-6 py-2 rounded-lg">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection