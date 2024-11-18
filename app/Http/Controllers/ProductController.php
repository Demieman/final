<?php

namespace App\Http\Controllers;

use App\Models\Product; // Import the Product model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch all products from the database
        $products = Product::latest()->paginate(10); // Adjust the number of items per page as needed
    return view('home', compact('products'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'image_url' => 'required|url' // Add validation for the image URL
        ]);

        // Create a new product
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'image_url' => $request->image_url, // Include the image URL
        ]);

        // Redirect back to the products page with a success message
        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }
}