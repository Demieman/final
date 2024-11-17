@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <header>
        <h1>Welcome to Our E-Commerce Store!</h1>
        <nav>
            <ul class="nav-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('products.index') }}">View Products</a></li>
                <li><a href="{{ route('cart.index') }}">Shopping Cart</a></li>
                <li><a href="{{ route('orders.index') }}">Your Orders</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                @auth
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="logout-button">Logout</button>
                        </form>
                    </li>
                @endauth
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endguest
            </ul>
        </nav>
    </header>
    
    <section>
        <p>Explore our wide range of products.</p>
    </section>

    <style>
        header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
        }

        .nav-list {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .nav-list li {
            margin: 0 15px;
        }

        .nav-list a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .nav-list a:hover {
            text-decoration: underline;
        }

        .logout-button {
            background: none;
            border: none;
            color: #007bff;
            font-weight: bold;
            cursor: pointer;
        }

        .logout-button:hover {
            text-decoration: underline;
        }

        section {
            margin-top: 20px;
            text-align: center;
        }
    </style>
@endsection