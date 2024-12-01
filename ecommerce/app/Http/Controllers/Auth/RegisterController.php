<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    // Show the registration form
    public function create()
    {
        return view('auth.register'); // Adjust the path as needed
    }

    // Handle the registration request
    public function store(Request $request)
    {
        // Validate the request
        $this->validator($request->all())->validate();

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Optionally, log in the user
        // auth()->login($user);

        // Redirect to a desired route after registration
        return redirect()->route('home')->with('success', 'Account created successfully!');
    }

    // Validate registration data
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
