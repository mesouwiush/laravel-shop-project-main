@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="box-border p-10 border-4">
            <div class="flex flex-col justify-start items-start divide-y">
                <a href="{{ route('product management') }}" class="border border-l-4 border-gray-400 p-4 w-full rounded mt-2 ml-2">Product management</a>
                <a href="{{ route('categories management') }}" class="border border-l-4 border-gray-400 p-4 w-full rounded mt-2 ml-2">Categories management</a>
                <a href="{{ route('dashboard/2') }}" class="border border-l-4 border-gray-400 p-4 w-full rounded mt-2 ml-2">Dashboard</a>
            </div>
        </div>
    </div>

    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'moderator')
        <div class="w-8/12 bg-white p-6 rounded-lg mt-6 mx-auto">
            <h2 class="font-bold text-lg mb-4">Create Tags</h2>
            <form action="{{ route('tags.store') }}" method="post">
                @csrf
                <div class="mb-4">
                    <input type="text" id="tag" name="tag" placeholder="Enter tag" class="border-2 border-gray-400 p-2 w-full rounded">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Tag</button>
            </form>
        </div>

        <div class="w-8/12 bg-white p-6 rounded-lg mt-6 mx-auto">
            <h2 class="font-bold text-lg mb-4">Tags</h2>
            <table class="table-auto w-full border-collapse border-2 border-gray-500">
                <thead>
                    <tr>
                        <th class="border-2 border-gray-400">Tag Name</th>
                        <th class="border-2 border-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td class="border-2 border-gray-400">{{ $tag->name }}</td>
                            <td class="border-2 border-gray-400">
                                <a href="{{ route('tags.edit', $tag) }}" class="text-blue-500">Edit</a>
                                <form action="{{ route('tags.destroy', $tag) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="w-8/12 bg-white p-6 rounded-lg mt-6 mx-auto">
            <h2 class="font-bold text-lg mb-4">Create New Category</h2>
            <form action="{{ route('categories.store') }}" method="post">
                @csrf
                <div class="mb-4">
                    <input type="text" id="category" name="category" placeholder="Enter category" class="border-2 border-gray-400 p-2 w-full rounded">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Category</button>
            </form>

            <h2 class="font-bold text-lg mt-4 mb-2">Categories</h2>

            <table class="table-auto w-full border-collapse border-2 border-gray-500">
                <thead>
                    <tr>
                        <th class="border-2 border-gray-400">Category</th>
                        <th class="border-2 border-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="border-2 border-gray-400">{{ $category->name }}</td>
                            <td class="border-2 border-gray-400">
                                <a href="{{ route('tags.edit', $category) }}" class="text-blue-500">Edit</a>
                                <form action="{{ route('tags.destroy', $category) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection


