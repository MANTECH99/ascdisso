<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Mail\ContactConfirmationMail;  // ← Ajouter cette ligne

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'sujet' => 'required|string',
            'message' => 'required|string|min:10',
        ]);

        // Données pour les emails
        $data = [
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'] ?? 'Non renseigné',
            'sujet' => $validated['sujet'],
            'message' => $validated['message'],
        ];

        // 1. Envoyer l'email à l'équipe ASC Disso
        Mail::to('contact@ascdisso.com')->send(new ContactFormMail($data));

        // 2. Envoyer l'email de confirmation au client
        Mail::to($validated['email'])->send(new ContactConfirmationMail($data));

        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès ! Vous recevrez une confirmation par email dans quelques instants.');
    }
}