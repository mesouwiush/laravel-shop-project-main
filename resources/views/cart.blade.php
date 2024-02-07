@extends('layouts.app')

@section('content')
    <h1>Yoursds Cart</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
            <tr>
                <td><img src="{{ asset('storage/images/' . $item->product->image) }}" alt="{{ $item->product->title }}"></td>
                <td>{{ $item->product->title }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->product->price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="alert alert-info">
        <h2>Total Price: {{ $totalPrice }}</h2>
    </div>

    <form action="{{ route('checkout.process') }}" method="get">
        @csrf
        <!-- Add your form fields here -->
        <button type="submit">Submit</button>
    </form>
@endsection
