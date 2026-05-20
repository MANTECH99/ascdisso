@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full text-center">
        
        <!-- Icône -->
        <div class="relative w-20 h-20 mx-auto mb-6">
            <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-primary-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
            </div>
            <!-- Cadenas -->
            <div class="absolute -bottom-1 -right-1 w-7 h-7 bg-gray-800 rounded-full flex items-center justify-center shadow">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
        </div>
        
        <!-- Titre -->
        <h2 class="text-2xl font-bold text-gray-800 mb-3">Messages</h2>
        
        <!-- Description -->
        <p class="text-gray-500 mb-8 leading-relaxed">
            Connectez-vous pour recevoir des messages de l'ASC Disso concernant le statut de vos commandes.
        </p>
        
        <!-- Bouton -->
        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-primary-red text-white font-medium px-8 py-3.5 rounded-xl hover:bg-red-600 transition duration-300 shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Se connecter
        </a>
        
        <!-- Lien inscription -->
        <p class="mt-6 text-sm text-gray-500">
            Pas encore de compte ? 
            <a href="{{ route('register') }}" class="text-primary-red font-medium hover:underline">
                Créer un compte
            </a>
        </p>
    </div>
</div>
@endsection