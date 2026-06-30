<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!-- À ajouter juste après <meta charset="UTF-8"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Theme Color pour mobile -->
    <meta name="theme-color" content="#ffff">
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
<link rel="manifest" href="{{ asset('images/site.webmanifest') }}">
    <!-- PWA -->
<link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

<style>

    /* --- CSS ONBOARDING STYLE "AC RESTAURANT" (SANS PASSER) --- */
.onboarding-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: #FFFFFF;
    z-index: 9999;
    display: none;
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    overflow-y: auto;
}

.onboarding-slide {
    display: none;
    flex-direction: column;
    height: 100dvh; /* <--- Utilisez 100dvh à la place */
    padding: 40px 30px 40px;
    box-sizing: border-box;
    text-align: center;
    justify-content: space-between;
}

.onboarding-slide.active {
    display: flex;
}

/* Grande illustration centrale */
.onboarding-illustration {
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 1;
    width: 100%;
    padding: 10px 0;
}

.onboarding-illustration img {
    width: 100%;
    max-width: 320px;
    height: auto;
    object-fit: contain;
    filter: drop-shadow(0 10px 20px rgba(0,0,0,0.05));
}

/* Contenu texte centré */
.onboarding-text {
    padding: 0 10px 30px 10px;
}

.onboarding-text h2 {
    font-size: 24px;
    font-weight: 800;
    color: #1f2937;
    margin: 0 0 10px 0;
    letter-spacing: -0.5px;
}

.onboarding-text p {
    font-size: 15px;
    color: #9ca3af;
    line-height: 1.6;
    margin: 0 auto;
    max-width: 280px;
}

/* Pagination (petits points) */
.onboarding-dots {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-bottom: 30px;
}

.onboarding-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #e5e7eb;
    transition: all 0.3s ease;
}

.onboarding-dot.active {
    background-color: #E81E25; /* Votre couleur de bouton */
}

/* Bouton large en bas */
.onboarding-btn-primary {
    width: 100%;
    padding: 18px;
    background-color: #E81E25; /* Vous pouvez changer #FF7F50 par votre rouge #E81E25 si vous préférez */
    color: white;
    border: none;
    border-radius: 16px;
    font-weight: 700;
    font-size: 16px;
    letter-spacing: 1px;
    cursor: pointer;
    box-shadow: 0 6px 15px rgba(255, 127, 80, 0.3);
    transition: transform 0.2s, box-shadow 0.2s;
}

.onboarding-btn-primary:active {
    transform: scale(0.97);
}
/* --- FIN CSS --- */




@media (display-mode: standalone) {
    .header-top { padding-top: env(safe-area-inset-top, 0px); }
    .navbar-mobile { padding-bottom: env(safe-area-inset-bottom, 0px); }
}
</style>
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

            /* 👇 AJOUTE CES CLASSES 👇 */
    .bg-primary-dark {
        background-color: #4D1111;
    }
    
    .bg-primary-red {
        background-color: #E81E25;
    }
    
    .text-primary-dark {
        color: #4D1111;
    }
    
    .text-primary-red {
        color: #E81E25;
    }
    
    .bg-dark-bg {
        background-color: #181A1C;
    }
    
    .text-light-gray {
        color: #D3D4D2;
    }
    
    .border-primary-red {
        border-color: #E81E25;
    }
    /* 👆 FIN DES AJOUTS 👆 */
    
    </style>
</head>
<body>

