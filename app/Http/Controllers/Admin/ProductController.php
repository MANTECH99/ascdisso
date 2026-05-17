<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'images'])->latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('nom')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'prix_barre' => 'nullable|numeric|min:0',
            'pourcentage_reduction' => 'nullable|integer|min:0|max:99',
            'stock' => 'required|integer|min:0',
            'images' => 'required|array|min:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'images.min' => 'Vous devez télécharger au minimum 5 images pour le produit.',
        ]);

        $product = Product::create([
            'category_id' => $request->category_id,
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'prix_barre' => $request->prix_barre,
            'pourcentage_reduction' => $request->pourcentage_reduction ?? 0,
            'stock' => $request->stock,
        ]);

        // Enregistrer les images
        foreach ($request->file('images') as $key => $image) {
            $path = $image->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'ordre' => $key + 1,
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Produit créé avec succès !');
    }

    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::orderBy('nom')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'prix_barre' => 'nullable|numeric|min:0',
            'pourcentage_reduction' => 'nullable|integer|min:0|max:99',
            'stock' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product->update($request->except('images'));

        // Ajouter de nouvelles images si présentes
        if ($request->hasFile('images')) {
            $currentCount = $product->images()->count();
            foreach ($request->file('images') as $key => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'ordre' => $currentCount + $key + 1,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour !');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Supprimer les images
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé !');
    }

    public function deleteImage($imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        
        // Vérifier qu'il reste au moins 5 images
        $product = Product::findOrFail($image->product_id);
        if ($product->images()->count() <= 5) {
            return back()->with('error', 'Un produit doit avoir au minimum 5 images.');
        }

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image supprimée !');
    }
}