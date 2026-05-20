@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 md:py-12">
    <div class="max-w-md mx-auto">
        <!-- En-tête -->
        <div class="text-center mb-6">
            <div class="text-4xl mb-3">🎉</div>
            <h2 class="text-2xl font-bold">Créer un compte</h2>
            <p class="text-gray-500 text-sm mt-1">Rejoignez-nous et commencez à commander</p>
        </div>
        
        <!-- Formulaire -->
        <div class="bg-white rounded-lg shadow-sm p-6 md:p-8">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Prénom</label>
                        <input type="text" name="prenom" value="{{ old('prenom') }}" 
                               placeholder="Votre prénom"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent @error('prenom') border-red-500 @enderror" required>
                        @error('prenom')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Nom</label>
                        <input type="text" name="nom" value="{{ old('nom') }}" 
                               placeholder="Votre nom"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent @error('nom') border-red-500 @enderror" required>
                        @error('nom')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                           placeholder="exemple@email.com"
                           class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent @error('email') border-red-500 @enderror" required>
                    @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Numéro de téléphone</label>
                    <div class="flex items-center border rounded-lg overflow-hidden @error('telephone') border-red-500 @enderror">
                        <span class="px-4 py-3 bg-gray-100 text-sm font-medium">+221</span>
                        <input type="text" name="telephone" value="{{ old('telephone') }}" 
                               placeholder="77 234 56 87"
                               class="flex-1 px-4 py-3 border-0 focus:ring-0" required>
                    </div>
                    <span class="text-xs text-gray-400 mt-1 block">Format : XX XXX XX XX</span>
                    @error('telephone')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Mot de passe</label>
                    <input type="password" name="password" 
                           placeholder="Minimum 8 caractères"
                           class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent @error('password') border-red-500 @enderror" required>
                    @error('password')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label class="block text-sm font-medium mb-2">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" 
                           placeholder="Répétez votre mot de passe"
                           class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent" required>
                </div>
                
                <button type="submit" class="w-full bg-primary-red text-white py-3 rounded-xl font-bold text-lg hover:bg-red-600 transition duration-300 shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
    </svg>
                    Créer mon compte
                </button>
            </form>
        </div>
        
        <!-- Lien connexion -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                Déjà un compte ? 
                <a href="{{ route('login') }}" class="text-red-500 hover:underline font-bold">
                    Se connecter
                </a>
            </p>
        </div>
    </div>
</div>
@endsection