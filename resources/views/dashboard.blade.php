@extends('layouts.app')

@section('content')

<div class="flex flex-col divide-y">
    <a href="{{ route('product management') }}" class="border border-l-4 border-gray-400 p-4 w-1/6 rounded mt-2 ml-2">Product management</a>
    <a href="{{ route('categories management') }}" class="border border-l-4 border-gray-400 p-4 w-1/6 rounded mt-2 ml-2">Categories management</a>
    <a href="{{ route('dashboard/2') }}" class="border border-l-4 border-gray-400 p-4 w-1/6 rounded mt-2 ml-2">03</a>
</div>




    <div class="flex justify-center py-5">

    
        @auth
        <!--<div class="px-6 font-semibold text-md "><a href=""> Hello {{ auth()->user()->name }} </a></div>-->
        @endauth
        <div class="w-8/12 bg-white p-6 rounded-lg">
            Dashboard
            <table class="table-auto w-full border-collapse border-2 border-gray-500">
                <thead>
                    <tr>
                        <th class="border-2 border-gray-400">Name</th>
                        <th class="border-2 border-gray-400">Email</th>
                        <th class="border-2 border-gray-400">Role</th>
                        <th class="border-2 border-gray-400">Assign Role</th>
                        <th class="border-2 border-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="border-2 border-gray-400">{{ $user->name }}</td>
                            <td class="border-2 border-gray-400">{{ $user->email }}</td>
                            <td class="border-2 border-gray-400">{{ $user->role }}</td>
                            <td class="border-2 border-gray-400">
                                <form action="{{ route('user.assignRole', $user) }}" method="post">
                                    @csrf
                                    <select name="role" id="role">
                                        <option value="admin">Admin</option>
                                        <option value="moderator">Moderator</option>
                                        <option value="user">User</option>
                                    </select>
                                    <button type="submit">Assign Role</button>
                                </form>
                            </td>
                            <td class="border-2 border-gray-400">
                                <a href="{{ route('users.edit', $user) }}">Edit</a>
                                <form action="{{ route('users.destroy', $user) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!--<form action="{{ route('products') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="flex justify-center mb-4">
            <label for="title" class="sr-only">Title</label>
            <div class="w-1/3">
                <input type="text" name="title" id="title" placeholder="Product title" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror">
                @error('title')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>
    -->

        <!--<div class="mb-4">
            <label for="body" class="sr-only">Body</label>
            <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>
            @error('body')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>
    -->
       <!-- <div class="mb-4">
            <label for="image" class="sr-only">Image</label>
            <input type="file" name="image" id="image" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('image') border-red-500 @enderror">
            @error('image')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>
    
      <!border-red-500  <div class="mb-4">
            <label for="category_id" class="sr-only">Category</label>
            <select name="category_id" id="category_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('category_id') border-red-500 @enderror">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
         -->   </div>
    
       <!-- <div class="mb-4">
            <label for="price" class="sr-only">Price</label>
            <input type="number" step="0.01" name="price" id="price" placeholder="Product price" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('price') border-red-500 @enderror">
            @error('price')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
       -->  </div>

      <!--  <div class="mb-4">
            <label for="quantity" class="sr-only">Quantity</label>
            <input type="number" name="quantity" id="quantity" placeholder="Product quantity" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('quantity') border-red-500 @enderror">
            @error('quantity')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="tags" class="sr-only">Tags</label>
            <select name="tags[]" id="tags" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('tags') border-red-500 @enderror" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            @error('tags')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>
    -->
       <!-- <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
        </div>
    </form>
-->

    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'moderator')
    <div class="w-8/12 bg-white p-6 rounded-lg mt-6">
        <h2 class="font-bold text-lg mb-4">Create Tags and Categories</h2>
        <table class="table-auto w-full border-collapse border-2 border-gray-500">
            <thead>
                <tr>
                    <th class="border-2 border-gray-400">Tag</th>
                    <th class="border-2 border-gray-400">Category</th>
                    <th class="border-2 border-gray-400">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="{{ route('tags.store') }}" method="post">
                        @csrf
                        <td class="border-2 border-gray-400">
                            <input type="text" id="tag" name="tag" placeholder="Enter tag">
                        </td>
                        <td class="border-2 border-gray-400"></td>
                        <td class="border-2 border-gray-400">
                            <button type="submit">Create Tag</button>
                        </td>
                    </form>
                </tr>
                <tr>
                    <form action="{{ route('categories.store') }}" method="post">
                        @csrf
                        <td class="border-2 border-gray-400"></td>
                        <td class="border-2 border-gray-400">
                            <input type="text" id="category" name="category" placeholder="Enter category">
                        </td>
                        <td class="border-2 border-gray-400">
                            <button type="submit">Create Category</button>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
@endif


    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'moderator')
        <div class="w-8/12 bg-white p-6 rounded-lg mt-6">
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
                                <a href="{{ route('tags.edit', $tag) }}">Edit</a>
                                <form action="{{ route('tags.destroy', $tag) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="w-8/12 bg-white p-6 rounded-lg mt-6">
            <h2 class="font-bold text-lg mb-4">Categories</h2>
            <table class="table-auto w-full border-collapse border-2 border-gray-500">
                <thead>
                    <tr>
                        <th class="border-2 border-gray-400">Category Name</th>
                        <th class="border-2 border-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="border-2 border-gray-400">{{ $category->name }}</td>
                            <td class="border-2 border-gray-400">
                                <a href="{{ route('categories.edit', $category) }}">Edit</a>
                                <form action="{{ route('categories.destroy', $category) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Image</th>
                <th>Excerpt</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->title }}</td>
                <td>{{ $product->user->name }}</td>
                <td> <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image" width="100"></td>
                <td>{{ Str::limit($product->body, 100) }}</td>
                <td>{{ $product->created_at->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('products.edit', $product) }}">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @foreach ($orders as $order)
    <p>Order ID: {{ $order->id }}</p>
    <p>Order Total: {{ $order->total_price }}</p>
    <p>Order Date: {{ $order->created_at }}</p>
@endforeach

<form method="POST" action="{{ route('send.email') }}">

    @csrf

    <button type="submit">Send Email</button>

</form>
@endsection
