<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cartItems;
        return view('cart.index', compact('cartItems'));
    }

    public function add(Menu $menu)
    {
        Cart::create([
            'user_id' => auth()->id(),
            'menu_id' => $menu->id,
            'quantity' => 1,
        ]);

        return back()->with('success', 'Menu berhasil ditambahkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Jumlah menu berhasil diperbarui');
    }

    public function remove($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return back()->with('success', 'Menu berhasil dihapus dari keranjang');
    }
}
