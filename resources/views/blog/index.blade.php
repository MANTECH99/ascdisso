@extends('layouts.app')

@section('title', 'Blog - Actualités ASC Disso | Football Mboro')
@section('meta_description', 'Retrouvez toutes les actualités, articles et news de l\'ASC Disso. Matchs, événements, coulisses du club de football de Mboro.')
@section('meta_keywords', 'blog ASC Disso, actualités football Mboro, news ASC Disso, articles sportifs Sénégal')
@section('canonical_url', route('blog'))

@section('og_title', 'Blog - Actualités ASC Disso | Football Mboro')
@section('og_description', 'Toute l\'actualité de l\'ASC Disso : matchs, événements et coulisses du club.')
@section('og_image', asset('images/logo.png'))
@section('og_url', route('blog'))
@section('content')
<div class="bg-gray-50 min-h-screen">
    
<div class="relative py-16 overflow-hidden">
    <div class="absolute inset-0 bg-primary-dark">
        <div class="absolute inset-0 opacity-30" style="background-image: url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=2070'); background-size: cover; background-position: center;"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10 text-center text-white">
        <div class="flex items-center justify-center mb-4">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Blog ASC Disso</h1>
        <p class="text-xl opacity-75">Toute l'actualité de votre club</p>
    </div>
</div>

    <div class="container mx-auto px-4 py-12">
        
        <!-- Catégories -->
        <div class="flex flex-wrap gap-3 mb-10">
            <button class="px-5 py-2 bg-primary-red text-white rounded-full text-sm font-medium">Tout</button>
            <button class="px-5 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition">Matchs</button>
            <button class="px-5 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition">Événements</button>
        </div>

        <!-- Article vedette -->
        <div class="mb-12">
            <div class="relative rounded-2xl overflow-hidden h-64 md:h-96 cursor-pointer">
                <img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=1200" 
                     alt="Article vedette" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-60"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                    <span class="bg-primary-red text-white text-xs font-bold px-3 py-1 rounded-full">Matchs</span>
                    <h2 class="text-2xl md:text-3xl font-bold text-white mt-4 mb-2">Résumé du dernier match : Victoire éclatante de l'ASC Disso</h2>
                    <p class="text-white opacity-75 mb-4 hidden md:block">Retour sur la performance exceptionnelle de notre équipe ce weekend...</p>
                    <div class="flex items-center text-white text-sm opacity-60">
                        <span>15 Juin 2026</span>
                        <span class="mx-2">•</span>
                        <span>5 min de lecture</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grille d'articles -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <!-- Article 1 -->
            <article class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition cursor-pointer">
                <div class="h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=600" 
                         alt="Article" 
                         class="w-full h-full object-cover hover:scale-105 transition duration-500">
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">Club</span>
                        <span class="text-gray-400 text-xs">12 Juin 2026</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2 hover:text-primary-red transition">L'ASC Disso lance son centre de formation</h3>
                    <p class="text-gray-600 text-sm mb-4">Un nouveau centre pour former les talents de demain ouvre ses portes à Mboro...</p>
                    <a href="#" class="text-primary-red font-semibold text-sm hover:underline">Lire la suite →</a>
                </div>
            </article>

            <!-- Article 2 -->
            <article class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition cursor-pointer">
                <div class="h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1431324155629-1a6deb1dec8d?w=600" 
                         alt="Article" 
                         class="w-full h-full object-cover hover:scale-105 transition duration-500">
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">Boutique</span>
                        <span class="text-gray-400 text-xs">08 Juin 2026</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2 hover:text-primary-red transition">Nouveaux maillots disponibles !</h3>
                    <p class="text-gray-600 text-sm mb-4">Découvrez la nouvelle collection de maillots ASC Disso, disponible en boutique...</p>
                    <a href="#" class="text-primary-red font-semibold text-sm hover:underline">Lire la suite →</a>
                </div>
            </article>

<!-- Article 3 -->
<article class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition cursor-pointer">
    <div class="h-48 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?w=600" 
             alt="Tournoi des jeunes" 
             class="w-full h-full object-cover hover:scale-105 transition duration-500">
    </div>
    <div class="p-6">
        <div class="flex items-center space-x-2 mb-3">
            <span class="bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full">Événements</span>
            <span class="text-gray-400 text-xs">01 Juin 2026</span>
        </div>
        <h3 class="font-bold text-lg mb-2 hover:text-primary-red transition">Tournoi des jeunes : Inscriptions ouvertes</h3>
        <p class="text-gray-600 text-sm mb-4">Le tournoi annuel des jeunes talents aura lieu le mois prochain à Mboro...</p>
        <a href="#" class="text-primary-red font-semibold text-sm hover:underline">Lire la suite →</a>
    </div>
</article>
        </div>

        <!-- Newsletter -->
        <div class="bg-primary-dark rounded-2xl p-10 text-white text-center">
            <h2 class="text-3xl font-bold mb-4">Restez informé</h2>
            <p class="opacity-75 mb-6 max-w-xl mx-auto">Inscrivez-vous à notre newsletter pour ne rien rater de l'actualité de l'ASC Disso.</p>
            <form class="max-w-md mx-auto flex flex-col sm:flex-row gap-3">
                <input type="email" placeholder="Votre email" 
                       class="flex-1 px-4 py-3 rounded-lg text-gray-800 focus:outline-none">
                <button type="submit" class="bg-white text-primary-dark font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition">
                    S'abonner
                </button>
            </form>
        </div>


    </div>
</div>
@endsection