<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use App\Models\Table;

class OrdersController extends Controller
{
    /**
     * Display a listing of pending orders.
     */
    public function pendingOrders()
    {
        $orders = Order::where('payment_status', 'pending')->orderBy('created_at', 'desc')->get();
        return view('orders.show_orders', compact('orders'));
    }

    /**
     * Display a listing of completed orders.
     */
    public function completedOrders()
    {
        $orders = Order::where('payment_status', 'completed')->orderBy('created_at', 'desc')->get();
        return view('orders.show_orders', compact('orders'));
    }

    /**
     * Display a listing of all orders.
     */
    public function allOrders()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('orders.show_orders', compact('orders'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $tables = Table::all();
        $products = Product::all();

        if (!$order) {
            return redirect()->route('admin.orders')->with('error', 'Order not found');
        }

        return view('orders.update_order', compact('order', 'tables', 'products'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'remarks' => 'nullable|string|max:300',
            'payment_status' => 'required|in:pending,completed',
            'order_products' => 'required|array',
        ]);

        $orderProducts = [];
        $totalProducts = 0;
        $totalPrice = 0;

        foreach ($request->order_products as $productId => $productData) {
            $quantity = intval($productData['quantity']);
            if ($quantity > 0) {
                $product = Product::find($productId);
                if ($product) {
                    $orderProducts[] = [
                        'id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->price,
                    ];
                    $totalProducts += $quantity;
                    $totalPrice += $product->price * $quantity;
                }
            }
        }

        $order->table_id = $request->table_id;
        $order->order_products = json_encode($orderProducts);
        $order->total_products = $totalProducts;
        $order->total_price = $totalPrice;
        $order->remarks = $request->remarks;
        $order->payment_status = $request->payment_status;
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders')->with('success', 'Order deleted successfully!');
    }
}
