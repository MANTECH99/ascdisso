<?php
// app/Http/Middleware/AdminMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Le super admin n'accède PAS aux routes admin standard
        if (Auth::user()->isSuperAdmin()) {
            return redirect()->route('admin.cashout.index');
        }
        
        // Vérifier admin normal
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }
        
        return $next($request);
    }
}