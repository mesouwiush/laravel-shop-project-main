@extends('layouts.app')

@section('content')
    <h1>Edit Tag</h1>

    <form method="POST" action="{{ route('tags.update', ['tag' => $tag->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="tag">Tag Name</label>
            <input type="text" id="tag" name="tag" value="{{ $tag->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Tag</button>
    </form>
@endsection
