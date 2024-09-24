<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }
    public function create()
    {
        $cartItems = cart::where('user_id', Auth::id())->with('food')->get();
        $total = $cartItems->sum(function($item) {
            return $item->quantity * $item->food->price;
        });

        return view('orders.create', compact('cartItems', 'total'));
    }
    public function store(Request $request)
    {
        $cartItems = cart::where('user_id', Auth::id())->with('food')->get();
        $total = $cartItems->sum(function($item) {
            return $item->quantity * $item->food->price;
        });

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'pending'
        ]);

        // Tambahkan detail order jika diperlukan

        // Kosongkan keranjang
        cart::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat');
    }
    public function show(Order $order)
    {
        // Get all cart items associated with the user for this order
        $cartItems = Cart::where('user_id', $order->user_id)
                          ->with('food')  // Eager load the menu details
                          ->get();
    
        return view('orders.show', compact('order', 'cartItems'));
    }
}
