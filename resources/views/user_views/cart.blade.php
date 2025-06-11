<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="{{ asset('css/user_style.css') }}">
</head>
<body>

    <!-- Include Header Component -->
    @include('components.user_header')

    <div class="heading">
        <h3>Shopping Cart</h3>
        <p><a href="{{ route('home') }}">Home</a> <span> / Cart</span></p>
    </div>

    <!-- Shopping Cart Section -->
    <section class="products">
        <h1 class="title">Your Cart</h1>
        <div class="box-container">
            @if($cartItems->count() > 0)
                @foreach($cartItems as $cartItem)
                    <form action="{{ route('cart.update', $cartItem->id) }}" method="post" class="box">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="cart_id" value="{{ $cartItem->id }}">
                        <a href="{{ route('product.quick_view', $cartItem->product->name) }}" class="fas fa-eye"></a>
                        <a href="{{ route('cart.remove', $cartItem->id) }}" class="fas fa-times" onclick="return confirm('Delete this item?');" title="Delete this item"></a>
                        <img src="{{ Storage::url($cartItem->product->image) }}" alt="{{ $cartItem->product->name }}">
                        <div class="name">{{ $cartItem->product->name }}</div>
                        <div class="flex">
                            <div class="price">{{ $cartItem->product->price }} DT</div>
                            <input type="number" name="qty" class="qty" min="1" max="99" value="{{ $cartItem->quantity }}" maxlength="2" placeholder="Quantity">
                            <button type="submit" class="fas fa-edit" title="Update Quantity"></button>
                        </div>
                        <div class="sub-total">Sub Total: <span>{{ $cartItem->product->price * $cartItem->quantity }} DT</span></div>
                    </form>
                @endforeach
            @else
                <p class="empty">Your cart is empty</p>
            @endif
        </div>

        <div class="cart-total">
            <p>Cart Total: <span>
                @php
                    $totalPrice = $cartItems->sum(function($cartItem) {
                        return $cartItem->product->price * $cartItem->quantity;
                    });
                @endphp
                {{ $totalPrice }} DT</span>
            </p>
        </div>

        <form action="{{ route('orders.createFromCart') }}" method="post" class="cart-actions" style="text-align: -webkit-center;">
            @csrf
            <select name="table_id" class="box" required style="font-size: 2.1rem;">
                <option value="" disabled selected>Select table number --</option>
                @foreach($tables as $table)
                    <option value="{{ $table->id }}" {{ $table->is_reserved ? 'disabled' : '' }}>
                        {{ $table->table_number }} {{ $table->is_reserved ? '(Reserved)' : '' }}
                    </option>
                @endforeach
            </select>
            <textarea name="remarks" placeholder="Enter remarks (e.g., spicy food, extra napkins)" class="remarks"></textarea>
            <div class="more-btn" id="btns">
                <button type="submit" class="btn">Confirm order</button>
                <a href="{{ route('cart.clear') }}" class="delete-btn" onclick="return confirm('Delete all items from cart?');">Delete All</a>
            </div>
        </form>
    </section>

    <!-- Include Footer Component -->
    @include('components.user_footer')

    <!-- Custom JS file link -->
    <script src="{{ asset('js/user_script.js') }}"></script>

</body>
</html>
