@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    @auth
        <h1 class="text-2xl font-bold mb-6">Mon compte</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Colonne de gauche : Infos personnelles -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-4 md:p-6">
                    <div class="text-center mb-4">
                        <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-3xl font-bold text-gray-500">{{ strtoupper(substr($user->prenom, 0, 1)) }}{{ strtoupper(substr($user->nom, 0, 1)) }}</span>
                        </div>
                        <h2 class="font-bold text-lg">{{ $user->prenom }} {{ $user->nom }}</h2>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </div>
                    
                    <div class="border-t pt-4 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Téléphone</span>
                            <span class="font-medium">{{ $user->telephone ?? 'Non renseigné' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Adresse</span>
                            <span class="font-medium text-right max-w-[150px] truncate">{{ $user->adresse ?? 'Non renseignée' }}</span>
                        </div>
                    </div>
                    
                    <form action="{{ route('logout') }}" method="POST" class="mt-4 pt-4 border-t">
                        @csrf
                        <button type="submit" class="w-full text-red-500 hover:text-red-700 font-medium text-sm text-center py-2 rounded-lg hover:bg-red-50 transition">
                            Se déconnecter
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Colonne de droite : Formulaire + Commandes -->
            <div class="md:col-span-2 space-y-6">
                <!-- Formulaire informations -->
                <div class="bg-white rounded-lg shadow-sm p-4 md:p-6">
                    <h2 class="text-lg md:text-xl font-bold mb-4">Modifier mes informations</h2>
                    
                    <form action="{{ route('account.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Prénom</label>
                                <input type="text" name="prenom" value="{{ old('prenom', $user->prenom) }}" 
                                       class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Nom</label>
                                <input type="text" name="nom" value="{{ old('nom', $user->nom) }}" 
                                       class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                   class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Téléphone (+221)</label>
                            <input type="text" name="telephone" value="{{ old('telephone', $user->telephone) }}" 
                                   class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Adresse</label>
                            <textarea name="adresse" rows="3" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent">{{ old('adresse', $user->adresse) }}</textarea>
                        </div>
                        
                        <button type="submit" class="w-full md:w-auto bg-red-500 text-white px-8 py-3 rounded-lg font-medium hover:bg-red-700 transition">
                            Mettre à jour
                        </button>
                    </form>
                </div>
                
                <!-- Commandes -->
                <div class="bg-white rounded-lg shadow-sm p-4 md:p-6">
                    <h2 class="text-lg md:text-xl font-bold mb-4">Mes dernières commandes</h2>
                    
                    @if($commandes->count() > 0)
                        <!-- Desktop -->
                        <div class="hidden md:block">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b-2 text-sm">
                                        <th class="text-left py-2">Commande</th>
                                        <th class="text-left py-2">Date</th>
                                        <th class="text-left py-2">Statut</th>
                                        <th class="text-right py-2">Total</th>
                                        <th class="text-right py-2"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($commandes as $commande)
                                        <tr class="border-b">
                                            <td class="py-3 font-medium">#{{ $commande->id }}</td>
                                            <td class="py-3 text-sm text-gray-500">{{ $commande->created_at->format('d/m/Y') }}</td>
                                            <td class="py-3">
                                                <span class="px-2 py-1 rounded text-xs {{ $commande->statut_badge }}">
                                                    {{ ucfirst($commande->statut) }}
                                                </span>
                                            </td>
                                            <td class="py-3 text-right font-bold">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                                            <td class="py-3 text-right">
                                                <a href="{{ route('commande.recu', $commande->id) }}" class="text-red-500 text-sm hover:underline">
                                                    Voir le reçu
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Mobile -->
                        <div class="md:hidden space-y-3">
                            @foreach($commandes as $commande)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <span class="font-bold">Commande #{{ $commande->id }}</span>
                                        <span class="px-2 py-1 rounded text-xs {{ $commande->statut_badge }}">
                                            {{ ucfirst($commande->statut) }}
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-500 mb-2">{{ $commande->created_at->format('d/m/Y') }}</div>
                                    <div class="flex justify-between items-center">
                                        <span class="font-bold text-red-500">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</span>
                                        <a href="{{ route('commande.recu', $commande->id) }}" class="text-red-500 text-sm hover:underline">
                                            Voir le reçu →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-4xl mb-3">📦</div>
                            <p class="text-gray-500">Aucune commande pour le moment.</p>
                            <a href="{{ route('home') }}" class="inline-block mt-3 text-red-500 hover:underline font-medium">
                                Découvrir nos produits
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-sm p-8 md:p-12 text-center mt-8">
            <div class="text-6xl mb-4">👤</div>
            <h2 class="text-xl font-bold mb-2">Connectez-vous à votre compte</h2>
            <p class="text-gray-500 mb-6">Accédez à vos informations personnelles et suivez vos commandes</p>
            <a href="{{ route('login') }}" class="bg-red-500 text-white px-8 py-3 rounded-lg font-medium hover:bg-red-700 transition inline-block">
                Se connecter
            </a>
            <p class="mt-4 text-sm text-gray-500">
                Pas encore de compte ? 
                <a href="{{ route('register') }}" class="text-red-500 hover:underline font-medium">S'inscrire</a>
            </p>
        </div>
    @endauth
</div>
@endsection