@extends('layouts.app')

@section('content')
    <h1>Yours Cart</h1>

    @foreach ($cartItems as $item)
        <div>
            <h2>{{ $item->name }}</h2>
            <p>{{ $item->description }}</p>
            <p>{{ $item->price }}</p>
        </div>
    @endforeach
@endsection
