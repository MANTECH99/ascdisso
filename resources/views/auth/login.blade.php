@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 md:py-12">
    <div class="max-w-md mx-auto">
        <!-- En-tête -->
        <div class="text-center mb-6">
            <div class="text-4xl mb-3">🔐</div>
            <h2 class="text-2xl font-bold">Connexion</h2>
            <p class="text-gray-500 text-sm mt-1">Connectez-vous pour accéder à votre compte</p>
        </div>
        
        <!-- Formulaire -->
        <div class="bg-white rounded-lg shadow-sm p-6 md:p-8">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="mb-5">
                    <label class="block text-sm font-medium mb-2">Numéro de téléphone</label>
                    <div class="flex items-center border rounded-lg overflow-hidden @error('telephone') border-red-500 @enderror">
                        <span class="px-4 py-3 bg-gray-100 text-sm font-medium">+221</span>
                        <input type="text" name="telephone" value="{{ old('telephone') }}" 
                               placeholder="77 234 56 87"
                               class="flex-1 px-4 py-3 border-0 focus:ring-0" required>
                    </div>
                    @error('telephone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label class="block text-sm font-medium mb-2">Mot de passe</label>
                    <input type="password" name="password" 
                           placeholder="Votre mot de passe"
                           class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent @error('password') border-red-500 @enderror" required>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mb-5 flex items-center justify-between">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" id="remember" class="mr-2 w-4 h-4 text-red-500 rounded">
                        <span class="text-sm">Se souvenir de moi</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-red-500 hover:underline">
                        Mot de passe oublié ?
                    </a>
                </div>
                
                <button type="submit" class="w-full bg-red-500 text-white py-3 rounded-lg font-bold text-lg hover:bg-red-700 transition">
                    Se connecter
                </button>
            </form>
        </div>
        
        <!-- Lien inscription -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                Pas encore de compte ? 
                <a href="{{ route('register') }}" class="text-red-500 hover:underline font-bold">
                    Créer un compte
                </a>
            </p>
        </div>
    </div>
</div>
@endsection