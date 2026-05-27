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
        try {
            Log::info('Initiate Payment - Request received:', $request->all());
            
            $request->validate([
                'commande_id' => 'required|exists:commandes,id',
                'customer_name' => 'required|string',
                'customer_phone' => 'required|string',
                'payment_method' => 'required|in:wave,orange_money'
            ]);

            $commande = Commande::findOrFail($request->commande_id);
            
            if ($commande->statut_paiement === 'paye') {
                return response()->json([
                    'success' => false,
                    'message' => 'Cette commande a déjà été payée.'
                ], 200);
            }
            
            $phone = $this->formatSenegalPhone($request->customer_phone, $request->payment_method);
            if (!$phone) {
                return response()->json([
                    'success' => false,
                    'commande_id' => $commande->id,
                    'message' => 'Numéro de téléphone invalide pour ' . $request->payment_method
                ], 200);
            }

            $apiKey = config('services.dexchange.api_key');
            $apiUrl = config('services.dexchange.api_url');
            
            if (empty($apiKey) || empty($apiUrl)) {
                Log::error('Dexchange configuration missing');
                return response()->json([
                    'success' => false,
                    'commande_id' => $commande->id,
                    'message' => 'Configuration de paiement incomplète.'
                ], 200);
            }

            $serviceCode = $request->payment_method === 'orange_money' 
                ? 'OM_SN_CASHOUT'
                : 'WAVE_SN_CASHOUT';

            $payload = [
                'externalTransactionId' => 'ASCDISSO-' . $commande->id . '-' . time(),
                'serviceCode' => $serviceCode,
                'number' => $phone,
                'amount' => (float) $commande->total,
                'callBackURL' => secure_url('payment/callback'),
                'successUrl' => secure_url('commande/recu/' . $commande->id),
                'failureUrl' => secure_url('checkout') . '?payment=failed&method=' . $request->payment_method,
            ];

            Log::info('Payment Request Payload:', $payload);

            $response = Http::timeout(60)
                ->withOptions([
                    'verify' => false,
                    'curl' => [
                        CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
                    ],
                ])->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->post($apiUrl, $payload);

            Log::info('Payment API Response:', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            $data = $response->json();
            
            if (!$data) {
                Log::error('Invalid JSON response from API');
                return response()->json([
                    'success' => false,
                    'commande_id' => $commande->id,
                    'message' => 'Réponse invalide du service de paiement.'
                ], 200);
            }

            if (isset($data['transaction'])) {
                $transaction = $data['transaction'];
                
                if (isset($transaction['success']) && $transaction['success'] === false) {
                    $errorMessage = $transaction['message'] ?? $data['message'] ?? 'Échec du paiement';
                    
                    $commande->update(['statut_paiement' => 'non_paye']);
                    
                    if (stripos($errorMessage, 'solde insuffisant') !== false) {
                        return response()->json([
                            'success' => false,
                            'commande_id' => $commande->id,
                            'message' => 'Solde insuffisant sur votre compte ' . ucfirst($request->payment_method) . '. Veuillez recharger votre compte.'
                        ], 200);
                    }
                    
                    if (stripos($errorMessage, 'timeout') !== false || stripos($errorMessage, 'expir') !== false) {
                        return response()->json([
                            'success' => false,
                            'commande_id' => $commande->id,
                            'message' => 'La session de paiement a expiré. Veuillez réessayer.'
                        ], 200);
                    }
                    
                    if (stripos($errorMessage, 'invalid') !== false || stripos($errorMessage, 'phone') !== false) {
                        return response()->json([
                            'success' => false,
                            'commande_id' => $commande->id,
                            'message' => 'Numéro de téléphone invalide pour ' . ucfirst($request->payment_method) . '.'
                        ], 200);
                    }
                    
                    if (stripos($errorMessage, 'limit') !== false || stripos($errorMessage, 'plafond') !== false) {
                        return response()->json([
                            'success' => false,
                            'commande_id' => $commande->id,
                            'message' => 'Limite de transaction dépassée. Veuillez réessayer avec un montant inférieur.'
                        ], 200);
                    }
                    
                    return response()->json([
                        'success' => false,
                        'commande_id' => $commande->id,
                        'message' => $errorMessage
                    ], 200);
                }
                
                if (isset($transaction['success']) && $transaction['success'] === true) {
                    $commande->update([
                        'mode_paiement' => $request->payment_method,
                        'statut_paiement' => 'non_paye',
                        'telephone' => $phone,
                    ]);

                    if ($request->payment_method === 'orange_money') {
                        return response()->json([
                            'success' => true,
                            'commande_id' => $commande->id,
                            'message' => 'Paiement Orange Money initié. Veuillez valider la notification sur votre téléphone.'
                        ]);
                    }

                    $paymentUrl = $transaction['cashout_url'] ?? $transaction['deepLink'] ?? null;
                    
                    if (!$paymentUrl) {
                        Log::error('No payment URL in response:', $data);
                        return response()->json([
                            'success' => false,
                            'commande_id' => $commande->id,
                            'message' => 'Lien de paiement non disponible. Veuillez réessayer.'
                        ], 200);
                    }

                    return response()->json([
                        'success' => true,
                        'message' => 'Paiement initié',
                        'data' => [
                            'payment_url' => $paymentUrl,
                            'transaction_reference' => $transaction['transactionId'] ?? null
                        ]
                    ]);
                }
            }

            Log::error('Unexpected API response:', $data);
            return response()->json([
                'success' => false,
                'commande_id' => $commande->id,
                'message' => $data['message'] ?? 'Erreur inconnue du service de paiement.'
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Données invalides.'
            ], 200);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Connection Error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'commande_id' => $request->commande_id ?? null,
                'message' => 'Impossible de se connecter au service de paiement.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Payment Error:', ['message' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'commande_id' => $request->commande_id ?? null,
                'message' => 'Une erreur est survenue. Veuillez réessayer.'
            ], 200);
        }
    }

