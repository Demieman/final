<?php
namespace App\Http\Controllers\Product_Ordering_Controller;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index($purl)
    {
        // Retrieve the product based on the URL
        $product = Products::where('url', $purl)->first();

        // Check if the product was found
        if (!$product) {
            // Handle the case where the product does not exist
            return redirect()->route('home')->with('error', 'Product not found.');
        }

        // Pass the product to the view if found
        return view('Product-Order-Screens.Product_Page')->with('Product', $product);
    }
}
