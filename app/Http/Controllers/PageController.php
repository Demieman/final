<?php

namespace App\Http\Controllers;

use App\Models\Product; // Ensure this import is present
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
      // Fetch all products
      $products = Product::all(); // Use this to get all products
        
      // Pass products to the view
      return view('home', compact('products'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}