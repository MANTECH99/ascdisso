@extends('layouts.app')

@section('title', 'À propos de l\'ASC Disso - Notre Histoire | Club Football Mboro')
@section('meta_description', 'Découvrez l\'histoire de l\'ASC Disso, nouveau club de football des Navétanes de Mboro. Nos valeurs, notre mission et notre engagement pour la communauté.')
@section('meta_keywords', 'ASC Disso, à propos, histoire ASC Disso, club football Mboro, navétanes Sénégal, valeurs sportives')
@section('canonical_url', route('about'))

@section('og_title', 'À propos de l\'ASC Disso - Notre Histoire | Club Football Mboro')
@section('og_description', 'Découvrez l\'ASC Disso, club de football des Navétanes de Mboro. Notre histoire, nos valeurs et notre passion.')
@section('og_image', asset('images/logo.png'))
@section('og_url', route('about'))
@section('content')
<div class="bg-gray-50">
<!-- Hero Section avec image de fond -->
<div class="relative py-24 md:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-primary-dark">
        <div class="absolute inset-0 opacity-30" style="background-image: url('https://images.pexels.com/photos/114296/pexels-photo-114296.jpeg?auto=compress&cs=tinysrgb&w=1600'); background-size: cover; background-position: center;"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <div class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-white border-opacity-30">
                <img src="{{ asset('images/logo.png') }}" alt="ASC Disso" class="w-16 h-16">
            </div>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">À propos de l'ASC Disso</h1>
            <p class="text-xl text-white opacity-90">Plus qu'un club, une famille. Plus qu'un sport, une passion.</p>
        </div>
    </div>
</div>

<!-- Notre Histoire -->
<div class="container mx-auto px-4 py-16">
    <div class="grid md:grid-cols-2 gap-12 items-center">
        <div>
            <span class="text-primary-red font-semibold text-sm uppercase tracking-wider flex items-center">
                <span class="w-8 h-0.5 bg-primary-red mr-3"></span>Notre Histoire
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3 mb-6">
                Une nouvelle aventure, une grande ambition
            </h2>
            <div class="space-y-4 text-gray-600">
                <p class="leading-relaxed">
                    L'<strong>Association Sportive et Culturelle Disso</strong> est une toute jeune ASC 
                    qui vient de faire son entrée dans le championnat des <strong>Navétanes</strong> 
                    de la commune de <strong>Mboro</strong>.
                </p>
                <p class="leading-relaxed">
                    Portée par la passion et la détermination de jeunes de la localité, notre association 
                    est née de la volonté de créer un cadre d'épanouissement sportif et culturel pour 
                    la jeunesse de Mboro, tout en perpétuant l'esprit des Navétanes.
                </p>
                <p class="leading-relaxed">
                    Notre entrée dans cette compétition emblématique marque le début d'une belle aventure. 
                    Nous comptons sur le soutien de toute la communauté pour écrire ensemble 
                    les premières pages de notre histoire.
                </p>
            </div>

            <!-- Chiffres clés - mis à jour pour une nouvelle ASC -->
            <div class="grid grid-cols-3 gap-4 mt-8">
                <div class="text-center p-5 bg-red-50 rounded-xl border border-red-100">
                    <div class="text-3xl font-bold text-primary-red">2026</div>
                    <div class="text-sm text-gray-600 mt-1">Début aux Navétanes</div>
                </div>
                <div class="text-center p-5 bg-red-50 rounded-xl border border-red-100">
                    <div class="text-3xl font-bold text-primary-red">100+</div>
                    <div class="text-sm text-gray-600 mt-1">Jeunes engagés</div>
                </div>
                <div class="text-center p-5 bg-red-50 rounded-xl border border-red-100">
                    <div class="text-3xl font-bold text-primary-red">1</div>
                    <div class="text-sm text-gray-600 mt-1">Première saison</div>
                </div>
            </div>
        </div>

        <!-- Mission - adaptée pour une nouvelle ASC -->
        <div>
            <div class="relative rounded-2xl overflow-hidden shadow-xl">
                <div class="absolute inset-0">
                    <img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=800" 
                         alt="Mission" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-red-900 bg-opacity-90"></div>
                </div>
                
                <div class="relative p-8 text-white">
                    <h3 class="text-2xl font-bold mb-6 flex items-center">
                        <span class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3 text-xl">🎯</span>
                        Notre Mission
                    </h3>
                    <div class="space-y-5">
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Débuter avec détermination</p>
                                <p class="text-sm opacity-80">Faire nos premiers pas dans les Navétanes avec ambition</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Rassembler la jeunesse</p>
                                <p class="text-sm opacity-80">Créer une famille unie autour du football</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Progresser chaque jour</p>
                                <p class="text-sm opacity-80">Apprendre, grandir et viser plus haut</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Faire rayonner Mboro</p>
                                <p class="text-sm opacity-80">Porter fièrement les couleurs de notre communauté</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Citation -->