<!-- OVERLAY DE BIENVENUE -->
<div class="onboarding-overlay" id="onboarding-overlay">
    
    <!-- SLIDE 1 -->
    <div class="onboarding-slide active" id="slide-1">
        <div class="onboarding-illustration">
            <!-- 👇 METTEZ VOTRE IMAGE ICI 👇 -->
            <img src="{{ asset('images/ma_premiere_images.png') }}" alt="Découvrez ASC Disso">
        </div>
        <div class="onboarding-text">
            <h2>Bienvenue sur <strong>ASC Disso</strong></h2>
            <p>Votre boutique en ligne de confiance au Sénégal. Maillots, mode, accessoires et plus encore.</p>
        </div>
        <div class="onboarding-actions">
            <div class="onboarding-dots">
                <span class="onboarding-dot active"></span>
                <span class="onboarding-dot"></span>
                <span class="onboarding-dot"></span>
            </div>
            <button class="onboarding-btn-primary" onclick="nextSlide(1)">SUIVANT</button>
        </div>
    </div>

    <!-- SLIDE 2 -->
    <div class="onboarding-slide" id="slide-2">
        <div class="onboarding-illustration">
            <!-- 👇 METTEZ VOTRE IMAGE ICI 👇 -->
             <img src="{{ asset('images/ma_premiere_imagess.png') }}" alt="Découvrez ASC Disso">
        </div>
        <div class="onboarding-text">
            <h2>Livraison <strong>Express</strong></h2>
            <p>Recevez vos achats directement chez vous, en toute sécurité. Paiement Cash ou Wave.</p>
        </div>
        <div class="onboarding-actions">
            <div class="onboarding-dots">
                <span class="onboarding-dot"></span>
                <span class="onboarding-dot active"></span>
                <span class="onboarding-dot"></span>
            </div>
            <button class="onboarding-btn-primary" onclick="nextSlide(2)">SUIVANT</button>
        </div>
    </div>

    <!-- SLIDE 3 -->
    <div class="onboarding-slide" id="slide-3">
        <div class="onboarding-illustration">
            <!-- 👇 METTEZ VOTRE IMAGE ICI 👇 -->
            <img src="{{ asset('images/ma_premiere_imagessss.png') }}" alt="Découvrez ASC Disso">
        </div>
        <div class="onboarding-text">
            <h2>Le Shopping <strong>  Simplifié</strong></h2>
            <p>Des promotions exclusives et une équipe à votre écoute pour vous satisfaire.</p>
        </div>
        <div class="onboarding-actions">
            <div class="onboarding-dots">
                <span class="onboarding-dot"></span>
                <span class="onboarding-dot"></span>
                <span class="onboarding-dot active"></span>
            </div>
            <button class="onboarding-btn-primary" onclick="closeOnboarding()">COMMENCER</button>
        </div>
    </div>

</div>
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

    <!-- 👇 MENU DÉROULANT AU CLIC 👇 -->
    <div class="relative hidden md:block" id="dropdown-menu">
        <button onclick="toggleDropdown()" class="flex items-center text-gray-700 hover:text-primary-red focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        
        <div id="dropdown-content" class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl ring-1 ring-black ring-opacity-5 hidden z-50 py-2">
            <a href="{{ route('matchs') }}" class="flex items-center px-4 py-3 hover:bg-red-50 transition">
                <svg class="w-5 h-5 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm text-gray-700">Matchs</span>
            </a>
            
            <a href="{{ route('about') }}" class="flex items-center px-4 py-3 hover:bg-blue-50 transition">
                <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm text-gray-700">À propos</span>
            </a>
            
            <a href="{{ route('contact') }}" class="flex items-center px-4 py-3 hover:bg-purple-50 transition">
                <svg class="w-5 h-5 text-purple-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span class="text-sm text-gray-700">Contact</span>
            </a>
            
            <a href="{{ route('blog') }}" class="flex items-center px-4 py-3 hover:bg-green-50 transition">
                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <span class="text-sm text-gray-700">Blog</span>
            </a>
        </div>
    </div>
    <!-- 👆 FIN DU MENU DÉROULANT 👆 -->

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


    <!-- Icône Matchs (admin seulement) -->
    @auth
        @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.matchs.index') }}" class="flex items-center space-x-1 text-gray-700 hover:text-primary-red">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="hidden md:inline text-sm">Matchs</span>
            </a>
        @endif
    @endauth

    
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
    <div class="grid grid-cols-5 py-2">
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
                    <span class="text-xs mt-1">Compte</span>
                </a>
                <!-- Bouton Menu -->
                <button onclick="toggleMobileMenu()" class="flex flex-col items-center text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <span class="text-xs mt-1">Menu</span>
                </button>
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
                    <span class="text-xs mt-1">Compte</span>
                </a>
                <!-- Bouton Menu -->
                <button onclick="toggleMobileMenu()" class="flex flex-col items-center text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <span class="text-xs mt-1">Menu</span>
                </button>
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
            <!-- Bouton Menu -->
            <button onclick="toggleMobileMenu()" class="flex flex-col items-center text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <span class="text-xs mt-1">Menu</span>
            </button>
        @endauth
    </div>
</nav>

