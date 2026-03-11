<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Transaction;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct(protected MidtransService $midtrans) {}

    // ── Halaman upgrade pro ──────────────────────────────────
    public function upgrade()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user?->hasRole('pro')) {
            return redirect()->route('home')->with('info', 'Kamu sudah menjadi member Pro!');
        }

        $price = config('midtrans.pro_price');

        return view('payment.upgrade', compact('price'));
    }

    // ── Buat transaksi + snap token ──────────────────────────
public function checkout()
{
    $user  = Auth::user();
    $price = config('midtrans.pro_price');

    // Hapus semua transaksi pending lama
    Transaction::where('user_id', $user->id)
        ->where('status', 'pending')
        ->delete();

    // Buat transaksi baru dengan order_id unik
    $transaction = Transaction::create([
        'user_id'  => $user->id,
        'order_id' => 'INV-' . $user->id . '-' . time() . '-' . uniqid(),
        'amount'   => $price,
        'status'   => 'pending',
    ]);

    // Ambil snap token dari Midtrans
    $snapToken = $this->midtrans->createSnapToken($transaction);

    $transaction->update(['snap_token' => $snapToken]);

    return response()->json([
        'snap_token' => $snapToken,
        'order_id'   => $transaction->order_id,
    ]);
}

    // ── Webhook dari Midtrans ────────────────────────────────
    public function webhook(Request $request)
    {
        Log::info('=== WEBHOOK CALLED ===', $request->all());

        $serverKey   = config('midtrans.server_key');
        $orderId     = $request->order_id;
        $statusCode  = $request->status_code;
        $grossAmount = $request->gross_amount;

        // Validasi signature key
        $signatureKey = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        Log::info('Signature check', [
            'match'    => $signatureKey === $request->signature_key,
            'expected' => $signatureKey,
            'received' => $request->signature_key,
        ]);

        if ($signatureKey !== $request->signature_key) {
            Log::warning('Invalid signature — webhook rejected');
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $transaction = Transaction::where('order_id', $orderId)->first();

        Log::info('Transaction lookup', [
            'order_id' => $orderId,
            'found'    => $transaction ? true : false,
        ]);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Update status berdasarkan notifikasi Midtrans
        $transactionStatus = $request->transaction_status;
        $fraudStatus       = $request->fraud_status ?? null;

        if ($transactionStatus === 'capture') {
            $status = $fraudStatus === 'accept' ? 'success' : 'failed';
        } elseif ($transactionStatus === 'settlement') {
            $status = 'success';
        } elseif (in_array($transactionStatus, ['cancel', 'deny', 'failure'])) {
            $status = 'failed';
        } elseif ($transactionStatus === 'expire') {
            $status = 'expired';
        } else {
            $status = 'pending';
        }

        Log::info('Status determined', [
            'transaction_status' => $transactionStatus,
            'fraud_status'       => $fraudStatus,
            'final_status'       => $status,
        ]);

        $transaction->update([
            'status'  => $status,
            'paid_at' => $status === 'success' ? now() : null,
        ]);

        // Upgrade role ke pro jika pembayaran berhasil
        if ($status === 'success') {
            $proRole = Role::where('name', 'pro')->first();

            Log::info('Upgrading user to pro', [
                'user_id'     => $transaction->user_id,
                'pro_role_id' => $proRole?->id,
                'role_found'  => $proRole ? true : false,
            ]);

            if ($proRole) {
                // Fresh user dari DB agar tidak pakai cache
                $user = $transaction->user()->lockForUpdate()->first();
                $result = $user->update(['role_id' => $proRole->id]);

                Log::info('Role update result', [
                    'user_id'    => $user->id,
                    'new_role'   => $proRole->id,
                    'db_updated' => $result,
                ]);
            } else {
                Log::error('Pro role NOT FOUND in database!');
            }
        }

        return response()->json(['message' => 'OK']);
    }
}