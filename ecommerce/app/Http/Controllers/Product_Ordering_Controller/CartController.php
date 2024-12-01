<?php

namespace App\Http\Controllers\Product_Ordering_Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        return view('Product-Order-Screens.Cart'); // Returns the cart view
    }

    public function addtocart(Request $request)
    {
        // Server-side validation starts here
        $validator = Validator::make($request->all(), [
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $prod_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $product = Products::find($prod_id);

        // If the product does not exist
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $prod_name = $product->name;
        $prod_image = $product->image1;
        $delivery_charges = $product->delivery_charges;
        $priceval = $product->price;
        $discount = $product->discount;

        // Calculate prices
        $offerprice = $priceval * ($discount / 100);
        $final_price = $priceval - $offerprice;
        $content_for_offer_price = $discount . " % Discount is Applied ";

        // Retrieve the current cart
        $cart = session()->get('cart', []);

        // If cart is empty, this is the first product
        if (!isset($cart[$prod_id])) {
            $cart[$prod_id] = [
                'item_id' => $prod_id,
                'item_name' => $prod_name,
                'item_quantity' => $quantity,
                'item_image' => $prod_image,
                'item_price' => $priceval,
                'offer_price' => $offerprice,
                'delivery_charges' => $delivery_charges,
                'Final_Price' => $final_price,
                'content_for_offer_price' => $content_for_offer_price,
            ];
            session()->put('cart', $cart);
            return response()->json(['status' => 'Added to Cart']);
        }

        // If the product already exists in the cart
        return response()->json(['status' => 'Product is Already Added to Cart']);
    }

    public function alter_quantity(Request $request)
    {
        // Server-side validation starts here
        $validator = Validator::make($request->all(), [
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $prod_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $cart = session()->get('cart');

        if (isset($cart[$prod_id])) {
            // Adjust quantity based on the input
            $cart[$prod_id]['item_quantity'] = $quantity;
            session()->put('cart', $cart);
            return response()->json(['status' => 'Quantity updated']);
        }

        return response()->json(['error' => 'Product not found in cart'], 404);
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
                session()->flash('success', 'Product removed successfully');
                return back()->with('status', 'Product removed from cart');
            }
        }

        return back()->with('error', 'Product not found');
    }

    public function clear(Request $request)
    {
        Session::forget('cart');
        session()->flash('success', 'Cart is cleared');
        return back()->with('cartclear', 'Cart is cleared');
    }
}
