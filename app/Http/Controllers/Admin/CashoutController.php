<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashoutLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CashoutController extends Controller
{

public function index()
    {
        $logs = CashoutLog::latest()->paginate(20);
        $balance = $this->getBalance();
        
        return view('admin.cashout.index', compact('logs', 'balance'));
    }

public function initiate(Request $request)
{
    $request->validate([
        'phone' => 'required|string',
        'amount' => 'required|numeric|min:100',
        'service' => 'required|in:OM_SN_CASHIN,WAVE_SN_CASHIN,FM_SN_CASHIN,WIZALL_SN_CASHIN',
        'code_2fa' => 'required|string|size:6',
    ]);

    $phone = $this->formatPhone($request->phone);

    if (!$phone) {
        return back()->with('error', 'Numéro de téléphone invalide.');
    }

    // Vérifier le code 2FA
$user = auth()->user();
$google2fa = app('pragmarx.google2fa');
$valid = $google2fa->verifyKey($user->google2fa_secret, $request->code_2fa);

if (!$valid) {
    return back()->with('error', 'Code 2FA invalide.');
}

// Après la validation, avant d'envoyer à Dexchange
$soldeDisponible = $this->getBalance();

if (($request->amount * 1.015) > $soldeDisponible) {
    return back()->with('error', 'Solde insuffisant. Votre solde disponible est de ' . number_format($soldeDisponible, 0) . ' FCFA.');
}

    $apiKey = config('services.dexchange.api_key');
    $apiUrl = config('services.dexchange.api_url');

$externalId = 'ASCDISSO-CASHOUT-' . time();

    $payload = [
        'externalTransactionId' => $externalId,
        'serviceCode' => $request->service,
        'number' => $phone,
        'amount' => (float) $request->amount,
        'callBackURL' => secure_url('admin/cashout/callback'),
        'successUrl' => secure_url('admin/cashout'),
        'failureUrl' => secure_url('admin/cashout'),
        'sub_merchant_id' => config('services.dexchange.sub_merchant_id'), // ← AJOUTER
    ];

    Log::info('Cashout Request:', $payload);

    try {
        $response = Http::timeout(120)
            ->withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($apiUrl, $payload);

        $data = $response->json();
        $statusCode = $response->status();
        
        Log::info('Cashout Response:', [
            'status' => $statusCode,
            'body' => $data
        ]);

        // Déterminer le succès
        $success = false;
        if (isset($data['transaction']['success'])) {
            $success = $data['transaction']['success'];
        } elseif (isset($data['success'])) {
            $success = $data['success'];
        } elseif ($statusCode === 201) {
            $success = true;
        }

        $status = $success ? 'initiated' : 'failed';

        // Sauvegarder le log
        $responseData = null;
        if (is_array($data) || is_object($data)) {
            $responseData = json_encode($data);
        } elseif (is_string($data)) {
            $responseData = $data;
        } else {
            $responseData = json_encode(['raw' => $response->body()]);
        }

        CashoutLog::create([
            'admin_id' => auth()->id(),
            'service_code' => $request->service,
            'phone' => $phone,
            'amount' => $request->amount,
            'external_id' => $externalId,
            'status' => $status,
            'response' => $responseData,
        ]);

        // Si succès direct
        if ($success) {
            return back()->with('success', 'Envoi de ' . number_format($request->amount) . ' FCFA effectué avec succès.');
        }

// Si timeout, vérifier le statut
if ($statusCode === 503 || $statusCode === 504) {
    // Récupérer le transactionId depuis la réponse si dispo
    $transactionId = $data['transaction']['transactionId'] ?? null;
    
    if ($transactionId) {
        $transactionStatus = $this->checkStatus($transactionId);
        
        if ($transactionStatus === 'success') {
            CashoutLog::where('external_id', $externalId)
                ->update(['status' => 'success']);
            return back()->with('success', 'Envoi de ' . number_format($request->amount) . ' FCFA effectué avec succès.');
        }
    }
    
    return back()->with('success', '⏳ Envoi de ' . number_format($request->amount) . ' FCFA en cours de traitement...');
}

// Récupérer le message d'erreur (parfois c'est un array chez Dexchange)
$errorMsg = $data['transaction']['message'] 
         ?? $data['message'] 
         ?? $data['error'] 
         ?? 'Erreur inconnue';

// Si c'est un array, prendre le premier élément
if (is_array($errorMsg)) {
    $errorMsg = $errorMsg[0] ?? 'Erreur inconnue';
}

// Traduire les messages courants
if (is_string($errorMsg)) {
    if (stripos($errorMsg, 'Insufficient balance') !== false) {
        $errorMsg = 'Solde insuffisant. Vérifiez votre solde !';
    } elseif (stripos($errorMsg, 'invalid') !== false) {
        $errorMsg = 'Numéro de téléphone invalide.';
    } elseif (stripos($errorMsg, 'limit') !== false) {
        $errorMsg = 'Montant dépassant la limite autorisée.';
    } elseif (stripos($errorMsg, 'not authorized') !== false) {
        $errorMsg = 'IP non autorisée. Ajoutez cette IP dans votre dashboard Dexchange.';
    }
}

return back()->with('error', '❌ ' . $errorMsg);

    } catch (\Exception $e) {
        Log::error('Cashout Error:', ['message' => $e->getMessage()]);
        
        // Vérifier le statut même en cas d'erreur
        $transactionStatus = $this->checkStatus($externalId);
        
        if ($transactionStatus === 'success') {
            CashoutLog::where('external_id', $externalId)
                ->update(['status' => 'success']);
            return back()->with('success', 'Envoi de ' . number_format($request->amount) . ' FCFA effectué avec succès.');
        }
        
        try {
            CashoutLog::create([
                'admin_id' => auth()->id(),
                'service_code' => $request->service,
                'phone' => $phone,
                'amount' => $request->amount,
                'external_id' => $externalId,
                'status' => 'failed',
                'response' => json_encode(['error' => $e->getMessage()]),
            ]);
        } catch (\Exception $logException) {
            Log::error('Failed to create cashout log:', ['error' => $logException->getMessage()]);
        }
        
        return back()->with('error', 'Erreur de connexion au service.');
    }
}
public function callback(Request $request)
{
    Log::info('Cashout Callback:', $request->all());

    $externalId = $request->input('externalTransactionId');
    $status = strtoupper($request->input('STATUS', $request->input('status', '')));

    $log = CashoutLog::where('external_id', $externalId)->first();

    if ($log) {
        $successStatuses = ['SUCCESS', 'COMPLETED', 'PAID'];
        $log->update([
            'status' => in_array($status, $successStatuses) ? 'success' : 'failed',
            'callback_response' => json_encode($request->all()),
        ]);
        
        Log::info('Cashout Log Updated:', [
            'external_id' => $externalId,
            'status' => $log->status,
            'new_status' => in_array($status, $successStatuses) ? 'success' : 'failed'
        ]);
    }

    return response()->json(['success' => true]);
}

private function formatPhone($phone)
{
    // Supprime tous les caractères non numériques (espaces, tirets, etc.)
    $digits = preg_replace('/\D/', '', $phone);
    
    // Prend les 9 derniers chiffres
    $last9 = substr($digits, -9);
    
    // Vérifie que c'est un numéro sénégalais valide (Orange, Free, Expresso)
    if (strlen($last9) === 9 && preg_match('/^(77|78|76|70|75|33)/', $last9)) {
        return $last9;
    }
    
    return null;
}

private function getBalance()
{
    try {
        $recharges = CashoutLog::whereIn('service_code', ['OM_SN_CASHOUT', 'WAVE_SN_CASHOUT', 'FM_SN_CASHOUT', 'WIZALL_SN_CASHOUT'])
            ->where('status', 'success')
            ->sum('amount');

        $retraits = CashoutLog::whereIn('service_code', ['OM_SN_CASHIN', 'WAVE_SN_CASHIN', 'FM_SN_CASHIN', 'WIZALL_SN_CASHIN'])
            ->where('status', 'success')
            ->sum('amount');

        return ($recharges * 0.985) - ($retraits * 1.015);
        
    } catch (\Exception $e) {
        return null;
    }
}

public function checkStatus($transactionId)
{
    try {
        $apiKey = config('services.dexchange.api_key');
        $baseUrl = config('services.dexchange.api_url');
        
        $parsedUrl = parse_url($baseUrl);
        $baseApiUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
        $statusUrl = $baseApiUrl . '/api/v1/transaction/' . $transactionId;
        
        $response = Http::timeout(30)
            ->withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
            ])->get($statusUrl);
        
        $data = $response->json();
        Log::info('Transaction Status:', ['data' => $data]);
        
        $status = $data['transaction']['Status'] 
               ?? $data['Status'] 
               ?? 'PENDING';
        
        if (in_array(strtoupper($status), ['SUCCESS', 'COMPLETED', 'SUCCESSFUL'])) {
            return 'success';
        }
        
        return 'initiated';
        
    } catch (\Exception $e) {
        return 'initiated';
    }
}
}