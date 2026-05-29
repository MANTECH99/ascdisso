<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandeProduct;
use App\Models\Notification;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PanierSession;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CommandeController extends Controller
{


    private function getCartId()
    {
        if (auth()->check()) {
            return 'user_' . auth()->id();
        }
        if (!session()->has('cart_id')) {
            session()->put('cart_id', 'guest_' . Str::uuid());
        }
        return session()->get('cart_id');
    }

    private function getCart()
    {
        $panierSession = PanierSession::find($this->getCartId());
        return $panierSession ? $panierSession->data : [];
    }

    private function saveCart($cart)
    {
        PanierSession::updateOrCreate(
            ['id' => $this->getCartId()],
            [
                'user_id' => auth()->id(),
                'data' => $cart,
            ]
        );
    }


    public function index()
    {
        $cart = $this->getCart();  // ← Plus de session()
        $cartItems = [];
        $total = 0;

        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $subtotal = $product->prix * $details['quantity'];
                $total += $subtotal;
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $details['quantity'],
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('commandes.index', compact('cartItems', 'total'));
    }

    public function checkout()
    {
        $cart = $this->getCart();  // ← Plus de session()
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $cartItems = [];
        $total = 0;

        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $subtotal = $product->prix * $details['quantity'];
                $total += $subtotal;
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $details['quantity'],
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'adresse' => 'required|string|max:500',
            'telephone' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $cleaned = str_replace(' ', '', $value);
                    if (!preg_match('/^(77|78|76|70|75|33)\d{7}$/', $cleaned)) {
                        $fail('Le numéro de téléphone doit être un numéro sénégalais valide.');
                    }
                },
            ],
            'mode_paiement' => 'required|in:livraison,wave,orange_money',  // ← AJOUTEZ orange_money ici
        ]);

        $cart = $this->getCart();  // ← Plus de session()

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        // Calculer les totaux
        $sousTotal = 0;
        $commandeProducts = [];

        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product && $product->stock >= $details['quantity']) {
                $subtotal = $product->prix * $details['quantity'];
                $sousTotal += $subtotal;
                $commandeProducts[] = [
                    'product' => $product,
                    'quantity' => $details['quantity'],
                    'prix_unitaire' => $product->prix,
                    'sous_total' => $subtotal,
                ];
            }
        }

        // Créer la commande
        $commande = Commande::create([
            'user_id' => Auth::id(),
            'cart_token' => $this->getCartId(),
            'nom_complet' => $request->nom_complet,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'mode_paiement' => $request->mode_paiement,
            'mode_livraison' => 'Domicile',
            'statut' => 'en_attente',
            'statut_paiement' => 'non_paye',
            'sous_total' => $sousTotal,
            'total' => $sousTotal,
        ]);

        // Enregistrer les produits de la commande
        foreach ($commandeProducts as $item) {
            CommandeProduct::create([
                'commande_id' => $commande->id,
                'product_id' => $item['product']->id,
                'quantite' => $item['quantity'],
                'prix_unitaire' => $item['prix_unitaire'],
                'sous_total' => $item['sous_total'],
            ]);

            // Décrémenter le stock
            $item['product']->decrement('stock', $item['quantity']);
        }

        // Notifier les admins
        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'commande_id' => $commande->id,
                'message' => 'Nouvelle commande #' . $commande->id . ' de ' . $commande->nom_complet . ' - Total: ' . number_format($commande->total, 0) . ' FCFA',
            ]);
        }

                // Envoyer le reçu WhatsApp
        $this->sendWhatsAppReceipt($commande);

            // Si Wave, retourner JSON avec l'ID
        if ($request->mode_paiement === 'wave' || $request->mode_paiement === 'orange_money' || $request->expectsJson()) {
        return response()->json([
            'success' => true,
            'commande_id' => $commande->id,
            'message' => 'Commande créée'
        ]);
    }

        // Vider le panier
        // Vider le panier
        $panierSession = PanierSession::find($this->getCartId());
        if ($panierSession) {
            $panierSession->delete();
        }

        return redirect()->route('commande.recu', $commande->id);
    }

    public function recu($id)
    {
        $commande = Commande::with('commandeProducts.product')->findOrFail($id);
        $error = request()->query('error');
        return view('commande.recu', compact('commande', 'error'));
    }

    public function messages()
    {
        if (!Auth::check()) {
            return view('messages.not-connected');
        }

        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->paginate(20);

        // Marquer les notifications comme lues
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('messages.index', compact('notifications'));
    }


        public function unreadCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }
        
        $count = Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();
            
        return response()->json(['count' => $count]);
    }


private function sendWhatsAppReceipt($commande)
{
    $phone = '221' . substr(preg_replace('/[^0-9]/', '', $commande->telephone), -9);
    
    $payload = [
        'messaging_product' => 'whatsapp',
        'to' => $phone,
        'type' => 'template',
        'template' => [
            'name' => 'votre_ticket',
            'language' => ['code' => 'fr'],
            'components' => [
                [
                    'type' => 'body',
                    'parameters' => [
                        ['type' => 'text', 'text' => $commande->nom_complet],
                        ['type' => 'text', 'text' => '#' . str_pad($commande->id, 6, '0', STR_PAD_LEFT)],
                        ['type' => 'text', 'text' => number_format($commande->total, 0, ',', ' ')]
                    ]
                ],
                [
                    'type' => 'button',
                    'sub_type' => 'url',
                    'index' => '0',
                    'parameters' => [
                        ['type' => 'text', 'text' => 'commande/recu/' . $commande->id]
                    ]
                ]
            ]
        ]
    ];
    
    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.whatsapp.token'),
            'Content-Type' => 'application/json',
        ])->post('https://graph.facebook.com/v25.0/' . config('services.whatsapp.phone_number_id') . '/messages', $payload);
        
        Log::info('WhatsApp envoyé', ['commande' => $commande->id, 'response' => $response->json()]);
    } catch (\Exception $e) {
        Log::error('WhatsApp erreur: ' . $e->getMessage());
    }
}
}