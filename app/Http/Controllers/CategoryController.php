<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
public function show(Category $category)
{
    $products = Product::where('category_id', $category->id)
        ->where('stock', '>', 0)
        ->with(['images', 'avis'])
        ->latest()
        ->paginate(12);

    return view('category.show', compact('category', 'products'));
}
}