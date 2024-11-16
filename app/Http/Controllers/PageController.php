<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home'); // Return the home view
    }

    public function about()
    {
        return view('about'); // You will create this view
    }

    public function contact()
    {
        return view('contact'); // You will create this view
    }
}
