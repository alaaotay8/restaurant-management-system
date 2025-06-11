<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="{{ asset('css/user_style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <!-- Include Header Component -->
    @include('components.user_header')

    <div class="heading">
        <h3>Our Menu</h3>
        <p><a href="{{ route('home') }}">Home</a> <span> / Menu</span></p>
    </div><br>

    <!-- Menu section starts -->
    @foreach ($categories as $category)
        <h1 class="title">
            <a href="{{ route('category.view', $category->name) }}" class="title" >
                {{ $category->name }}
            </a>
        </h1>
        <section class="products">
            <div id="menu-container" class="box-container">
                @foreach ($category->products->sortBy('price') as $product)
                    <form action="{{ route('cart.add') }}" method="post" class="box add-to-cart-form">
                        @csrf
                        <input type="hidden" name="pid" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <input type="hidden" name="image" value="{{ $product->image }}">
                        <a href="{{ route('product.quick_view', $product->name) }}" class="fas fa-eye"></a>
                        <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                        <div class="name">{{ $product->name }}</div>
                        <div class="flex">
                            <div class="price" id="price">{{ $product->price }}<span> DT</span></div>
                            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                        </div>
                    </form>
                @endforeach
                @if ($category->products->isEmpty())
                    <p class="empty">No products in this category!</p>
                @endif
            </div>
        </section>
    @endforeach
    <!-- Menu section ends -->

    <!-- Include Footer Component -->
    @include('components.user_footer')

    <!-- Custom JS file link -->
    <script src="{{ asset('js/user_script.js') }}"></script>
</body>
</html>
