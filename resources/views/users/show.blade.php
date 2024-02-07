@extends('layouts.app')

@section('content')
    <h1>Products by {{ $user->username }}</h1>

    @foreach ($products as $product)
        <div class="product">
            <h2>{{ $product->title }}</h2>
            <p>{{ $product->body }}</p>
            <p>Posted on: {{ $product->created_at->format('m/d/Y') }}</p>
        </div>
    @endforeach

    {{ $products->links() }}
@endsection