<div class="bg-gray-100 py-16">
    <div class="container mx-auto px-4 text-center">
        <svg class="w-10 h-10 text-primary-red mx-auto mb-4 opacity-30" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
        </svg>
        <p class="text-xl md:text-2xl text-gray-700 italic max-w-3xl mx-auto">
            "Le football n'est pas qu'un jeu, c'est un vecteur d'unité, de paix et de développement pour notre communauté."
        </p>
        <p class="text-primary-red font-semibold mt-4">— Le Président de l'ASC Disso —</p>
    </div>
</div>

    <!-- Nos Valeurs -->
    <div class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-primary-red font-semibold text-sm uppercase tracking-wider flex items-center justify-center">
                    <span class="w-8 h-0.5 bg-primary-red mr-3"></span>Nos Valeurs<span class="w-8 h-0.5 bg-primary-red ml-3"></span>
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">Ce qui nous définit</h2>
                <p class="text-gray-600 mt-2 max-w-xl mx-auto">Des principes qui guident chacune de nos actions</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">🏆</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Excellence</h3>
                    <p class="text-gray-600 text-sm">Nous visons l'excellence dans tout ce que nous entreprenons, sur et en dehors du terrain.</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">🤝</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Solidarité</h3>
                    <p class="text-gray-600 text-sm">L'union fait notre force. Nous soutenons chaque membre comme une famille.</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">🌱</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Formation</h3>
                    <p class="text-gray-600 text-sm">Nous investissons dans la formation des jeunes pour bâtir l'avenir du football sénégalais.</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">💪</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Dépassement</h3>
                    <p class="text-gray-600 text-sm">Nous repoussons nos limites pour atteindre des objectifs toujours plus ambitieux.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Notre Équipe -->
    <div class="container mx-auto px-4 py-16">
        <div class="text-center mb-12">
            <span class="text-primary-red font-semibold text-sm uppercase tracking-wider flex items-center justify-center">
                <span class="w-8 h-0.5 bg-primary-red mr-3"></span>Notre Équipe<span class="w-8 h-0.5 bg-primary-red ml-3"></span>
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">Les visages de l'ASC Disso</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
<div class="text-center">
    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden shadow-lg">
        <img src="{{ asset('images/president.jpeg') }}" alt="M. Bara Guissé" class="w-full h-full object-cover">
    </div>
    <h3 class="font-bold text-lg">Président</h3>
    <p class="text-primary-red font-medium">M. Bara Guissé</p>
    <p class="text-gray-500 text-sm mt-1">Parrain du club</p>
</div>

            <div class="text-center">
                <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden shadow-lg">
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="font-bold text-lg">Entraîneur</h3>
                <p class="text-primary-red font-medium">M. [Nom de l'Entraîneur]</p>
                <p class="text-gray-500 text-sm mt-1">Coach principal</p>
            </div>

            <div class="text-center">
                <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden shadow-lg">
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="font-bold text-lg">Capitaine</h3>
                <p class="text-primary-red font-medium">M. [Nom du Capitaine]</p>
                <p class="text-gray-500 text-sm mt-1">Leader sur le terrain</p>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-primary-dark text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Rejoignez l'aventure ASC Disso</h2>
            <p class="opacity-75 mb-8 max-w-2xl mx-auto text-lg">
                Soutenez votre équipe en achetant nos produits officiels. Chaque achat contribue au développement du club et de nos jeunes talents.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('home') }}" class="bg-white text-primary-dark px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                    🛍️ Découvrir la boutique
                </a>
<a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-gray-800 transition">
    📞 Nous contacter
</a>
            </div>
        </div>
    </div>

</div>
@endsection