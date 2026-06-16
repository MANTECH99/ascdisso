@extends('layouts.app')

@section('title', 'Contactez l\'ASC Disso | Club Football Mboro')
@section('meta_description', 'Contactez l\'ASC Disso facilement. Une question sur nos produits, le club ou les matchs ? Écrivez-nous, nous vous répondons rapidement.')
@section('meta_keywords', 'contact ASC Disso, contacter club Mboro, WhatsApp ASC Disso, email ASC Disso')
@section('canonical_url', route('contact'))

@section('og_title', 'Contactez l\'ASC Disso | Club Football Mboro')
@section('og_description', 'Une question ? Contactez l\'ASC Disso par téléphone, email ou WhatsApp.')
@section('og_image', asset('images/logo.png'))
@section('og_url', route('contact'))
@section('content')
<div class="bg-gradient-to-b from-gray-50 to-white min-h-screen">
    
<!-- Hero -->
<div class="relative py-16 overflow-hidden">
    <div class="absolute inset-0 bg-primary-dark">
<div class="absolute inset-0 opacity-20" style="background-image: url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?q=80&w=2072'); background-size: cover; background-position: center;"></div>
    </div>
    <div class="container mx-auto px-4 text-center relative z-10 text-white">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Contactez-nous</h1>
        <p class="text-xl opacity-75">Nous sommes à votre écoute</p>
    </div>
</div>

    <div class="container mx-auto px-4 py-12">
        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            
            <!-- Informations de contact -->
            <div class="md:col-span-1 space-y-6">
                <!-- Carte Contact -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-primary-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Adresse</h3>
                            <p class="text-gray-600 text-sm mt-1">Mboro, Sénégal<br>Quartier [Votre Quartier]</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Téléphone</h3>
                            <p class="text-gray-600 text-sm mt-1">
                                <a href="tel:+221339225656" class="hover:text-primary-red transition font-semibold">33 922 56 56</a>
                            </p>
                            <p class="text-xs text-gray-500 mt-2">Lun-Sam : 8h - 20h</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Email</h3>
                            <p class="text-gray-600 text-sm mt-1">
                                <a href="mailto:contact@ascdisso.sn" class="hover:text-primary-red transition">contact@ascdisso.sn</a>
                            </p>
                            <p class="text-xs text-gray-500 mt-2">Réponse sous 24h</p>
                        </div>
                    </div>
                </div>

                <!-- Réseaux sociaux -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-bold text-gray-800 mb-4">Suivez-nous</h3>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700 transition">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Formulaire de contact -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-xl shadow-sm p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Envoyez-nous un message</h2>
                    <p class="text-gray-600 mb-6">Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.</p>
                    
                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet *</label>
                                <input type="text" name="nom" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-red focus:border-transparent transition"
                                       placeholder="Votre nom">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                <input type="email" name="email" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-red focus:border-transparent transition"
                                       placeholder="votre@email.com">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                            <input type="tel" name="telephone"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-red focus:border-transparent transition"
                                   placeholder="77 000 00 00">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sujet *</label>
                            <select name="sujet" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-red focus:border-transparent transition">
                                <option value="">Sélectionnez un sujet</option>
                                <option value="commande">Question sur une commande</option>
                                <option value="produit">Information produit</option>
                                <option value="club">Renseignement sur le club</option>
                                <option value="partenariat">Partenariat / Sponsoring</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Message *</label>
                            <textarea name="message" rows="5" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-red focus:border-transparent transition"
                                      placeholder="Votre message..."></textarea>
                        </div>

                        <button type="submit" 
                                class="w-full bg-primary-red text-white font-semibold py-3 rounded-lg hover:bg-red-700 transition duration-300">
                            Envoyer le message
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- FAQ rapide -->
        <div class="max-w-4xl mx-auto mt-16">
            <h2 class="text-2xl font-bold text-center mb-8">Questions fréquentes</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-2">📦 Comment suivre ma commande ?</h3>
                    <p class="text-gray-600 text-sm">Connectez-vous à votre compte et allez dans "Mes commandes" pour suivre l'état de votre livraison.</p>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-2">💳 Quels modes de paiement acceptez-vous ?</h3>
                    <p class="text-gray-600 text-sm">Nous acceptons le paiement en espèces à la livraison et Wave.</p>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-2">🚚 Quels sont les délais de livraison ?</h3>
                    <p class="text-gray-600 text-sm">La livraison se fait sous 24-48h partout au Sénégal.</p>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-2">🔄 Puis-je retourner un article ?</h3>
                    <p class="text-gray-600 text-sm">Oui, vous avez 7 jours après réception pour retourner un article non utilisé.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection