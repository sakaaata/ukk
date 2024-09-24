<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(){
        $cartitem=cart::where('user_id',Auth::id())->with('food')->get();
        return view('cart.index',compact('cartitem'));
    }
    public function addToCart(Request $request,Food $food){
        $cart=cart::updateOrCreate([
            'user_id'=>Auth::id(),
            'food_id'=>$food->id,],[
                'quantity'=>DB::raw('quantity+1'),
            ]);
        return redirect()->route('dashboard');
    }
    public function removeFromCart($id)
{
    // Assuming you can find the cart item by its ID
    $cartItem = Cart::findOrFail($id);
    $cartItem->delete(); 

    return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
}

    public function updateQuantity(Request $request, $foodId)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    // Cari cart berdasarkan user_id dan food_id
    $cart = Cart::where('user_id', Auth::id())
                ->where('food_id', $foodId)
                ->first();

    if ($cart) {
        // Update quantity jika cart ditemukan
        $cart->update([
            'quantity' => $request->quantity,
        ]);
    }

    return redirect()->route('cart.index');
    }
}
