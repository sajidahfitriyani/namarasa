<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = auth()->user()->carts()->with('menu')->get();
        $total = $carts->sum(function($cart) {
            return $cart->menu->price * $cart->quantity;
        });
        
        return view('cart.index', compact('carts', 'total'));
    }

    public function add(Request $request, $menuId)
    {
        $menu = Menu::findOrFail($menuId);
        
        $cart = Cart::where('user_id', auth()->id())
                    ->where('menu_id', $menuId)
                    ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'menu_id' => $menuId,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        
        if (auth()->id() !== $cart->user_id) {
            abort(403);
        }

        $cart->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->back()->with('success', 'Jumlah menu berhasil diperbarui');
    }

    public function remove($id)
    {
        $cart = Cart::findOrFail($id);
        
        if (auth()->id() !== $cart->user_id) {
            abort(403);
        }

        $cart->delete();

        return redirect()->back()->with('success', 'Menu berhasil dihapus dari keranjang');
    }
}
