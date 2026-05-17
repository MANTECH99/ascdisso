<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::active()->ordered()->get();
        $categories = Category::orderBy('ordre')->get();
        $products = Product::with(['images', 'avis'])
            ->where('stock', '>', 0)
            ->latest()
            ->take(12)
            ->get();

        return view('home', compact('banners', 'categories', 'products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $products = Product::where('nom', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('nom', 'LIKE', "%{$query}%");
            })
            ->with(['images', 'avis'])
            ->paginate(12);

        return view('search', compact('products', 'query'));
    }
}