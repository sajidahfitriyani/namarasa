<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Reservation;

class PaymentController extends Controller
{
    public function getSnapToken(Request $request)
    {
        try {
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $orderId = 'ORDER-' . uniqid();

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $request->total, // pastikan sudah dalam satuan rupiah
                ],
                'customer_details' => [
                    'first_name' => 'Customer',
                    'email' => 'customer@mail.com',
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return response()->json(['token' => $snapToken, 'order_id' => $orderId]);
        } catch (\Exception $e) {
            \Log::error('Midtrans Snap Error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal membuat token pembayaran Midtrans.'], 500);
        }
    }

    public function handlePaymentSuccess(Request $request)
    {
        // Get cart items from session
        $cartItems = session('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('menus.index')->with('error', 'Keranjang kosong');
        }

        // Calculate total
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Try to get the latest reservation from the current user session
        // Look for the most recent reservation that might be associated with this order
        $reservationId = null;

        // Get the latest reservation created today (you can adjust this logic)
        $latestReservation = Reservation::whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->first();

        if ($latestReservation) {
            $reservationId = $latestReservation->id;
        }

        $orderId = 'ORDER-' . uniqid();

        // Create order record
        Order::create([
            'order_id' => $orderId,
            'reservation_id' => $reservationId,
            'total_amount' => $total,
            'payment_status' => 'completed',
            'order_items' => $cartItems
        ]);

        // Clear cart after successful payment
        session()->forget('cart');

        return redirect()->route('menus.index')->with('success', 'Pembayaran berhasil! Pesanan Anda telah dicatat.');
    }


}
