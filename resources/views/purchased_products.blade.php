@extends('layouts.app')

@section('content')
<h1>Purchased Products</h1>

<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Purchase Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($purchasedProducts as $product)
        <tr>
            <td>{{ $product->product->name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->purchase_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