<!-- Menu Mobile Overlay -->
<div id="mobile-menu-overlay" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background-color:rgba(0,0,0,0.5); z-index:60;" onclick="toggleMobileMenu()">
    <div class="absolute bottom-16 left-0 right-0 bg-white rounded-t-2xl p-6" onclick="event.stopPropagation()">
        <div class="w-12 h-1 bg-gray-300 rounded-full mx-auto mb-6"></div>
        <div class="space-y-4">
            <a href="{{ route('matchs') }}" class="flex items-center space-x-4 p-4 rounded-lg hover:bg-gray-50 transition">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <span class="block font-semibold text-gray-800">Matchs</span>
                    <span class="text-sm text-gray-500">Résultats et calendrier de l'ASC</span>
                </div>
            </a>
            
            <a href="{{ route('about') }}" class="flex items-center space-x-4 p-4 rounded-lg hover:bg-gray-50 transition">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <span class="block font-semibold text-gray-800">À propos</span>
                    <span class="text-sm text-gray-500">Notre histoire et nos valeurs</span>
                </div>
            </a>
            
            <a href="{{ route('blog') }}" class="flex items-center space-x-4 p-4 rounded-lg hover:bg-gray-50 transition">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <div>
                    <span class="block font-semibold text-gray-800">Blog</span>
                    <span class="text-sm text-gray-500">Actualités et articles</span>
                </div>
            </a>
            
            <a href="{{ route('contact') }}" class="flex items-center space-x-4 p-4 rounded-lg hover:bg-gray-50 transition">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <span class="block font-semibold text-gray-800">Contact</span>
                    <span class="text-sm text-gray-500">Nous contacter</span>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark-bg text-white mt-12 hidden md:block">
    <div class="container max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="ASC Disso" class="h-10 w-10">
                    <span class="text-xl font-bold text-primary-red">ASC Disso</span>
                </div>
                <p class="text-sm text-light-gray">Votre boutique en ligne de confiance au Sénégal, située précisément à Mboro </p>
                <div class="mt-4">
                    <p class="text-sm font-medium mb-3">Suivez-nous :</p>
                    <div class="flex items-center space-x-3">
                        <a href="#" class="w-9 h-9 bg-gray-700 hover:bg-blue-600 rounded-full flex items-center justify-center transition duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-700 hover:bg-pink-600 rounded-full flex items-center justify-center transition duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-700 hover:bg-blue-500 rounded-full flex items-center justify-center transition duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-700 hover:bg-red-600 rounded-full flex items-center justify-center transition duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div>
                <h4 class="font-bold mb-4 relative inline-block">
                    Liens rapides
                    <span class="absolute left-0 -bottom-1 w-1/2 h-0.5 bg-primary-red rounded-full"></span>
                </h4>
                <ul class="space-y-2 text-sm text-light-gray mt-3">
                    <li><a href="{{ route('home') }}" class="hover:text-primary-red transition">Accueil</a></li>
                    <li><a href="#" class="hover:text-primary-red transition">Catégories</a></li>
                    <li><a href="#" class="hover:text-primary-red transition">Promotions</a></li>
                    <li><a href="#" class="hover:text-primary-red transition">Nouveautés</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-bold mb-4 relative inline-block">
                    Service Client
                    <span class="absolute left-0 -bottom-1 w-1/2 h-0.5 bg-primary-red rounded-full"></span>
                </h4>
                <ul class="space-y-2 text-sm text-light-gray mt-3">
                    <li>📞 33 922 56 56</li>
                    <li>📧 contact@ascdisso.sn</li>
                    <li>🕐 Lun-Sam: 8h-20h</li>
                    <li><a href="#" class="hover:text-primary-red transition">Centre d'assistance</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-bold mb-4 relative inline-block">
                    Newsletter
                    <span class="absolute left-0 -bottom-1 w-1/2 h-0.5 bg-primary-red rounded-full"></span>
                </h4>
                <form class="space-y-3 mt-3">
                    <input type="email" placeholder="Votre email" class="w-full px-3 py-2 bg-gray-700 rounded text-white">
                    <button type="submit" class="btn-primary w-full py-2 rounded">S'abonner</button>
                </form>
            </div>
        </div>
        
        <div class="border-t border-gray-700 mt-8 pt-4 text-center text-sm text-light-gray">
            <p>&copy; {{ date('Y') }} ASC Disso. Tous droits réservés. Develop by MAN_TECH.</p>
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

