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
     * Show all pending orders.
     */
    public function pendingOrders()
    {
        $orders = Order::where('payment_status', 'pending')->orderBy('created_at', 'desc')->get();
        return view('orders.show_orders', compact('orders'));
    }

    /**
     * Show all completed orders.
     */
    public function completedOrders()
    {
        $orders = Order::where('payment_status', 'completed')->orderBy('created_at', 'desc')->get();
        return view('orders.show_orders', compact('orders'));
    }

    /**
     * Show all orders.
     */
    public function allOrders()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('orders.show_orders', compact('orders'));
    }

    /**
     * Show the form to create a new order.
     */
    public function create()
    {
        $categories = Category::with('products')->get();
        $tables = Table::all();
        return view('orders.create_order', compact('categories', 'tables'));
    }

    /**
     * Store a new order in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'selected_products' => 'required|array',
            'selected_products.*' => 'required|exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
            'remarks' => 'nullable|string|max:300',
            'payment_status' => 'required|string|in:pending,completed'
        ]);

        $table = Table::findOrFail($request->table_id);

        // Prevent double-reserving a table
        if ($table->is_reserved) {
            return redirect()->back()->with('error', 'Table is already reserved. Please choose another table.');
        }

        $table->is_reserved = true;
        $table->save();

        $orderProducts = [];
        $totalProducts = 0;
        $totalPrice = 0;

        // Build the order products array and calculate totals
        foreach ($request->selected_products as $productId) {
            $quantity = $request->quantities[$productId];
            $productModel = Product::findOrFail($productId);

            $orderProducts[] = [
                'id' => $productId,
                'quantity' => $quantity,
                'price' => $productModel->price
            ];

            $totalProducts += $quantity;
            $totalPrice += $productModel->price * $quantity;
        }

        $orderData = [
            'table_id' => $table->id,
            'order_products' => json_encode($orderProducts),
            'total_products' => $totalProducts,
            'total_price' => $totalPrice,
            'remarks' => $request->remarks,
            'payment_status' => $request->payment_status,
        ];

        Order::create($orderData);

        return redirect()->route('admin.orders')->with('message', 'Order added successfully');
    }

    /**
     * Update the payment status of an order.
     */
    public function updatePaymentStatus(Request $request)
    {
        $order = Order::findOrFail($request->input('order_id'));
        $newStatus = $request->input('payment_status');

        if (!is_null($newStatus)) {
            $order->payment_status = $newStatus;
            $order->save();

            // Free the table if the order is completed
            $table = Table::find($order->table_id);
            if ($table) {
                $table->is_reserved = $newStatus === 'completed' ? false : $table->is_reserved;
                $table->save();
            }

            return redirect()->route('admin.orders')->with('message', 'Payment status updated successfully');
        }

        return redirect()->route('admin.orders')->with('message', 'Choose another Payment status');
    }

    /**
     * Show the form to edit an order.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $categories = Category::with('products')->get();
        $tables = Table::all();
        return view('orders.update_order', compact('order', 'categories', 'tables'));
    }

    /**
     * Update an existing order.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'order_products' => 'required|array',
            'order_products.*.id' => 'required|exists:products,id',
            'order_products.*.quantity' => 'required|integer|min:0',
            'remarks' => 'nullable|string|max:300',
            'payment_status' => 'required|string|in:pending,completed',
            'order_products.*.id' => 'nullable|exists:products,id',
            'order_products.*.quantity' => 'nullable|integer|min:0',
        ]);

        $order = Order::findOrFail($id);
        $table = Table::findOrFail($request->table_id);

        // Prevent double-reserving a table unless it's the same as before
        if ($table->is_reserved && $table->id != $order->table_id) {
            return redirect()->back()->with('error', 'Table is already reserved. Please choose another table.');
        }

        // Free up the previous table if changed
        if ($order->table_id != $table->id) {
            $previousTable = Table::find($order->table_id);
            if ($previousTable) {
                $previousTable->is_reserved = false;
                $previousTable->save();
            }
        }

        // Mark the new table as reserved
        $table->is_reserved = true;
        $table->save();

        // Prepare the order products and calculate totals
        $orderProducts = [];
        $totalProducts = 0;
        $totalPrice = 0;

        foreach ($request->order_products as $product) {
            if (!isset($product['id']) || !isset($product['quantity'])) continue;

            $quantity = intval($product['quantity']);
            if ($quantity > 0) {
                $productModel = Product::findOrFail($product['id']);
                $totalProducts += $quantity;
                $totalPrice += $productModel->price * $quantity;
                $orderProducts[] = [
                    'id' => $productModel->id,
                    'quantity' => $quantity,
                    'price' => $productModel->price
                ];
            }
        }

        // Update the order
        $order->table_id = $table->id;
        $order->order_products = json_encode($orderProducts);
        $order->remarks = $request->input('remarks');
        $order->payment_status = $request->input('payment_status');
        $order->total_products = $totalProducts;
        $order->total_price = $totalPrice;
        $order->save();

        // Free up the table if the payment status is completed
        if ($order->payment_status === 'completed') {
            $table->is_reserved = false;
            $table->save();
        }

        return redirect()->route('admin.orders')->with('message', 'Order updated successfully.');
    }

    /**
     * Delete an order and free its table.
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            // Free the table when the order is deleted
            $table = Table::find($order->table_id);
            if ($table) {
                $table->is_reserved = false;
                $table->save();
            }
            $order->delete();
            return redirect()->route('admin.orders')->with('message', 'Order deleted!');
        }
        return redirect()->route('admin.orders')->with('error', 'Order not found!');
    }

    /**
     * Create an order from the cart contents.
     */
    public function createFromCart(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'remarks' => 'nullable|string|max:300',
        ]);

        $clientName = 'Client';
        $cartItems = \App\Models\Cart::all(); // You can filter by client if needed

        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Your cart is empty.']);
        }

        $orderProducts = [];
        $totalProducts = 0;
        $totalPrice = 0;

        // Build the order products array and calculate totals
        foreach ($cartItems as $item) {
            $orderProducts[] = [
                'id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ];
            $totalProducts += $item->quantity;
            $totalPrice += $item->product->price * $item->quantity;
        }

        $orderData = [
            'table_id' => $request->table_id,
            'order_products' => json_encode($orderProducts),
            'total_products' => $totalProducts,
            'total_price' => $totalPrice,
            'remarks' => $request->remarks,
            'payment_status' => 'pending',
            'placed_on' => now(),
            'client_name' => $clientName,
        ];

        $order = Order::create($orderData);

        // Clear the cart after placing the order
        \App\Models\Cart::truncate();

        // Mark the table as reserved
        $table = \App\Models\Table::find($request->table_id);
        if ($table) {
            $table->is_reserved = true;
            $table->save();
        }

        return response()->json(['success' => true, 'message' => 'Order confirmed!']);
    }
}
