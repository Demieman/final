<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShoppingCartController extends Controller
{
    public function showCart()
    {
        // Fetch products from the API
        $response = Http::get('https://dummyjson.com/products');
        $products = $response->json()['products'] ?? [];

        // Get cart items from session
        $cartItems = session('cart', []);

        // Pass products and cart items to the view
        return view('cart.index', [
            'cartItems' => $cartItems,
            'products' => $products,
        ]);
    }

    public function addToCart($id, Request $request)
    {
        // Fetch products from the API
        $response = Http::get('https://dummyjson.com/products/' . $id);
        $product = $response->json();

        // Get the cart from the session
        $cart = session('cart', []);
        $quantity = $request->input('quantity', 1);

        // Check if item exists in cart and update quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $product['title'], // Product title
                'price' => $product['price'], // Product price
                'quantity' => $quantity,
            ];
        }

        // Save the updated cart back to the session
        session(['cart' => $cart]);

        // Redirect back to the cart page
        return redirect()->route('cart.show')->with('success', 'Product added to cart!');
    }
}