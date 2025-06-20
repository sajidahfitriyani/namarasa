<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    public function cart()
    {
        // Data dummy untuk keranjang
        $cartItems = [
            1 => [
                'id' => 1,
                'name' => 'Nasi Goreng Spesial',
                'price' => 35000,
                'quantity' => 2
            ],
            2 => [
                'id' => 2,
                'name' => 'Ayam Bakar Madu',
                'price' => 45000,
                'quantity' => 1
            ],
            3 => [
                'id' => 3,
                'name' => 'Es Teh Manis',
                'price' => 5000,
                'quantity' => 3
            ]
        ];

        session(['cart' => $cartItems]);
        return view('menus.cart', compact('cartItems'));
    }

    public function removeFromCart($id)
    {
        $cart = session('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }
        return redirect()->back()->with('success', 'Menu berhasil dihapus dari keranjang');
    }
}
