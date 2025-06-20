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

    public function removeFromCart($id)
    {
        $cart = session('cart', []);
        
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
            return redirect()->route('cart.index')->with('success', 'Menu berhasil dihapus dari keranjang');
        }

        return redirect()->route('cart.index')->with('error', 'Menu tidak ditemukan di keranjang');
    }

    public function updateQuantity($id, $action)
    {
        $cart = session('cart', []);
        
        if(isset($cart[$id])) {
            if($action === 'increment') {
                $cart[$id]['quantity']++;
                $message = 'Jumlah menu berhasil ditambahkan';
            } elseif($action === 'decrement' && $cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
                $message = 'Jumlah menu berhasil dikurangi';
            } else {
                return redirect()->route('cart.index')->with('error', 'Tidak bisa mengurangi jumlah menu yang sudah 1');
            }

            session(['cart' => $cart]);
            return redirect()->route('cart.index')->with('success', $message);
        }

        return redirect()->route('cart.index')->with('error', 'Menu tidak ditemukan di keranjang');
    }

}
