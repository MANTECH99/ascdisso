<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $products = Product::where('nom', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('nom', 'LIKE', "%{$query}%");
            })
            ->with(['images', 'avis', 'category'])
            ->where('stock', '>', 0)
            ->paginate(12)
            ->appends(['q' => $query]);

        return view('search', compact('products', 'query'));
    }
}