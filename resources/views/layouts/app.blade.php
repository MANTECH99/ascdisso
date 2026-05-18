<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!-- À ajouter juste après <meta charset="UTF-8"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Theme Color pour mobile -->
    <meta name="theme-color" content="#ff6b00">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="ASC Disso">
    
    <!-- SEO -->
    <title>@yield('title', 'ASC Disso - Boutique Officielle au Sénégal')</title>
    <meta name="description" content="@yield('meta_description', 'ASC Disso - Votre boutique en ligne de confiance au Sénégal. Maillot loisir, lacoste homme, accessoire joueur et plus. Livraison rapide partout au Sénégal.')">
    <meta name="keywords" content="@yield('meta_keywords', 'ASC Disso, boutique en ligne Sénégal, shopping Sénégal, acheter en ligne mboro, accessoires Sénégal, maillot Sénégal, e-commerce Sénégal')">
    <meta name="author" content="ASC Disso">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="@yield('og_title', 'ASC Disso - Boutique Officielle')">
    <meta property="og:description" content="@yield('og_description', 'Votre boutique en ligne de confiance au Sénégal')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta property="og:image:width" content="112">      <!-- 👈 AJOUTÉ -->
    <meta property="og:image:height" content="112">     <!-- 👈 AJOUTÉ -->
    <meta property="og:image:alt" content="Logo ASC Disso - Boutique Officielle"> <!-- 👈 AJOUTÉ -->
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ASC Disso">
    <meta property="og:locale" content="fr_SN">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'ASC Disso - Boutique Officielle')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Votre boutique en ligne de confiance au Sénégal')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/logo.png'))"> <!-- 👈 AJOUTÉ -->
    
    <!-- Favicons COMPLETS 👈 NOUVEAU -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}"> <!-- 👈 AJOUTÉ -->
    
    <!-- Fallback -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    <!-- Schema.org -->
    <script type="application/ld+json">
    @php
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'ASC Disso',
        'url' => url('/'),
        'description' => 'Boutique en ligne de confiance au Sénégal',
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => url('/search') . '?q={search_term_string}',
            'query-input' => 'required name=search_term_string'
        ]
    ];
    @endphp
    {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        :root {
            --primary-dark: #4D1111;
            --primary-red: #E81E25;
            --dark-bg: #181A1C;
            --light-gray: #D3D4D2;
            --white: #FFFFFF;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        
.header-top {
    background-color: var(--white);
    border-bottom: 2px solid #e5e7eb; /* Gris clair par exemple */
}
        
        .btn-primary {
            background-color: var(--primary-red);
            color: var(--white);
            transition: background-color 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #cc1a20;
        }
        
        .text-primary-dark {
            color: var(--primary-dark);
        }
        
        .text-primary-red {
            color: var(--primary-red);
        }
        
        .bg-primary-red {
            background-color: var(--primary-red);
        }
        
        .bg-dark-bg {
            background-color: var(--dark-bg);
        }
        
        .text-light-gray {
            color: var(--light-gray);
        }
        
        .navbar-mobile {
            background-color: var(--white);
            border-top: 2px solid #eee;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 50;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        }
        
        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: var(--primary-red);
            color: white;
            font-size: 0.75rem;
            border-radius: 50%;
            height: 1.25rem;
            width: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header-top shadow-sm sticky top-0 z-40">
<div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
@auth
    @if(Auth::user()->isAdmin())
        <!-- Logo pour admin -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.png') }}" alt="ASC Disso" class="h-10 w-10">
            <span class="text-2xl font-bold text-primary-dark">ASC Disso</span>
        </a>
    @else
        <!-- Logo pour utilisateur normal -->
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.png') }}" alt="ASC Disso" class="h-10 w-10">
            <span class="text-2xl font-bold text-primary-dark">ASC Disso</span>
        </a>
    @endif
@else
    <!-- Logo pour invité -->
    <a href="{{ route('home') }}" class="flex items-center space-x-2">
        <img src="{{ asset('images/logo.png') }}" alt="ASC Disso" class="h-10 w-10">
        <span class="text-2xl font-bold text-primary-dark">ASC Disso</span>
    </a>
@endauth
                
<!-- Search Bar (Desktop) -->
<div class="hidden md:flex flex-1 mx-8">
    <form action="{{ route('search') }}" method="GET" class="w-full">
        <div class="relative flex">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" name="q" 
                   placeholder="Cherchez un produit, une marque ou une catégorie"
                   class="w-full pl-10 pr-24 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red">
            <button type="submit" class="absolute right-1 top-1 bottom-1 px-4 bg-primary-red text-white rounded-r-md hover:bg-red-700 transition">
                Rechercher
            </button>
        </div>
    </form>
</div>
                
<!-- Icons -->
<div class="flex items-center space-x-4">
<span class="text-sm text-gray-700 hidden md:block whitespace-nowrap">
    Bonjour, <strong>{{ Auth::check() ? Auth::user()->nom_complet : 'Invité' }}</strong>
</span>

    <!-- Icône Messages Desktop -->
<a href="{{ route('messages') }}" class="flex items-center space-x-1 text-gray-700 hover:text-primary-red relative">
    <div class="relative">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
        </svg>
        <span id="desktop-message-badge" style="display:none; position:absolute; top:-8px; right:-8px; background-color:#E81E25; color:white; font-size:0.6rem; border-radius:50%; height:1rem; width:1rem; align-items:center; justify-content:center; font-weight:bold;"></span>
    </div>
    <span class="hidden md:inline text-sm">Messages</span>
</a>
    
    <a href="{{ Auth::check() ? route('account') : route('login') }}" class="flex items-center space-x-1 text-gray-700 hover:text-primary-red">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        <span class="hidden md:inline text-sm">Compte</span>
    </a>
    
<a href="{{ route('cart.index') }}" class="flex items-center space-x-3 text-gray-700 hover:text-primary-red">
    <div class="relative">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"></path>
        </svg>
        <span class="cart-count" id="header-cart-count">0</span>
    </div>
    <span class="hidden md:inline text-sm">Panier</span>
</a>
</div>
            </div>
            
<!-- Search Bar (Mobile) -->
<div class="mt-3 md:hidden">
    <form action="{{ route('search') }}" method="GET">
        <div class="relative flex">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" name="q" 
                   placeholder="cherchez sur ASC Disso"
                   class="w-full pl-10 pr-24 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-red">
            <button type="submit" class="absolute right-1 top-1 bottom-1 px-4 bg-primary-red text-white rounded-r-md hover:bg-red-700 transition">
                Rechercher
            </button>
        </div>
    </form>
</div>
        </div>
    </header>

    <!-- Messages de session -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative container mx-auto mt-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative container mx-auto mt-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Main Content -->
    <main class="pb-20 md:pb-0">
        @yield('content')
    </main>
<!-- Mobile Navigation -->
<nav class="navbar-mobile md:hidden">
    <div class="grid grid-cols-4 py-2">
        @auth
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center {{ request()->routeIs('admin.dashboard') ? 'text-primary-red' : 'text-gray-600' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="text-xs mt-1">Accueil</span>
                </a>
                <a href="{{ route('admin.commandes.index') }}" class="flex flex-col items-center {{ request()->routeIs('admin.commandes.*') ? 'text-primary-red' : 'text-gray-600' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="text-xs mt-1">Commandes</span>
                </a>
                <a href="{{ route('admin.notifications.index') }}" class="flex flex-col items-center {{ request()->routeIs('admin.notifications.*') ? 'text-primary-red' : 'text-gray-600' }} relative">
                    <div class="relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                        <span id="mobile-message-badge" style="display:none; position:absolute; top:-6px; right:-6px; background-color:#E81E25; color:white; font-size:0.6rem; border-radius:50%; height:1rem; width:1rem; align-items:center; justify-content:center; font-weight:bold;"></span>
                    </div>
                    <span class="text-xs mt-1">Messages</span>
                </a>
                <a href="{{ route('account') }}" class="flex flex-col items-center {{ request()->routeIs('account') ? 'text-primary-red' : 'text-gray-600' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="text-xs mt-1">Mon compte</span>
                </a>
            @else
                <a href="{{ route('home') }}" class="flex flex-col items-center {{ request()->routeIs('home') ? 'text-primary-red' : 'text-gray-600' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="text-xs mt-1">Accueil</span>
                </a>
                <a href="{{ route('cart.index') }}" class="flex flex-col items-center {{ request()->routeIs('cart.*') ? 'text-primary-red' : 'text-gray-600' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="text-xs mt-1">Commandes</span>
                </a>
                <a href="{{ route('messages') }}" class="flex flex-col items-center {{ request()->routeIs('messages') ? 'text-primary-red' : 'text-gray-600' }} relative">
                    <div class="relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                        <span id="mobile-message-badge" style="display:none; position:absolute; top:-6px; right:-6px; background-color:#E81E25; color:white; font-size:0.6rem; border-radius:50%; height:1rem; width:1rem; align-items:center; justify-content:center; font-weight:bold;"></span>
                    </div>
                    <span class="text-xs mt-1">Messages</span>
                </a>
                <a href="{{ route('account') }}" class="flex flex-col items-center {{ request()->routeIs('account') ? 'text-primary-red' : 'text-gray-600' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="text-xs mt-1">Mon compte</span>
                </a>
            @endif
        @else
            <a href="{{ route('home') }}" class="flex flex-col items-center {{ request()->routeIs('home') ? 'text-primary-red' : 'text-gray-600' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="text-xs mt-1">Accueil</span>
            </a>
            <a href="{{ route('cart.index') }}" class="flex flex-col items-center {{ request()->routeIs('cart.*') ? 'text-primary-red' : 'text-gray-600' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <span class="text-xs mt-1">Commandes</span>
            </a>
            <a href="{{ route('messages') }}" class="flex flex-col items-center {{ request()->routeIs('messages') ? 'text-primary-red' : 'text-gray-600' }} relative">
                <div class="relative">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    <span id="mobile-message-badge-guest" style="display:none; position:absolute; top:-6px; right:-6px; background-color:#E81E25; color:white; font-size:0.6rem; border-radius:50%; height:1rem; width:1rem; align-items:center; justify-content:center; font-weight:bold;"></span>
                </div>
                <span class="text-xs mt-1">Messages</span>
            </a>
            <a href="{{ route('login') }}" class="flex flex-col items-center {{ request()->routeIs('login') ? 'text-primary-red' : 'text-gray-600' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="text-xs mt-1">Connexion</span>
            </a>
        @endauth
    </div>
</nav>

<!-- Footer -->
<footer class="bg-dark-bg text-white mt-12 hidden md:block">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="ASC Disso" class="h-10 w-10">
                        <span class="text-xl font-bold text-primary-red">ASC Disso</span>
                    </div>
                    <p class="text-sm text-light-gray">Votre boutique en ligne de confiance au Sénégal</p>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4">Liens rapides</h4>
                    <ul class="space-y-2 text-sm text-light-gray">
                        <li><a href="{{ route('home') }}" class="hover:text-primary-red">Accueil</a></li>
                        <li><a href="#" class="hover:text-primary-red">Catégories</a></li>
                        <li><a href="#" class="hover:text-primary-red">Promotions</a></li>
                        <li><a href="#" class="hover:text-primary-red">Nouveautés</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4">Service Client</h4>
                    <ul class="space-y-2 text-sm text-light-gray">
                        <li>📞 33 922 56 56</li>
                        <li>📧 contact@ascdisso.sn</li>
                        <li>🕐 Lun-Sam: 8h-20h</li>
                        <li><a href="#" class="hover:text-primary-red">Centre d'assistance</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4">Newsletter</h4>
                    <form class="space-y-3">
                        <input type="email" placeholder="Votre email" class="w-full px-3 py-2 bg-gray-700 rounded text-white">
                        <button type="submit" class="btn-primary w-full py-2 rounded">S'abonner</button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-4 text-center text-sm text-light-gray">
                <p>&copy; {{ date('Y') }} ASC Disso. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
// Compteur panier au chargement
fetch('/cart/count', {
    headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
})
    .then(response => response.json())
    .then(data => {
        const cartCountElement = document.querySelector('.cart-count');
        if (cartCountElement && data.cartCount !== undefined) {
            cartCountElement.textContent = data.cartCount;
        }
    });

@auth
fetch('/messages/unread-count', {
    headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
})
    .then(response => response.json())
    .then(data => {
        console.log('Messages non lus:', data);
        
        // Mobile
        const mobileBadge = document.getElementById('mobile-message-badge');
        if (mobileBadge && data.count > 0) {
            mobileBadge.textContent = data.count;
            mobileBadge.style.display = 'flex';
        }
        
        // Desktop
        const desktopBadge = document.getElementById('desktop-message-badge');
        if (desktopBadge && data.count > 0) {
            desktopBadge.textContent = data.count;
            desktopBadge.style.display = 'flex';
        }
    })
    .catch(error => console.error('Erreur:', error));
@endauth
</script>
@yield('scripts')
</body>
</html>