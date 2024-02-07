@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Checkout</h2>
    <form action="{{ route('checkout.process') }}" method="post">
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
        <div class="form-group">
            <label for="card_expiration">Card Expiration Date</label>
            <input type="month" class="form-control" id="card_expiration" name="card_expiration" required>
        </div>
        <div class="form-group">
            <label for="card_cvv">Card CVV</label>
            <input type="text" class="form-control" id="card_cvv" name="card_cvv" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
