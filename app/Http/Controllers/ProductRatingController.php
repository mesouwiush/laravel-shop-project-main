<?php

// app/Http/Controllers/ProductRatingController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id); // replace $id with the actual product id

        $userRating = Rating::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first()
            ->rating ?? null;

        $averageRating = Rating::where('product_id', $product->id)
            ->average('rating');

        return view('index', compact('product', 'userRating', 'averageRating'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
        ]);

        // Check if the user has already rated the product
        $existingRating = Rating::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingRating) {
            // If the user has already rated the product, update the existing rating
            $existingRating->rating = $request->rating;
            $existingRating->save();
        } else {
            // If the user hasn't rated the product yet, save the new rating
            Rating::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'rating' => $request->rating, // set the 'rating' field
            ]);
        }

        // Update the product's average rating
        $product->rating = round(Rating::where('product_id', $product->id)->average('rating'));
        $product->save();

        return back();
    }

}
?>
