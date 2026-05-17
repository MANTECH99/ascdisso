@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">
    <h1 class="text-2xl font-bold mb-6">Modifier la bannière</h1>
    
    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" 
          class="bg-white rounded-lg shadow-sm p-6">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Image actuelle</label>
            <img src="{{ $banner->image_url }}" alt="Bannière" 
                 class="w-full h-48 object-cover rounded mb-2">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Changer l'image (optionnel)</label>
            <input type="file" name="image" accept="image/*" 
                   class="w-full border rounded-lg px-4 py-2">
            <span class="text-xs text-gray-500">Laissez vide pour garder l'image actuelle</span>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Ordre d'affichage</label>
            <input type="number" name="ordre" value="{{ old('ordre', $banner->ordre) }}" min="0"
                   class="w-full border rounded-lg px-4 py-2">
        </div>
        
        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" 
                       {{ $banner->is_active ? 'checked' : '' }} class="mr-2">
                <span class="text-sm">Bannière active</span>
            </label>
        </div>
        
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.banners.index') }}" 
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