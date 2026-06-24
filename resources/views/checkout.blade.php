@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800 relative inline-block">
        Passer la commande        
        <span class="absolute left-0 -bottom-2 w-1/2 h-1 bg-primary-red rounded-full"></span>
    </h1>
</div>
    
    <form id="checkoutForm" action="{{ route('commande.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Colonne de gauche -->
            <div class="md:col-span-2 space-y-6">
                <!-- Coordonnées -->
                <div class="bg-white rounded-lg shadow-sm p-4 md:p-6">
                    <h2 class="text-lg md:text-xl font-bold mb-4">Coordonnées pour la livraison</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Nom complet *</label>
                            <input type="text" name="nom_complet" id="nom_complet"
                                   value="{{ old('nom_complet', Auth::check() ? Auth::user()->nom_complet : '') }}" 
                                   class="w-full border rounded-lg px-4 py-3" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Adresse de livraison *</label>
                            <textarea name="adresse" id="adresse" rows="1" 
                                      class="w-full border rounded-lg px-4 py-3" 
                                      required>{{ old('adresse', Auth::check() ? Auth::user()->adresse : '') }}</textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Numéro de téléphone (+221) *</label>
                            <div class="flex items-center border rounded-lg overflow-hidden">
                                <span class="px-4 py-3 bg-gray-100 text-sm font-medium">+221</span>
                                <input type="text" name="telephone" id="telephone"
                                       value="{{ old('telephone', Auth::check() ? Auth::user()->telephone : '') }}" 
                                       placeholder="77 234 56 87"
                                       class="flex-1 px-4 py-3 border-0 focus:ring-0" required>
                            </div>
                        </div>
                    </div>
                </div>
                
<!-- Paiement -->
<div class="bg-white rounded-lg shadow-sm p-4 md:p-6">
    <h2 class="text-lg md:text-xl font-bold mb-4">Mode de paiement</h2>
    
    <div class="space-y-3">
        <!-- Paiement à la livraison -->
        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition payment-option" data-method="livraison">
            <input type="radio" name="mode_paiement" value="livraison" checked class="mr-3 w-5 h-5 text-red-500">
            <div class="payment-method-icon" style=" width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                <img src="{{ asset('images/livr.png') }}" alt="Livraison" style="width: 35px; height: 35px; object-fit: contain;">
            </div>
            <div class="flex-1">
                <span class="font-medium block">Paiement à la livraison</span>
                <p class="text-sm text-gray-500">Payez en espèces</p>
            </div>
            <i class="fas fa-check-circle" style="font-size: 1.25rem; color: #e2e8f0;"></i>
        </label>
        
        <!-- Wave Option -->
        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition payment-option" data-method="wave">
            <input type="radio" name="mode_paiement" value="wave" class="mr-3 w-5 h-5 text-red-500">
            <div class="payment-method-icon" style="background-color: #1DC8FF; width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                <img src="{{ asset('images/waves.png') }}" alt="Wave" style="width: 35px; height: 35px; object-fit: contain;">
            </div>
            <div class="flex-1">
                <span class="font-medium block">Paiement Wave</span>
                <p class="text-sm text-gray-500">Payez avec Wave</p>
            </div>
            <i class="fas fa-check-circle" style="font-size: 1.25rem; color: #e2e8f0;"></i>
        </label>

        <!-- Orange Money Option -->
        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition payment-option" data-method="orange">
            <input type="radio" name="mode_paiement" value="orange_money" class="mr-3 w-5 h-5 text-red-500">
            <div class="payment-method-icon" style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                <img src="{{ asset('images/orange.png') }}" alt="Orange Money" style="width: 35px; height: 35px; object-fit: contain;">
            </div>
            <div class="flex-1">
                <span class="font-medium block">Orange Money</span>
                <p class="text-sm text-gray-500">Paiement mobile sécurisé</p>
            </div>
            <i class="fas fa-check-circle" style="font-size: 1.25rem; color: #e2e8f0;"></i>
        </label>
    </div>
</div>
                
                <!-- Bouton Mobile -->
                <button type="submit" id="submitBtnMobile" class="md:hidden w-full bg-primary-red text-white py-3 rounded-xl text-xl font-bold hover:bg-red-600 transition duration-300 shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                    Passer la commande
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16l4-4m0 0l-4-4m4 4H3m5 4v1a3 3 0 003 3h7a3 3 0 003-3V7a3 3 0 00-3-3h-7a3 3 0 00-3 3v1"/>
</svg>
                </button>
            </div>
            
            <!-- Colonne droite : Résumé -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-4 md:p-6 sticky top-4">
                    <h2 class="text-lg md:text-xl font-bold mb-4">Résumé</h2>
                    
                    <div class="space-y-3">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 truncate mr-2">{{ $item['product']->nom }} x{{ $item['quantity'] }}</span>
                                <span>{{ number_format($item['subtotal'], 0, ',', ' ') }} FCFA</span>
                            </div>
                        @endforeach
                    </div>
                    
