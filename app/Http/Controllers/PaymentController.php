<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getSnapToken(Request $request)
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $request->total, // pastikan sudah dalam satuan rupiah
            ],
            'customer_details' => [
                'first_name' => 'Customer',
                'email' => 'customer@mail.com',
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return response()->json(['token' => $snapToken]);
    }
}
