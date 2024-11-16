<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Retrieve cart items from the session, or set an empty array if not found
        $cartItems = session()->get('cart', []);

        // Return the cart view with the cart items

        return view('cart.index', compact('cartItems')); // Return the cart view
    }
}