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
        <h1 class="text-2xl font-bold">Catégories</h1>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn-primary px-4 py-2 rounded-lg">
        + Nouvelle catégorie
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
                    <th class="px-6 py-3 text-left text-sm font-medium">Image</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Nom</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Ordre</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Produits</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Date</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <img src="{{ $category->image_url }}" alt="{{ $category->nom }}" 
                                 class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="px-6 py-4 font-medium">{{ $category->nom }}</td>
                        <td class="px-6 py-4">{{ $category->ordre }}</td>
                        <td class="px-6 py-4">{{ $category->products->count() }}</td>
                        <td class="px-6 py-4 text-sm">{{ $category->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                   class="text-blue-500 hover:text-blue-700">
                                   ✏️
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" 
                                      method="POST" onsubmit="return confirm('Supprimer cette catégorie ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            Aucune catégorie pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Version Mobile (cartes) -->
    <div class="space-y-4 md:hidden">
        @forelse($categories as $category)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="flex p-4 gap-4">
                    <!-- Image -->
                    <div class="flex-shrink-0">
                        <img src="{{ $category->image_url }}" alt="{{ $category->nom }}" 
                             class="w-16 h-16 object-cover rounded-lg">
                    </div>
                    
                    <!-- Infos catégorie -->
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg">{{ $category->nom }}</h3>
                            </div>
                            <div class="flex space-x-3">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                   class="text-blue-500 hover:text-blue-700 text-xl">
                                   ✏️
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" 
                                      method="POST" onsubmit="return confirm('Supprimer cette catégorie ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xl">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="mt-3 space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Ordre :</span>
                                <span class="font-medium">{{ $category->ordre }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Nombre de produits :</span>
                                <span class="font-medium text-blue-600">{{ $category->products->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Date d'ajout :</span>
                                <span class="text-sm">{{ $category->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-sm p-8 text-center text-gray-500">
                Aucune catégorie pour le moment.
            </div>
        @endforelse
    </div>
    
    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
@endsection