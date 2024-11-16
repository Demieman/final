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
@endsection