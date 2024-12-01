<?php

namespace App\Http\Controllers;

use App\Models\Product; // Import the Product model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch all products from the database with pagination
        $products = Product::latest()->paginate(10); // Adjust the number of items per page as needed
        return view('home', compact('products')); // Pass the products to the view
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public'); // Store image in public storage
        }

        // Create a new product
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'image_url' => $imagePath, // Store the uploaded image path
        ]);

        // Redirect back to the products page with a success message
        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    public function show($id)
    {
        // Retrieve the product by ID
        $product = Product::findOrFail($id);

        // Return the view with the product data
        return view('products.show', compact('product'));
    }
}