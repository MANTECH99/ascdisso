<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WavePaymentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\CommandeController as AdminCommandeController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwoFactorController;



// Sitemap
Route::get('/sitemap.xml', function () {
    $categories = App\Models\Category::all();
    $products = App\Models\Product::all();
    
    return response()->view('sitemap', compact('categories', 'products'))
        ->header('Content-Type', 'text/xml');
})->name('sitemap');

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Recherche
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Catégories
// Redirection 301 des anciennes URLs catégories (ID) vers les nouvelles (slug)
Route::get('/category/{id}', function ($id) {
    $category = App\Models\Category::find($id);
    
    if (!$category) {
        abort(404);
    }
    
    return redirect()->route('category.show', $category->slug, 301);
})->where('id', '[0-9]+');

// Route normale avec slug
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('category.show');

// Produits
// Redirection 301 des anciennes URLs (ID) vers les nouvelles (slug)
Route::get('/product/{id}', function ($id) {
    $product = App\Models\Product::find($id);
    
    if (!$product) {
        abort(404);
    }
    
    return redirect()->route('product.show', $product->slug, 301);
})->where('id', '[0-9]+');

// Route normale avec slug
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');

// Avis (authentifié)
Route::post('/avis', [ProductController::class, 'storeAvis'])->name('avis.store')->middleware('auth');

    // Messages (notifications)
    Route::get('/messages', [CommandeController::class, 'messages'])->name('messages');

/*
|--------------------------------------------------------------------------
| Routes d'Authentification
|--------------------------------------------------------------------------
*/

// Inscription
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Connexion
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Mot de passe oublié
Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');

/*
|--------------------------------------------------------------------------
| Routes Panier
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');

/*
|--------------------------------------------------------------------------
| Routes Commandes
|--------------------------------------------------------------------------
*/

// Checkout (accessible à tous, même invités)
Route::get('/checkout', [CommandeController::class, 'checkout'])->name('checkout');
Route::post('/commande', [CommandeController::class, 'store'])->name('commande.store');

// Reçu de commande (accessible à tous)
Route::get('/commande/recu/{id}', [CommandeController::class, 'recu'])->name('commande.recu');

/*
|--------------------------------------------------------------------------
| Routes Utilisateurs Connectés
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    
    // Mon compte
    Route::get('/account', [AuthController::class, 'account'])->name('account');
    Route::put('/account', [AuthController::class, 'updateAccount'])->name('account.update');
    
    // Mes commandes
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');

    Route::get('/messages/unread-count', [CommandeController::class, 'unreadCount'])->name('messages.unreadCount');
    

    
});



/*
|--------------------------------------------------------------------------
| Routes Super Admin (prioritaires)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'superadmin','2fa'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/cashout', [App\Http\Controllers\Admin\CashoutController::class, 'index'])
        ->name('cashout.index');
    Route::post('/cashout', [App\Http\Controllers\Admin\CashoutController::class, 'initiate'])
        ->name('cashout.initiate');
});

// Callback hors middleware (appelé par Dexchange)
Route::post('/admin/cashout/callback', [App\Http\Controllers\Admin\CashoutController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| Routes Administrateur
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Gestion des matchs
    Route::resource('matchs', App\Http\Controllers\Admin\MatchController::class);
    Route::post('/matchs/{id}/toggle-visibility', [App\Http\Controllers\Admin\MatchController::class, 'toggleVisibility'])
        ->name('matchs.toggleVisibility');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    
    // Gestion des catégories
    Route::resource('categories', AdminCategoryController::class);
    
    // Gestion des produits
    Route::resource('products', AdminProductController::class);
    Route::delete('/products/image/{imageId}', [AdminProductController::class, 'deleteImage'])->name('products.deleteImage');
    
    // Gestion des bannières
    Route::resource('banners', AdminBannerController::class);
    
    // Gestion des commandes
    Route::get('/commandes', [AdminCommandeController::class, 'index'])->name('commandes.index');
    Route::get('/commandes/{id}', [AdminCommandeController::class, 'show'])->name('commandes.show');
    Route::post('/commandes/{id}/valider', [AdminCommandeController::class, 'valider'])->name('commandes.valider');
    Route::post('/commandes/{id}/livrer', [AdminCommandeController::class, 'livrer'])->name('commandes.livrer');
    Route::post('/commandes/{id}/annuler', [AdminCommandeController::class, 'annuler'])->name('commandes.annuler');
    
    // Notifications admin
    Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-all-read', [AdminNotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
    Route::get('/notifications/unread-count', [AdminNotificationController::class, 'getUnreadCount'])->name('notifications.unreadCount');
    
});


Route::post('/payment/initiate', [WavePaymentController::class, 'initiatePayment'])->name('payment.initiate');
Route::post('/payment/callback', [WavePaymentController::class, 'handleCallback'])->name('payment.callback');
Route::get('/payment/status/{commande}', [WavePaymentController::class, 'checkPaymentStatus'])->name('payment.status');






Route::get('/2fa/verify', [TwoFactorController::class, 'showVerifyForm'])->name('2fa.verify');
Route::post('/2fa/verify', [TwoFactorController::class, 'verify']);
Route::get('/2fa/setup', [TwoFactorController::class, 'setup'])->name('2fa.setup')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Routes Pages Statiques
|--------------------------------------------------------------------------
*/

// À propos
Route::get('/about', function () {
    return view('about');
})->name('about');

// Blog
Route::get('/blog', function () {
    return view('blog.index');
})->name('blog');

// Contact
Route::get('/contact', function () 

{
    return view('contact');
})->name('contact');

Route::get('/matchs', [App\Http\Controllers\MatchController::class, 'index'])->name('matchs');