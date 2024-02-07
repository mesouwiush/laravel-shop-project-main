<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index(Request $request)
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all(); // Fetch all categories
        $tags = Tag::all(); // Fetch all tags

        // Call the getCartData method to get the cart items and total price
        $cartData = app('App\Http\Controllers\CartController')->getCartData($request);

        // Merge the products, categories, tags, and cart data into one array
        $data = array_merge([
            'products' => $products, // Pass products to the view
            'categories' => $categories, // Pass categories to the view
            'tags' => $tags, // Pass tags to the view
        ], $cartData);

        // Pass the data to the view
        return view('products.index', $data);
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'image|nullable|max:5120',
            'category_id' => 'required|exists:categories,id', // validate category
            'tags' => 'required|array', // validate tags as an array
            'tags.*' => 'exists:tags,id', // validate each tag id exists
            'price' => 'required|numeric', // validate price
            'quantity' => 'required|integer', // validate quantity
        ]);

        // Handle file upload
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Replace spaces in the filename with underscores
            $filename = str_replace(' ', '_', $filename);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Product
        $products = new Product;
        $products->title = $request->input('title');
        $products->body = $request->input('body');
        $products->user_id = auth()->user()->id;
        $products->image = $fileNameToStore;
        $products->rating = $request->input('rating', 0); // Set a default rating of 0 if no rating is provided
        $products->category_id = $request->input('category_id'); // Assign the category to the products
        $products->price = $request->input('price'); // Set the price for the product
        $products->quantity = $request->input('quantity'); // Set the quantity for the product
        $products->save();


        // Attach tags to the products
        $products->tags()->attach($request->tags);

        return redirect('/products')->with('success', 'Product Created');
    }
    public function show(Product $products)
    {
        $products->load('comments');
        return view('products.show', ['products' => $products]);
    }

        public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('products');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products');
    }

}


