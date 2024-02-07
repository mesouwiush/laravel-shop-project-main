@extends('layouts.app')

@section('content')
    <h1>Yours Cart</h1>

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
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->product->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="alert alert-info">
        <h2>Total Price: {{ $totalPrice }}</h2>
    </div>
@endsection
