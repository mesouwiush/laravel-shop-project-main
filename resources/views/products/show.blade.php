@extends('layouts.app')

@section('content')
    <h1>{{ $product->title }}</h1>
    <p>{{ $product->body }}</p>

    <form method="POST" action="{{ route('comments.store', ['product' => $product->id]) }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <textarea name="body"></textarea>
        <button type="submit">Submit</button>
    </form>
    <form method="POST" action="{{ route('product-ratings.store', $product) }}">
        @csrf
        <select name="rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <button type="submit">Submit Rating</button>
    </form>
    @foreach ($product->comments as $comment)
    <div>
        <p>{{ $comment->body }}</p>
        <p>Posted by: {{ $comment->user->name }}</p>
    </div>
@endforeach

@endsection
