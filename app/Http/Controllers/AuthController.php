<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telephone' => [
                'required',
                'string',
                'unique:users',
                function ($attribute, $value, $fail) {
                    $cleaned = str_replace(' ', '', $value);
                    if (!preg_match('/^(77|78|76|70|75|33)\d{7}$/', $cleaned)) {
                        $fail('Le numéro de téléphone doit être un numéro sénégalais valide.');
                    }
                },
            ],
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Compte créé avec succès !');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $request->validate([
        'telephone' => 'required|string',
        'password' => 'required|string',
    ]);

    $credentials = [
        'telephone' => $request->telephone,
        'password' => $request->password,
    ];

    if (Auth::attempt($credentials, $request->remember)) {
        $request->session()->regenerate();
        
        // Vérifier si l'utilisateur est admin
        if (Auth::user()->isAdmin()) { // ou Auth::user()->role === 'admin'
            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->intended(route('home'));
    }

    return back()->withErrors([
        'telephone' => 'Les identifiants ne correspondent pas.',
    ])->withInput($request->except('password'));
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function account()
    {
        $user = Auth::user();
        $commandes = $user->commandes()->latest()->take(5)->get();
        return view('account.index', compact('user', 'commandes'));
    }

    public function updateAccount(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'telephone' => [
                'required',
                'string',
                'unique:users,telephone,' . $user->id,
                function ($attribute, $value, $fail) {
                    $cleaned = str_replace(' ', '', $value);
                    if (!preg_match('/^(77|78|76|70|75|33)\d{7}$/', $cleaned)) {
                        $fail('Le numéro de téléphone doit être un numéro sénégalais valide.');
                    }
                },
            ],
            'adresse' => 'nullable|string|max:500',
        ]);

        $user->update($request->only(['prenom', 'nom', 'email', 'telephone', 'adresse']));

        return back()->with('success', 'Informations mises à jour avec succès !');
    }
}