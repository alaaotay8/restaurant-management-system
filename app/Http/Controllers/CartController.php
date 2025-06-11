<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Table;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart with items and tables.
     */
    public function index()
    {
        $cartItems = Cart::with('product')->get();
        $tables = Table::all();
        return view('user_views.cart', compact('cartItems', 'tables'));
    }

    /**
     * Remove an item from the cart.
     */
    public function remove($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->back()->with('message', 'Item removed from cart successfully.');
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'pid' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('product_id', $request->pid)->first();

        if ($cart) {
            $cart->quantity += $request->qty;
            $cart->save();
        } else {
            Cart::create([
                'product_id' => $request->pid,
                'quantity' => $request->qty,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cartCount' => Cart::count(),
        ]);
    }

    /**
     * Update the quantity of a cart item.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->qty;
        $cart->save();

        return redirect()->back()->with('message', 'Cart updated successfully.');
    }

    /**
     * Clear all items from the cart.
     */
    public function clear()
    {
        Cart::truncate();

        return redirect()->back()->with('message', 'All items removed from cart.');
    }
}
