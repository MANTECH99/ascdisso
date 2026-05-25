<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\PanierSession;
use App\Models\User;
use App\Models\Notification;

class WavePaymentController extends Controller
{
    public function initiatePayment(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'description' => 'required|string'
        ]);

        try {
            $commande = Commande::findOrFail($request->commande_id);
            
            // Formater le téléphone
            $phone = $this->formatSenegalPhone($request->customer_phone);
            if (!$phone) {
                return response()->json([
                    'success' => false,
                    'message' => 'Numéro de téléphone invalide'
                ], 400);
            }

            // Config Dexchange
            $apiKey = config('services.dexchange.api_key');
            $apiUrl = config('services.dexchange.api_url');

            $payload = [
                'externalTransactionId' => 'ASCDISSO-' . $commande->id . '-' . time(),
                'serviceCode' => 'WAVE_SN_CASHOUT',
                'number' => $phone,
                'amount' => (float) $commande->total,
                'callBackURL' => secure_url('wave/callback'),          // ← HTTPS forcé
                'successUrl' => secure_url('commande/recu/' . $commande->id),  // ← HTTPS forcé
                'failureUrl' => secure_url('checkout') . '?payment=failed',    // ← HTTPS forcé
            ];

            Log::info('Wave Payment Request:', $payload);

            $response = Http::withOptions([
                'curl' => [
                    CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
                ],
            ])->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($apiUrl, $payload);

            // AJOUTE CECI
            Log::info('Wave API Response:', [
                'status' => $response->status(),
                'body' => $response->body(),
                'json' => $response->json()
            ]);

            if (!$response->successful()) {
                throw new \Exception('Erreur API Wave: ' . $response->body());
            }

            $data = $response->json();

            if (isset($data['transaction']['success']) && $data['transaction']['success']) {
                $commande->update([
                    'mode_paiement' => 'wave',
                    'statut_paiement' => 'non_paye',
                    'telephone' => $phone,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Paiement Wave initié',
                    'data' => [
                        'payment_url' => $data['transaction']['cashout_url'] ?? $data['transaction']['deepLink'],
                        'transaction_reference' => $data['transaction']['transactionId']
                    ]
                ]);
            }

            throw new \Exception($data['message'] ?? 'Erreur inconnue');

        } catch (\Exception $e) {
            Log::error('Wave Payment Error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

public function handleCallback(Request $request)
{
    Log::info('Wave Callback:', $request->all());

    try {
        $data = $request->all();
        
        $transactionId = $data['id'] ?? $data['transactionId'] ?? null;
        $externalId = $data['externalTransactionId'] ?? null;
        $status = strtoupper($data['STATUS'] ?? $data['status'] ?? '');

        // Trouver la commande
        $commande = null;
        if ($externalId && preg_match('/ASCDISSO-(\d+)-/', $externalId, $matches)) {
            $commande = Commande::find($matches[1]);
        }

        if (!$commande) {
            return response()->json(['success' => false, 'message' => 'Commande non trouvée'], 404);
        }

        // Mettre à jour le statut
        $successStatuses = ['SUCCESS', 'COMPLETED', 'PAID'];
        $failedStatuses = ['FAILED', 'CANCELLED', 'REJECTED'];

        if (in_array($status, $successStatuses)) {
            $commande->update(['statut_paiement' => 'paye']);
            
            // Vider le panier après paiement réussi
            if ($commande->cart_token) {
                // Invité : utiliser le token stocké
                $panierSession = PanierSession::find($commande->cart_token);
                if ($panierSession) {
                    $panierSession->delete();
                }
            } elseif ($commande->user_id) {
                // Connecté : utiliser l'ID utilisateur
                $panierSession = PanierSession::find('user_' . $commande->user_id);
                if ($panierSession) {
                    $panierSession->delete();
                }
            }
            
            // Notification admin
            $admins = User::where('is_admin', true)->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'commande_id' => $commande->id,
                    'message' => '✅ Paiement Wave confirmé - Commande #' . $commande->id . ' - ' . number_format($commande->total, 0) . ' FCFA',
                ]);
            }
            
        } elseif (in_array($status, $failedStatuses)) {
            $commande->update(['statut_paiement' => 'non_paye']);
        }

        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        Log::error('Wave Callback Error: ' . $e->getMessage());
        return response()->json(['success' => false], 500);
    }
}

    private function formatSenegalPhone($phone)
    {
        $digits = preg_replace('/\D/', '', $phone);
        $last9 = substr($digits, -9);
        
        if (strlen($last9) === 9 && preg_match('/^(77|76|78|70)/', $last9)) {
            return $last9;
        }
        return null;
    }

    public function checkPaymentStatus(Commande $commande)
    {
        return response()->json([
            'success' => true,
            'statut_paiement' => $commande->statut_paiement,
            'statut' => $commande->statut
        ]);
    }
}