<script>
function toggleMobileMenu() {
    const overlay = document.getElementById('mobile-menu-overlay');
    if (overlay.style.display === 'none' || overlay.style.display === '') {
        overlay.style.display = 'block';
        document.body.style.overflow = 'hidden';
    } else {
        overlay.style.display = 'none';
        document.body.style.overflow = '';
    }
}


</script>
<script>
function toggleDropdown() {
    const dropdown = document.getElementById('dropdown-content');
    dropdown.classList.toggle('hidden');
}

// Fermer le dropdown si on clique ailleurs
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('dropdown-menu');
    const dropdownContent = document.getElementById('dropdown-content');
    
    if (!dropdown.contains(event.target)) {
        dropdownContent.classList.add('hidden');
    }
});
</script>

<script>
let deferredPrompt;
let pwaInstallButton;

function createInstallButton() {
    if (document.getElementById('pwa-install-button')) return;
    
    pwaInstallButton = document.createElement('button');
    pwaInstallButton.id = 'pwa-install-button';
    pwaInstallButton.innerHTML = `
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"></path>
            <polyline points="7 10 12 15 17 10"></polyline>
            <line x1="12" y1="15" x2="12" y2="3"></line>
        </svg>
        <span>Installer l'app</span>
    `;
    
    Object.assign(pwaInstallButton.style, {
        position: 'fixed', bottom: '90px', right: '20px', zIndex: '9999',
        background: '#E81E25', color: 'white', padding: '12px 24px',
        border: 'none', borderRadius: '50px',
        boxShadow: '0 4px 15px rgba(0,0,0,0.3)', cursor: 'pointer',
        display: 'none', alignItems: 'center', gap: '8px',
        fontWeight: 'bold', fontSize: '14px', fontFamily: 'inherit'
    });
    
    pwaInstallButton.onmouseover = () => { pwaInstallButton.style.transform = 'translateY(-2px)'; };
    pwaInstallButton.onmouseout = () => { pwaInstallButton.style.transform = 'translateY(0)'; };
    
    document.body.appendChild(pwaInstallButton);
}

window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    createInstallButton();
    if (pwaInstallButton) pwaInstallButton.style.display = 'flex';
});

document.addEventListener('click', async (e) => {
    if (e.target.closest('#pwa-install-button') && deferredPrompt) {
        deferredPrompt.prompt();
        await deferredPrompt.userChoice;
        deferredPrompt = null;
        if (pwaInstallButton) pwaInstallButton.style.display = 'none';
    }
});

window.addEventListener('appinstalled', () => {
    if (pwaInstallButton) pwaInstallButton.style.display = 'none';
});

if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/service-worker.js')
            .then(registration => {
                registration.addEventListener('updatefound', () => {
                    const newWorker = registration.installing;
                    newWorker.addEventListener('statechange', () => {
                        if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                            const updateBanner = document.createElement('div');
                            updateBanner.style.cssText = 'position:fixed;top:0;left:0;right:0;background:#E81E25;color:white;padding:12px;text-align:center;z-index:10000;font-weight:bold;';
                            updateBanner.innerHTML = 'Une nouvelle version est disponible ! <button onclick="window.location.reload()" style="background:white;color:#E81E25;border:none;padding:5px 15px;border-radius:20px;margin-left:10px;cursor:pointer;font-weight:bold;">Mettre à jour</button>';
                            document.body.prepend(updateBanner);
                        }
                    });
                });
            });
    });
}

// AJOUTE JUSTE ÇA 👇
window.addEventListener('online', () => document.body.classList.remove('offline'));
window.addEventListener('offline', () => document.body.classList.add('offline'));
</script>
@yield('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ne s'affiche que sur mobile et une seule fois par session
    const hasSeenOnboarding = sessionStorage.getItem('asc_onboarding_seen');
    if (window.innerWidth < 768 && !hasSeenOnboarding) {
        document.getElementById('onboarding-overlay').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
});

function nextSlide(currentIndex) {
    document.getElementById('slide-' + currentIndex).classList.remove('active');
    document.getElementById('slide-' + (currentIndex + 1)).classList.add('active');
}

function closeOnboarding() {
    document.getElementById('onboarding-overlay').style.display = 'none';
    document.body.style.overflow = '';
    sessionStorage.setItem('asc_onboarding_seen', 'true');
}
</script>
</body>
</html>