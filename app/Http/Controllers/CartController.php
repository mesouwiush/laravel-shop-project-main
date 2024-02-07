<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

public function index()
{
    $cartItems = auth()->user()->cartItems;

    $totalPrice = auth()->user()->cartItems()
        ->join('products', 'cart_items.product_id', '=', 'products.id')
        ->sum(DB::raw('products.price * cart_items.quantity'));

    return view('cart', ['cartItems' => $cartItems, 'totalPrice' => $totalPrice]);
}
public function addToCart(Request $request)
{
    $validatedData = $request->validate([
        'quantity' => 'required|integer',
        'product_id' => 'required|integer',
    ]);

    $product = Product::find($validatedData['product_id']);

    if (!$product) {
        return back()->with('error', 'Product not found');
    }

    $requestedQuantity = $validatedData['quantity'];

    if ($product->quantity < $requestedQuantity) {
        return back()->with('error', 'Requested quantity exceeds product quantity');
    }

    // Add the product to the user's cart items in the database
    $cartItem = auth()->user()->cartItems()->firstOrCreate(
        ['product_id' => $product->id],
        ['quantity' => 0]
    );

    $cartItem->increment('quantity', $requestedQuantity);

    return redirect()->route('cart.show')->with('success', 'Product added to cart');
}

    public function getCartData(Request $request)
    {
        $cartItems = $request->user()->cartItems()->with('product')->paginate(5); // Adjust the number as needed

        $totalPrice = $request->user()->cartItems()
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->sum(DB::raw('products.price * cart_items.quantity'));

        // Return an array
        return [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
        ];
    }

    public function showCart(Request $request)
    {
        $cartData = $this->getCartData($request);

        // Return a view
        return view('cart', $cartData);
    }
    public function checkout()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();

        // Calculate the total price
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $itemTotal = $item->product->price * $item->quantity;
            $totalPrice += $itemTotal;
            error_log('Item total: ' . $itemTotal);
        }
        error_log('Total price: ' . $totalPrice);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('thankyou');
    }

    public function checkoutForm()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        // Calculate the total price of the cart items
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }

        return view('checkout', ['cartItems' => $cartItems, 'totalPrice' => $totalPrice]);
    }
    public function checkoutProcess(Request $request)
    {
        // Validate the request data
        $request->validate([
            'address' => 'required|string|not_in:null',
            'card_name' => 'required',
            'card_number' => 'required|numeric',
        ]);

        // Retrieve the cart items
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

        // Calculate the total price of the cart items
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }

        // Create an order with the cart items
        $order = Order::create([
            'user_id' => auth()->id(),
            'address' => $request->address,
            'card_name' => $request->card_name,
            'card_number' => $request->card_number,
            'total_price' => $totalPrice, // Include this line
        ]);

        // Update the total price of the order
        $order->updateTotalPrice($order, $totalPrice);

        // Add the cart items to the order
        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        }

        // Clear the cart
        Cart::where('user_id', auth()->id())->delete();

        // Clear the user's cart items
        auth()->user()->cartItems()->delete();

        // Clear the session data for the cart
        session()->forget('cart');
        session()->forget('totalPrice');

        // Redirect the user to a "Thank You" page
        return redirect()->route('thankyou');
    }

    public function showCheckoutPage()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();

        // Calculate the total price of the cart items
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }

        return view('checkout', ['cartItems' => $cartItems, 'totalPrice' => $totalPrice]);
    }


}
