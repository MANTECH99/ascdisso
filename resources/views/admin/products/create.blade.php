@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-3xl">
    <h1 class="text-2xl font-bold mb-6">Nouveau produit</h1>
    
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" 
          class="bg-white rounded-lg shadow-sm p-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-2">Catégorie *</label>
                <select name="category_id" class="w-full border rounded-lg px-4 py-2 @error('category_id') border-red-500 @enderror" required>
                    <option value="">Sélectionner une catégorie</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nom }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Nom du produit *</label>
                <input type="text" name="nom" value="{{ old('nom') }}" 
                       class="w-full border rounded-lg px-4 py-2 @error('nom') border-red-500 @enderror" required>
                @error('nom')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Description</label>
            <textarea name="description" rows="5" 
                      class="w-full border rounded-lg px-4 py-2">{{ old('description') }}</textarea>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-2">Prix (FCFA) *</label>
                <input type="number" name="prix" value="{{ old('prix') }}" step="0.01" min="0"
                       class="w-full border rounded-lg px-4 py-2 @error('prix') border-red-500 @enderror" required>
                @error('prix')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Prix barré (FCFA)</label>
                <input type="number" name="prix_barre" value="{{ old('prix_barre') }}" step="0.01" min="0"
                       class="w-full border rounded-lg px-4 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">% Réduction</label>
                <input type="number" name="pourcentage_reduction" value="{{ old('pourcentage_reduction', 0) }}" min="0" max="99"
                       class="w-full border rounded-lg px-4 py-2">
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Stock *</label>
            <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0"
                   class="w-full border rounded-lg px-4 py-2 @error('stock') border-red-500 @enderror" required>
            @error('stock')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">
                Images du produit * <span class="text-red-500">(minimum 5 images)</span>
            </label>
            <input type="file" name="images[]" accept="image/*" multiple
                   class="w-full border rounded-lg px-4 py-2 @error('images') border-red-500 @enderror" required>
            <span class="text-xs text-gray-500">Vous pouvez sélectionner plusieurs images. Taille max : 2MB par image</span>
            @error('images')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.products.index') }}" 
               class="border border-gray-300 px-6 py-2 rounded-lg hover:bg-gray-50">
                Annuler
            </a>
            <button type="submit" class="btn-primary px-6 py-2 rounded-lg">
                Créer le produit
            </button>
        </div>
    </form>
</div>
@endsection