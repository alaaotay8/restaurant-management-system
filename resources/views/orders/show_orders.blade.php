{{-- filepath: resources/views/orders/show_orders.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placed Orders</title>
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<section class="placed-orders">
    {{-- Show the add button only if you are on all orders --}}
    @if(Route::currentRouteName() == 'admin.orders')
        <h1 class="heading" style="padding-top: 5.2rem">Add Order</h1>
        <div class="register-btn-container" style="display: flex; justify-content: center; margin: 20px 0;">
            <a href="{{ route('orders.create') }}" class="option-btn add-order" style="width: 300px; margin: 0 10px;">Add new order</a>
        </div>
    @endif

    {{-- Title based on the route name --}}
    @if(Route::currentRouteName() == 'admin.orders')
        <h1 class="heading">All Orders</h1>
    @elseif(Route::currentRouteName() == 'orders.pending')
        <h1 class="heading">Pending Orders</h1>
    @elseif(Route::currentRouteName() == 'orders.completed')
        <h1 class="heading">Completed Orders</h1>
    @endif

    <div class="box-container">
        @if($orders->isEmpty())
            <p class="empty">No orders placed yet!</p>
        @else
            @foreach($orders as $order)
                <div class="box">
                    <p> User ID: <span>{{ $order->user_id ?? 'Client' }}</span> </p>
                    <p> Placed on: <span>{{ $order->created_at }}</span> </p>
                    <p> Table Number: <span>{{ $order->table->table_number }}</span> </p>
                    <p> Total Products: <span>{{ $order->total_products }}</span> </p>
                    <p> Total Price: <span>{{ $order->total_price }} DT</span> </p>
                    <p> Payment Status: <span>{{ $order->payment_status }}</span> </p>
                    <p class="ordered-products"> Ordered Products:
                        <div class="box">
                            <ul class="items" id="its">
                                @foreach(json_decode($order->order_products, true) as $product)
                                    @php
                                        $productModel = App\Models\Product::find($product['id']);
                                    @endphp
                                    @if($productModel)
                                        <li id="li-ordered-pr">
                                            <span id="span-name">{{ $productModel->name }} | </span>
                                            <span id="span-qty">Quantity: {{ $product['quantity'] }} </span>
                                            <span id="span-price">| {{ $productModel->price * $product['quantity'] }} DT </span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </p>
                    <p> Remarks:
                        <div class="box">
                            <ul class="items" id="its">
                                @foreach(explode(PHP_EOL, $order->remarks) as $remark)
                                    <li>{{ trim($remark) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </p>
                    <form action="{{ route('orders.updatePaymentStatus') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <select name="payment_status" class="drop-down">
                            <option value="" selected disabled>{{ $order->payment_status }}</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>
                        <button type="submit" class="option-btn" style="background-color:#f5b246 ">Update Status</button>
                    </form>
                    <div class="flex-btn">
                        <a href="{{ route('orders.edit', $order->id) }}" class="option-btn">Edit</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Delete this order?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>

<script src="{{ asset('js/admin_script.js') }}"></script>
</body>
</html>
