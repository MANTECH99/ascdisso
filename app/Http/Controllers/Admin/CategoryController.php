<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('ordre')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:categories',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'ordre' => 'nullable|integer|min:0',
        ]);

        $imagePath = $request->file('image')->store('categories', 'public');

        Category::create([
            'nom' => $request->nom,
            'image' => $imagePath,
            'ordre' => $request->ordre ?? 0,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie créée avec succès !');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255|unique:categories,nom,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ordre' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $imagePath = $request->file('image')->store('categories', 'public');
            $category->image = $imagePath;
        }

        $category->update([
            'nom' => $request->nom,
            'ordre' => $request->ordre ?? $category->ordre,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie mise à jour !');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Supprimer l'image
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie supprimée !');
    }
}