@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="box-border p-10 border-4">
            <div class="flex flex-col justify-start items-start divide-y">
                <a href="{{ route('product management') }}"
                    class="border border-l-4 border-gray-400 p-4 w-full rounded mt-2 ml-2">Product management</a>
                <a href="{{ route('categories management') }}"
                    class="border border-l-4 border-gray-400 p-4 w-full rounded mt-2 ml-2">Categories management</a>
                <a href="{{ route('dashboard/2') }}"
                    class="border border-l-4 border-gray-400 p-4 w-full rounded mt-2 ml-2">Dashboard</a>
            </div>
        </div>
        <div class="w-8/12">
            <form action="{{ route('products') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-center mb-4 mt-20">
                    <label for="title" class="sr-only">Title</label>
                    <div class="w-1/3">
                        <input type="text" name="title" id="title" placeholder="Product title"
                            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror">
                        @error('title')
                            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-center mb-4 mt-3">
                    <label for="body" class="sr-only">Body</label>
                    <div class="w-1/3">
                        <textarea name="body" id="body" cols="30" rows="1"
                            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
                            placeholder="Product description"></textarea>
                        @error('body')
                            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-center mb-4 mt-3">
                    <label for="image" class="sr-only">Image</label>
                    <div class="w-1/3">
                        <input type="file" name="image" id="image"
                            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('image') border-red-500 @enderror">
                        @error('image')
                            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-center mb-4 mt-3">
                    <label for="category_id" class="sr-only">Category</label>
                    <div class="w-1/3">
                        <select name="category_id" id="category_id"
                            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('category_id') border-red-500 @enderror">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                        <div class="mb-4 mt-4">
                            <label for="price" class="sr-only">Price</label>
                            <input type="number" step="0.01" name="price" id="price" placeholder="Product price"
                                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('price') border-red-500 @enderror">
                            @error('price')
                                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                            @enderror
                            <div class="mb-4 mt-4">
                                <label for="quantity" class="sr-only">Quantity</label>
                                <input type="number" name="quantity" id="quantity" placeholder="Product quantity"
                                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('quantity') border-red-500 @enderror">
                                @error('quantity')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                                <div class="mb-4 mt-4">
                                    <label for="tags" class="sr-only">Tags</label>
                                    <select name="tags[]" id="tags"
                                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('tags') border-red-500 @enderror"
                                        multiple>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tags')
                                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                    @enderror

                                    <div>
                                        <div class=" mt-3">
                                            <button type="submit"
                                                class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
