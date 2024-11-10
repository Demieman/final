<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Load the dashboard view
        return view('Dashboard.dashboard'); // Adjust the path as needed
    }

    public function home()
    {
        // Load the home view
        return view('dashboard.home'); // Adjust the path as needed
    }
}