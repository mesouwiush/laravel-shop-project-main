<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        $users = User::all();
        $tags = Tag::all();
        $categories = Category::all();
        $products = Product::with(['tags', 'categories', 'user'])->get();
        $orders = Order::all();

        return view('dashboard', compact('users', 'tags', 'categories', 'products', 'orders'));
    }

    public function pm()
    {
        $users = User::all();
        $tags = Tag::all();
        $categories = Category::all();
        $products = Product::with(['tags', 'categories', 'user'])->get();
        $orders = Order::all();

        return view('product management', compact('users', 'tags', 'categories', 'products', 'orders'));
    }

    public function cm()
    {
        $users = User::all();
        $tags = Tag::all();
        $categories = Category::all();

        return view('categories management', compact('users', 'tags', 'categories'));
    }
    
}
