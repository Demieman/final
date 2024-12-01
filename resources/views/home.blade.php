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
    <h2>Latest Products</h2>
    
    <div class="product-grid">
        @if(isset($products) && $products->count())
            @foreach ($products as $product)
                <div class="product-item">
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="product-image">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <p>Price: ${{ number_format($product->price, 2) }}</p>
                    <a href="{{ route('products.show', $product->id) }}" class="view-button">View Details</a>
                </div>
            @endforeach
        @else
            <p>No products available at the moment.</p>
        @endif
    </div>

    <div class="pagination">
        {{ $products->links() }} <!-- Pagination links -->
    </div>
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

        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px 0;
        }

        .product-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            width: 200px;
            text-align: center;
        }

        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .view-button {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .view-button:hover {
            background-color: #0056b3;
        }

        .pagination {
            margin-top: 20px;
        }
    </style>
@endsection