public function handleCallback(Request $request)
{
    Log::info('Payment Callback:', $request->all());

    try {
        $data = $request->all();
        
        $externalId = $data['externalTransactionId'] ?? null;
        $status = strtoupper($data['STATUS'] ?? $data['status'] ?? '');

        $commande = null;
        if ($externalId && preg_match('/ASCDISSO-(\d+)-/', $externalId, $matches)) {
            $commande = Commande::find($matches[1]);
        }

        if (!$commande) {
            return response()->json(['success' => false, 'message' => 'Commande non trouvée'], 404);
        }

        $successStatuses = ['SUCCESS', 'COMPLETED', 'PAID'];
        $failedStatuses = ['FAILED', 'CANCELLED', 'REJECTED', 'EXPIRED'];

        if (in_array($status, $successStatuses)) {
            $commande->update([
                'statut_paiement' => 'paye',
                'statut' => 'en_attente'
            ]);
            
            // Vider le panier après paiement réussi
            if ($commande->cart_token) {
                PanierSession::where('id', $commande->cart_token)->delete();
            } elseif ($commande->user_id) {
                PanierSession::where('id', 'user_' . $commande->user_id)->delete();
            }
            
            $paymentMethod = $commande->mode_paiement === 'orange_money' ? 'Orange Money' : 'Wave';
            $admins = User::where('is_admin', true)->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'commande_id' => $commande->id,
                    'message' => '✅ Paiement ' . $paymentMethod . ' confirmé - Commande #' . $commande->id . ' - ' . number_format($commande->total, 0) . ' FCFA',
                ]);
            }
            
        } elseif (in_array($status, $failedStatuses)) {
            // Déterminer la raison de l'échec
            $reason = $data['message'] ?? $data['error'] ?? 'Échec du paiement';
            
            if (stripos($reason, 'solde') !== false || stripos($reason, 'insuffisant') !== false) {
                $message = 'Paiement échoué : solde insuffisant sur votre compte ' . ($commande->mode_paiement === 'orange_money' ? 'Orange Money' : 'Wave');
            } elseif (stripos($reason, 'timeout') !== false || stripos($reason, 'expir') !== false) {
                $message = 'Paiement échoué : délai de validation expiré';
            } elseif (stripos($reason, 'cancel') !== false) {
                $message = 'Paiement annulé par l\'utilisateur';
            } else {
                $message = 'Paiement échoué : ' . $reason;
            }
            
            $commande->update([
                'statut_paiement' => 'non_paye',
                'statut' => 'en_attente'
            ]);
            
            // Notifier les admins
            $paymentMethod = $commande->mode_paiement === 'orange_money' ? 'Orange Money' : 'Wave';
            $admins = User::where('is_admin', true)->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'commande_id' => $commande->id,
                    'message' => '❌ ' . $message . ' - Commande #' . $commande->id . ' - ' . number_format($commande->total, 0) . ' FCFA',
                ]);
            }
            
            Log::info('Payment failed for commande #' . $commande->id . ': ' . $message);
        }

        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        Log::error('Callback Error: ' . $e->getMessage());
        return response()->json(['success' => false], 500);
    }
}

    private function formatSenegalPhone($phone, $method = 'wave')
    {
        $digits = preg_replace('/\D/', '', $phone);
        $last9 = substr($digits, -9);
        
        if (strlen($last9) === 9) {
            if ($method === 'orange_money') {
                if (preg_match('/^(77|78)/', $last9)) {
                    return $last9;
                }
            } else {
                if (preg_match('/^(77|76|78|70)/', $last9)) {
                    return $last9;
                }
            }
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