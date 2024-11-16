<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display orders
        return view('orders.index'); // Adjust the view name as needed
    }
}