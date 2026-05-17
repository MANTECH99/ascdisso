<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PanierSession;  // ← AJOUTER
use Illuminate\Support\Str;     // ← AJOUTER

class CartController extends Controller
{


// Génère un ID unique pour le panier
private function getCartId()
{
    if (auth()->check()) {
        return 'user_' . auth()->id();  // Connecté → lié à l'utilisateur
    }
    if (!session()->has('cart_id')) {
        session()->put('cart_id', 'guest_' . Str::uuid());  // Invité → UUID
    }
    return session()->get('cart_id');
}

// Récupère le panier depuis la BDD
private function getCart()
{
    $panierSession = PanierSession::find($this->getCartId());
    return $panierSession ? $panierSession->data : [];
}

// Sauvegarde le panier en BDD
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
        $cart = $this->getCart();
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

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = $this->getCart();
        $quantity = $request->quantity ?? 1;

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'quantity' => $quantity
            ];
        }

        $this->saveCart($cart);

        $cartCount = array_sum(array_column($cart, 'quantity'));

        // Répondre en JSON si la requête le demande
        if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Produit ajouté au panier !',
                'cartCount' => $cartCount,
            ]);
        }

        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = $this->getCart();

        if ($request->quantity > 0) {

            $cart[$request->product_id] = [
                'quantity' => $request->quantity
            ];

        } else {

            unset($cart[$request->product_id]);

        }

         $this->saveCart($cart);

        $total = $this->calculateTotal($cart);
        $cartCount = array_sum(array_column($cart, 'quantity'));

        // Répondre en JSON si la requête le demande
        if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'total' => number_format($total, 2),
                'cartCount' => $cartCount,
            ]);
        }

        return redirect()->route('cart.index');
    }

    public function remove($productId)
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        $this->saveCart($cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier');
    }

    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $total += $product->prix * $details['quantity'];
            }
        }
        return $total;
    }

    public function getCartCount()
    {
        $cart = $this->getCart();
        $count = array_sum(array_column($cart, 'quantity'));
        return response()->json(['cartCount' => $count]);
    }
}