<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Transaction;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$clientKey    = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
        Config::$overrideNotifUrl = config('app.url') . 'webhook/midtrans';
    }

    public function createSnapToken(Transaction $transaction): string
    {
        $params = [
            'transaction_details' => [
                'order_id'     => $transaction->order_id,
                'gross_amount' => $transaction->amount,
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email'      => $transaction->user->email,
            ],
            'item_details' => [
                [
                    'id'       => 'PRO_PLAN',
                    'price'    => $transaction->amount,
                    'quantity' => 1,
                    'name'     => 'NurSteps Pro — Bebas Iklan',
                ],
            ],'callbacks' => [                                                // ← tambah ini
                'notification' => config('app.url') . '/webhook/midtrans', // ← tambah ini
            ],        
        ];

        return Snap::getSnapToken($params);
    }
}