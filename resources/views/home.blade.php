@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <header>
        <h1>Welcome to Our E-Commerce Store!</h1>
        <nav>
            
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('products.index') }}">View Products</a></li>
                <li><a href="{{ route('cart.index') }}">Shopping Cart</a></li>
                <li><a href="{{ route('orders.index') }}">Your Orders</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                @auth
                    <li><form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Logout</button>
                    </form></li>
                @endauth
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endguest
            
        </nav>
    </header>
    
    <section>
        <p>Explore our wide range of products.</p>
    </section>
@endsection