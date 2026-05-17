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
        <h1 class="text-2xl font-bold">Bannières</h1>
    </div>
    <a href="{{ route('admin.banners.create') }}" class="btn-primary px-4 py-2 rounded-lg">
        + Nouvelle bannière
    </a>
</div>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($banners as $banner)
                <div class="border rounded-lg overflow-hidden {{ $banner->is_active ? '' : 'opacity-50' }}">
                    <img src="{{ $banner->image_url }}" alt="Bannière {{ $banner->id }}" 
                         class="w-full h-48 object-cover">
                    <div class="p-3 flex justify-between items-center">
                        <div>
                            <span class="text-sm">Ordre : {{ $banner->ordre }}</span>
                            <br>
                            @if($banner->is_active)
                                <span class="text-xs text-green-600">✅ Active</span>
                            @else
                                <span class="text-xs text-red-600">❌ Inactive</span>
                            @endif
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.banners.edit', $banner->id) }}" 
                               class="text-blue-500 hover:text-blue-700">✏️</a>
                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" 
                                  method="POST" onsubmit="return confirm('Supprimer cette bannière ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">🗑️</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-8 text-gray-500">
                    Aucune bannière pour le moment.
                </div>
            @endforelse
        </div>
    </div>
    
    <div class="mt-4">
        {{ $banners->links() }}
    </div>
</div>
@endsection