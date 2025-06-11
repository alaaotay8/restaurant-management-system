<!-- resources/views/user_views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

    <section class="hero">
        <div class="swiper hero-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide">
                    <div class="content">
                        <h3>delicious pizza</h3>
                        <a href="{{ route('menu') }}" class="btn">see menus</a>
                    </div>
                    <div class="image">
                        <img src="{{ asset('images/home-img-1.png') }}" alt="">
                    </div>
                </div>
                <div class="swiper-slide slide">
                    <div class="content">
                        <h3>chezzy hamburger</h3>
                        <a href="{{ route('menu') }}" class="btn">see menus</a>
                    </div>
                    <div class="image">
                        <img src="{{ asset('images/home-img-2.png') }}" alt="">
                    </div>
                </div>
                <div class="swiper-slide slide">
                    <div class="content">
                        <h3>roasted chicken</h3>
                        <a href="{{ route('menu') }}" class="btn">see menus</a>
                    </div>
                    <div class="image">
                        <img src="{{ asset('images/home-img-3.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="category">
        <h1 class="title">food category</h1>
        <div class="box-container">
            @foreach ($categories as $category)
                <a href="{{ route('category.view', $category->name) }}" class="box">
                    <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}">
                    <h3>{{ $category->name }}</h3>
                </a>
            @endforeach
            @if($categories->isEmpty())
                <p class="empty">No categories added yet!</p>
            @endif
        </div>
    </section>

    <section class="products">
        <h1 class="title">latest dishes</h1>
        <div class="box-container" id="latest-products">
            @foreach ($latestProducts as $product)
            <form action="{{ route('cart.add') }}" method="post" class="box">
                @csrf
                <input type="hidden" name="pid" value="{{ $product->id }}">
                <input type="hidden" name="name" value="{{ $product->name }}">
                <input type="hidden" name="price" value="{{ $product->price }}">
                <input type="hidden" name="image" value="{{ $product->image }}">
                <a href="{{ route('product.quick_view', $product->name) }}" class="fas fa-eye"></a>
                <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                <a href="{{ route('category.view', $category->name) }}" class="cat">{{ $product->category->name }}</a>
                <div class="name">{{ $product->name }}</div>
                <div class="flex">
                    <div class="price" id="price">{{ $product->price }}<span> DT</span></div>
                    <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                </div>
            </form>
            @endforeach
            @if($latestProducts->isEmpty())
                <p class="empty">No products available yet!</p>
            @endif
        </div>
        <div class="more-btn">
            <a href="{{ route('menu') }}" class="btn">view all</a>
        </div>
    </section>
    <br>

    <!-- Reviews Section -->
    <section class="reviews">
        <h1 class="title">Customer's Reviews</h1>
        <div class="swiper reviews-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide">
                    <img src="{{ asset('images/pic-1.png') }}" alt="Review 1">
                    <p>The food at Yes2Dev Restaurant is fantastic! The pizza and burgers are my favorites. The delivery was quick and the service was excellent. Highly recommend!</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Amine Mednini</h3>
                </div>
                <div class="swiper-slide slide">
                    <img src="{{ asset('images/pic-2.png') }}" alt="Review 2">
                    <p>Amazing experience! The chicken and drinks were top-notch. The staff is super friendly and the delivery was on time. Definitely my go-to place for takeout.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Asma Mhfoudh</h3>
                </div>
                <div class="swiper-slide slide">
                    <img src="{{ asset('images/pic-3.png') }}" alt="Review 3">
                    <p>I love ordering from Yes2Dev! The menu has great variety and everything I've tried has been delicious. The delivery is always fast and reliable.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Amir Feki</h3>
                </div>
                <div class="swiper-slide slide">
                    <img src="{{ asset('images/pic-4.png') }}" alt="Review 4">
                    <p>The best restaurant in town! The food is always fresh and tasty. The burgers are out of this world. The delivery service is prompt and courteous.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Nassima Mami</h3>
                </div>
                <div class="swiper-slide slide">
                    <img src="{{ asset('images/pic-5.png') }}" alt="Review 5">
                    <p>Yes2Dev Restaurant never disappoints! Their pizza is my favorite, and the drinks are always refreshing. Great service and fast delivery every time.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Ayman Masmoudi</h3>
                </div>
                <div class="swiper-slide slide">
                    <img src="{{ asset('images/pic-6.png') }}" alt="Review 6">
                    <p>Fantastic food and excellent service! I love the variety on the menu and the convenience of ordering by phone and the delivery is always fast.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Arwa Hamdi</h3>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- Include Footer Component -->
    @include('components.user_footer')

    <!-- Custom JS file link -->
    <script src="{{ asset('js/user_script.js') }}"></script>
     <!-- Swiper Initialization -->
     <script>
        var swiper = new Swiper(".reviews-slider", {
            loop: true,
            grabCursor: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                700: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
            autoplay: {
                delay: 4000, // 4000 milliseconds = 4 seconds
                disableOnInteraction: false,
            },
        });
    </script>
</body>
</html>