<!-- Sous-total -->
<div class="flex justify-between text-sm mt-4 pt-4 border-t">
    <span class="text-gray-600">Sous-total</span>
    <span id="sousTotal">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
</div>

<!-- Frais de service (5%) - Affiché uniquement pour Wave et Orange Money -->
<div id="fraisBlock" class="flex justify-between text-sm mt-2 hidden">
    <span class="text-gray-600">Frais de service (5%)</span>
    <span id="fraisMontant">{{ number_format($total * 0.05, 0, ',', ' ') }} FCFA</span>
</div>

<!-- Total final -->
<div class="flex justify-between font-bold text-lg mt-4 pt-4 border-t">
    <span>Total</span>
    <span id="totalFinal" class="text-red-500">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
</div>
                    
                    <button type="submit" id="submitBtnDesktop" class="hidden md:block w-full bg-red-500 text-white py-4 rounded-lg text-lg font-bold hover:bg-red-700 transition mt-6">
                        Passer la commande
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Overlay Wave -->
<div id="waveOverlay" class="wave-redirect-overlay">
    <div class="wave-redirect-box">
        <div class="wave-icon-container">
            <img src="{{ asset('images/waves.png') }}" alt="Wave" style="width: 70px; height: 70px; object-fit: contain;">
        </div>
        <h3 class="wave-redirect-title">Redirection vers Wave</h3>
        <p class="wave-redirect-text">
            Vous allez être redirigé vers l'application Wave pour finaliser votre paiement en toute sécurité.
            <br><br>
            <small>Cette opération peut prendre quelques secondes...</small>
        </p>
        <div class="wave-redirect-spinner"></div>
    </div>
</div>

<!-- Overlay Orange Money -->
<div id="orangeOverlay" class="wave-redirect-overlay">
    <div class="wave-redirect-box">
        <div class="wave-icon-container" style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);">
            <img src="{{ asset('images/orange.png') }}" alt="Orange Money" style="width: 70px; height: 70px; object-fit: contain;">
        </div>
        <h3 class="wave-redirect-title">Paiement Orange Money</h3>
        <p class="wave-redirect-text">
            Nous initions votre paiement Orange Money...
            <br><br>
            <small>Vous allez recevoir une notification sur votre téléphone pour valider le paiement.</small>
        </p>
        <div class="wave-redirect-spinner" style="border-top-color: #f97316;"></div>
    </div>
</div>

