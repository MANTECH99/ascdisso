@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">
    <h1 class="text-2xl font-bold mb-6">Nouvelle bannière</h1>
    
    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" 
          class="bg-white rounded-lg shadow-sm p-6">
        @csrf
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Image *</label>
            <input type="file" name="image" accept="image/*" 
                   class="w-full border rounded-lg px-4 py-2 @error('image') border-red-500 @enderror" required>
            <span class="text-xs text-gray-500">Taille recommandée : 1200x400 pixels</span>
            @error('image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Ordre d'affichage</label>
            <input type="number" name="ordre" value="{{ old('ordre', 0) }}" min="0"
                   class="w-full border rounded-lg px-4 py-2">
        </div>
        
        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }} class="mr-2">
                <span class="text-sm">Bannière active</span>
            </label>
        </div>
        
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.banners.index') }}" 
               class="border border-gray-300 px-6 py-2 rounded-lg hover:bg-gray-50">
                Annuler
            </a>
            <button type="submit" class="btn-primary px-6 py-2 rounded-lg">
                Créer la bannière
            </button>
        </div>
    </form>
</div>
@endsection