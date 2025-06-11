<!-- resources/views/user_views/quick_view.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Quick View</title>
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

    <section class="quick-view">
        <h1 class="title" style="padding-top: 2rem">{{ $product->name }}</h1>
        <form action="{{ route('cart.add') }}" method="post" class="add-to-cart">
            <div id="product-container" class="box-container">
                <div class="box">
                    <p>{{ $product->description }}</p>
                    @csrf
                    <input type="hidden" name="pid" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="image" value="{{ $product->image }}">
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                    <h2 class="name">{{ $product->name }}</h2>
                    <a href="{{ route('category.view', ['name' => $product->category->name]) }}" class="cat">{{ $product->category->name }}</a>
                    <div class="flex">
                        <div class="price">{{ $product->price }}<span> DT</span></div>
                        <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                    </div>
                    <button type="submit" name="add_to_cart" class="cart-btn">Add to Cart</button>
                    <button class="cart-btn" id="back_btn"><a href= "{{ route('menu') }}" id="back_home" >Back To Menu</a></button>
                </div>
            </div>
        </form>
    </section>

    <!-- Include Footer Component -->
    @include('components.user_footer')

    <!-- Custom JS file link -->
    <script src="{{ asset('js/user_script.js') }}"></script>

</body>
</html>
