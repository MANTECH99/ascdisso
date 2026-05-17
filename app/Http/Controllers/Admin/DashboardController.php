<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalCommandes = Commande::count();
        $commandesEnAttente = Commande::where('statut', 'en_attente')->count();
        $totalProduits = Product::count();
        $totalClients = User::where('is_admin', false)->count();
        $commandesRecentes = Commande::with('user')->latest()->take(5)->get();
        $chiffreAffaires = Commande::where('statut', '!=', 'annulee')->sum('total');

        return view('admin.dashboard', compact(
            'totalCommandes',
            'commandesEnAttente',
            'totalProduits',
            'totalClients',
            'commandesRecentes',
            'chiffreAffaires'
        ));
    }
}