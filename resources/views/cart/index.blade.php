@extends('layouts.app')

@section('content')
    <h1>Your Cart</h1>

    <div>
        @foreach($products as $product)
            <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
                <h2>{{ $product['title'] }}</h2>
                
                <!-- Display product image -->
                <img src="{{ $product['images'][0] }}" alt="{{ $product['title'] }}" style="max-width: 200px; height: auto;">

                <p>{{ $product['description'] }}</p>
                <p>Price: ${{ $product['price'] }}</p>
                <form action="{{ route('cart.add', $product['id']) }}" method="POST">
                    @csrf
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        @endforeach
    </div>

    <div>
        <h3>Pagination</h3>
        @if ($pagination['prev_page'])
            <a href="{{ route('cart.show', ['page' => $pagination['prev_page']]) }}">Previous</a>
        @endif

        <span>Page {{ $pagination['current_page'] }} of {{ $pagination['last_page'] }}</span>

        @if ($pagination['next_page'])
            <a href="{{ route('cart.show', ['page' => $pagination['next_page']]) }}">Next</a>
        @endif
    </div>
@endsection