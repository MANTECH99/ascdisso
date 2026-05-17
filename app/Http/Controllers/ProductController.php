<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with(['images', 'category'])->findOrFail($id);
        $avis = $product->avis()->with('user')->latest()->paginate(10);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->take(6)
            ->get();

        return view('product.show', compact('product', 'avis', 'relatedProducts'));
    }

    public function storeAvis(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        // Vérifier si l'utilisateur a déjà donné un avis
        $existingAvis = Avis::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingAvis) {
            return back()->with('error', 'Vous avez déjà donné votre avis sur ce produit.');
        }

        Avis::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->id(),
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return back()->with('success', 'Merci pour votre avis !');
    }
}