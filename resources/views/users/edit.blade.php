@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>

    <form action="{{ route('users.update', $user) }}" method="post">
        @csrf
        @method('PUT')

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}">

        <button type="submit">Update User</button>
    </form>
@endsection