<style>
/* Overlay Wave */
.wave-redirect-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.85);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 10000;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.wave-redirect-box {
    background: linear-gradient(135deg, #181A1C 0%, #1a2530 100%);
    border-radius: 20px;
    padding: 3rem;
    max-width: 500px;
    width: 90%;
    text-align: center;
    color: white;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.wave-icon-container {
    width: 100px;
    height: 100px;
    margin: 0 auto 2rem;
    background-color: #1DC8FF;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: pulse 2s infinite;
    box-shadow: 0 10px 30px rgba(29, 200, 255, 0.4);
}

.wave-redirect-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.wave-redirect-text {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.wave-redirect-spinner {
    width: 50px;
    height: 50px;
    border: 3px solid rgba(255, 255, 255, 0.2);
    border-top-color: #1DC8FF;
    border-radius: 50%;
    margin: 2rem auto 0;
    animation: spin 1s linear infinite;
}

@keyframes pulse {
    0% { transform: scale(1); box-shadow: 0 10px 30px rgba(29, 200, 255, 0.4); }
    50% { transform: scale(1.05); box-shadow: 0 15px 40px rgba(29, 200, 255, 0.6); }
    100% { transform: scale(1); box-shadow: 0 10px 30px rgba(29, 200, 255, 0.4); }
}
.wave-redirect-overlay.active {
    display: flex;
}

/* Payment option selection */
.payment-option.selected {
    border-color: #10b981 !important;
    background-color: #f0fdf4 !important;
}

.payment-option.selected .fa-check-circle {
    color: #10b981 !important;
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('checkoutForm');
    
    document.querySelectorAll('.payment-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
            this.classList.add('selected');

            const radio = this.querySelector('input[type="radio"]');
            if (radio) {
                radio.checked = true;
            }
        });
    });
    
    const defaultOption = document.querySelector('.payment-option[data-method="livraison"]');
    if (defaultOption) {
        defaultOption.classList.add('selected');
    }


    // Mise à jour des frais selon le mode de paiement
const fraisBlock = document.getElementById('fraisBlock');
const totalFinal = document.getElementById('totalFinal');
const sousTotal = {{ $total }};

function updateTotal(modePaiement) {
    if (modePaiement === 'wave' || modePaiement === 'orange_money') {
        fraisBlock.classList.remove('hidden');
        const frais = sousTotal * 0.05;
        totalFinal.textContent = new Intl.NumberFormat('fr-FR').format(sousTotal + frais) + ' FCFA';
    } else {
        fraisBlock.classList.add('hidden');
        totalFinal.textContent = new Intl.NumberFormat('fr-FR').format(sousTotal) + ' FCFA';
    }
}

// Écouter le clic sur chaque option de paiement
document.querySelectorAll('.payment-option').forEach(option => {
    option.addEventListener('click', function() {
        const radio = this.querySelector('input[type="radio"]');
        if (radio) {
            updateTotal(radio.value);
        }
    });
});

// Écouter aussi le change sur les radios (au cas où)
document.querySelectorAll('input[name="mode_paiement"]').forEach(radio => {
    radio.addEventListener('change', function() {
        updateTotal(this.value);
    });
});
    
    form.addEventListener('submit', function(e) {
        const modePaiement = document.querySelector('input[name="mode_paiement"]:checked').value;
        
        // Gestion Wave
        if (modePaiement === 'wave') {
            e.preventDefault();
            
            const phone = document.getElementById('telephone').value.replace(/\s/g, '');
            const cleanPhone = phone.replace(/\D/g, '');
            const last9 = cleanPhone.slice(-9);
            
            if (last9.length !== 9 || !/^(77|76|78|70)/.test(last9)) {
                alert('Pour Wave, veuillez entrer un numéro valide (77, 76, 78 ou 70)');
                return;
            }
            
            document.getElementById('waveOverlay').classList.add('active');
            
            const overlayTitle = document.querySelector('.wave-redirect-title');
            const overlayText = document.querySelector('.wave-redirect-text');
            const overlayIcon = document.querySelector('.wave-icon-container');
            
            overlayTitle.textContent = 'Redirection vers Wave';
            overlayText.innerHTML = 'Vous allez être redirigé vers l\'application Wave pour finaliser votre paiement.<br><br><small>Cette opération peut prendre quelques secondes...</small>';
            overlayIcon.style.background = '#1DC8FF';
            
            const formData = new FormData(form);
            
            fetch('/commande', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success && !data.commande_id) {
                    throw new Error(data.error || 'Erreur création commande');
                }
                
                const commandeId = data.commande_id;
                
                return fetch('/payment/initiate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        commande_id: commandeId,
                        customer_name: document.getElementById('nom_complet').value,
                        customer_phone: last9,
                        payment_method: 'wave'
                    })
                });
            })
            .then(response => response.json())
            .then(paymentData => {
                if (paymentData.success && paymentData.data && paymentData.data.payment_url) {
                    window.location.href = paymentData.data.payment_url;
                } else {
                    throw new Error(paymentData.message || 'Erreur de paiement');
                }
            })
            .catch(error => {
                document.getElementById('waveOverlay').classList.remove('active');
                
                let errorMessage = 'Une erreur est survenue lors du paiement.';
                
                if (error.message.includes('solde') || error.message.includes('insuffisant')) {
                    errorMessage = 'Votre solde Wave est insuffisant. Veuillez recharger votre compte.';
                } else if (error.message.includes('réseau') || error.message.includes('connexion')) {
                    errorMessage = 'Problème de connexion. Vérifiez votre connexion internet et réessayez.';
                } else if (error.message.includes('expiré')) {
                    errorMessage = 'La session de paiement a expiré. Veuillez réessayer.';
                }
                
                alert(errorMessage);
            });
        }
        
// Gestion Orange Money
else if (modePaiement === 'orange_money') {
    e.preventDefault();
    
    const phone = document.getElementById('telephone').value.replace(/\s/g, '');
    const cleanPhone = phone.replace(/\D/g, '');
    const last9 = cleanPhone.slice(-9);
    
    if (last9.length !== 9 || !/^(77|78)/.test(last9)) {
        alert('Pour Orange Money, veuillez entrer un numéro valide (77 ou 78)');
        return;
    }
    
    // Afficher l'overlay Orange Money
    document.getElementById('orangeOverlay').classList.add('active');
    
    const formData = new FormData(form);
    let commandeId;
    
    fetch('/commande', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success && !data.commande_id) {
            throw new Error(data.message || 'Erreur création commande');
        }
        
        commandeId = data.commande_id;
        
        return fetch('/payment/initiate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                commande_id: commandeId,
                customer_name: document.getElementById('nom_complet').value,
                customer_phone: last9,
                description: 'Commande ASC Disso #' + commandeId,
                payment_method: 'orange_money'
            })
        });
    })
    .then(response => response.json())
    .then(paymentData => {
        if (paymentData.success) {
            window.location.href = '/commande/recu/' + paymentData.commande_id;
        } else {
            window.location.href = '/commande/recu/' + commandeId + '?error=' + encodeURIComponent(paymentData.message || 'Erreur de paiement');
        }
    })
    .catch(error => {
        window.location.href = '/commande/recu/' + commandeId + '?error=Service de paiement indisponible';
    });
}
    });
});
</script>
@endsection