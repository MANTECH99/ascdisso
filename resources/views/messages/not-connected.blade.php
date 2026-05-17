@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-md mx-auto  p-12 text-center">
        <div class="text-6xl mb-4">💬</div>
        <h2 class="text-xl font-bold mb-4">Messages</h2>
        <p class="text-gray-600 mb-6">
            Connectez-vous pour recevoir des messages de l'ASC Disso concernant le statut de vos commandes.
        </p>
        <a href="{{ route('login') }}" class="btn-primary px-8 py-3 rounded-lg inline-block">
            Se connecter
        </a>
        <p class="mt-4 text-sm text-gray-500">
            Pas encore de compte ? 
            <a href="{{ route('register') }}" class="text-primary-red hover:underline">Créer un compte</a>
        </p>
    </div>
</div>
@endsection