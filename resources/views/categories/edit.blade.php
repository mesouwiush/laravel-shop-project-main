@extends('layouts.app')

@section('content')
    <h1>Edit Category</h1>

    <form method="POST" action="{{ route('categories.update', ['category' => $category->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="category">Category Name</label>
            <input type="text" id="category" name="category" value="{{ $category->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
@endsection
