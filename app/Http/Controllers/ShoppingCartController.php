<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShoppingCartController extends Controller
{
    public function index(Request $request)
    {
        return $this->showCart($request); // Call the existing showCart method
    }

    public function showCart(Request $request)
    {
        // Get the current page from the query parameters, default to 1
        $currentPage = $request->input('page', 1);
        $perPage = 10; // Number of products per page

        // Fetch products from the API
        $response = Http::get('https://dummyjson.com/products');
        $products = $response->json()['products'] ?? [];

        // Paginate the products
        $totalProducts = count($products);
        $offset = ($currentPage - 1) * $perPage;
        $paginatedProducts = array_slice($products, $offset, $perPage);

        // Create a simple pagination structure
        $pagination = [
            'total' => $totalProducts,
            'current_page' => $currentPage,
            'last_page' => ceil($totalProducts / $perPage),
            'per_page' => $perPage,
            'next_page' => ($currentPage < ceil($totalProducts / $perPage)) ? $currentPage + 1 : null,
            'prev_page' => ($currentPage > 1) ? $currentPage - 1 : null,
        ];

        // Get cart items from session
        $cartItems = session('cart', []);

        // Pass products and cart items to the view
        return view('cart.index', [
            'cartItems' => $cartItems,
            'products' => $paginatedProducts,
            'pagination' => $pagination,
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