@extends('layouts.app')

@section('content')
@if ($products)
@foreach ($products as $product)
    <div class="product">
        <h2>{{ $product->title }}</h2>
        <p>{{ $product->body }}</p>
        <p>Posted on: {{ $product->created_at->format('m/d/Y') }}</p>
    </div>
@endforeach
@else
<p>No products found for this category.</p>
@endif
@endsection
