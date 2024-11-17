@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
    <h2>Your Shopping Cart</h2>
    <ul>
        @if(!empty($cartItems))
            @foreach ($cartItems as $item)
                <li>{{ $item['name'] }} - ${{ $item['price'] }} (Quantity: {{ $item['quantity'] }})</li>
            @endforeach
        @else
            <li>Your cart is empty.</li>
        @endif
    </ul>

    <h2>Available Products</h2>
    <ul>
        @if(!empty($products))
            @foreach ($products as $product)
                <li>
                    {{ $product['title'] }} - ${{ $product['price'] }}
                    <form action="{{ route('cart.add', $product['id']) }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" min="1" value="1">
                        <button type="submit">Add to Cart</button>
                    </form>
                </li>
            @endforeach
        @else
            <li>No products available.</li>
        @endif
    </ul>
@endsection