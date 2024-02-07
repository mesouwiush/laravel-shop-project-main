<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tag' => 'required|max:255|unique:tags,name',
        ]);

        $tag = new Tag;
        $tag->name = $request->tag;
        $tag->save();

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $products = $tag->products;
        return view('tags.show', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'tag' => 'required|max:255|unique:tags,name,' . $tag->id,
        ]);

        $tag->name = $request->tag;
        $tag->save();

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return back();
    }
}
