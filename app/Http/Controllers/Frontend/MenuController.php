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
        $cartItems = session('cart', []);
        //dd($cartItems);
        return view('menus.cart', compact('cartItems'));
    }
    
    public function addToCart($id)
    {
        $menu = Menu::findOrFail($id);
        $cart = session('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $menu->id,
                'name' => $menu->name,
                'price' => $menu->price,
                'quantity' => 1
            ];
        }

        session(['cart' => $cart]);
        return redirect()->route('cart.index')->with('success', 'Menu berhasil ditambahkan ke keranjang');
    }

}
