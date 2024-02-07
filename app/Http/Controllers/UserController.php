<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $products = $user->products()->paginate(10);
        return view('users.show', compact('products', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            // Add validation rules for other fields
        ]);

        $user->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function assignRole(User $user, Request $request)
    {
        $user->role = $request->role;
        $user->save();

        return back();
    }
    public function purchasedProducts(Request $request)
    {
        $purchasedProducts = PurchasedProduct::where('user_id', $request->user()->id)->get();

        return view('users.purchased_products', ['purchasedProducts' => $purchasedProducts]);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
