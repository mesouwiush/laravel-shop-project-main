@extends('layouts.app')

@section('content')

@foreach ($cartItems as $item)

    <div>

        <h2>{{ $item['title'] }}</h2>

        <p>Price: {{ $item['price'] }}</p>

        <p>Quantity: {{ $item['quantity'] }}</p>

    </div>

@endforeach

<h2>Total Price: {{ $totalPrice }}</h2>

<div class="container">

    <h2>Checkout</h2>

    <form method="POST" action="{{ route('checkout.process') }}">

        @csrf

        <div class="form-group">

            <label for="address">Address</label>

            <input type="text" class="form-control" id="address" name="address" required>

        </div>

        <div class="form-group">

            <label for="card_name">Card Holder Name</label>

            <input type="text" class="form-control" id="card_name" name="card_name" required>

        </div>

        <div class="form-group">

            <label for="card_number">Card Number</label>

            <input type="text" class="form-control" id="card_number" name="card_number" required>

        </div>

        <button type="submit" class="btn btn-primary">Checkout</button>

    </form>

</div>

@endsection
