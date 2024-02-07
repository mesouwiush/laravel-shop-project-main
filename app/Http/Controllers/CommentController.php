<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'body'=>'required',
        ]);

        $comment = new Comment([
            'body' => $request->get('body'),
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        $comment->save();
        return back();
    }
}
