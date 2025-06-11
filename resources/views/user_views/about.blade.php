<!-- resources/views/user_views/about.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
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
        <h3>About Us</h3>
        <p><a href="{{ route('home') }}">Home</a> <span> / About</span></p>
    </div>

    <!-- About Section -->
    <section class="about">
        <div class="row">
            <div class="image">
                <img src="{{ asset('images/about-img.svg') }}" alt="About Image">
            </div>
            <div class="content">
                <h3>Why choose us?</h3>
                <p>At Yes2Dev Restaurant, we are dedicated to providing an unforgettable dining experience. Our diverse menu includes delicious pizza, juicy burgers, succulent chicken dishes, and refreshing drinks. Located at 144 Rue Ennakhil, Immeuble Essid, 4100 Medenine, we offer a cozy and welcoming atmosphere for families and friends to enjoy great food together. Come and taste the difference!</p>
                <a href="{{ route('menu') }}" class="btn">Our Menu</a>
            </div>
        </div>
    </section>

    <!-- Steps Section -->
    <section class="steps">
        <h1 class="title">Simple Steps</h1>
        <div class="box-container">
            <div class="box">
                <img src="{{ asset('images/step.png') }}" alt="Step 1">
                <h3>Place an Order</h3>
                <p>Order easily from our website. Check out our menu, pick your favorite dishes, and place your order online.</p>
            </div>
            <div class="box">
                <img src="{{ asset('images/step-2.png') }}" alt="Step 2">
                <h3>Fast and Cool Serving</h3>
                <p>Enjoy fast and friendly service. We deliver your meals and coffee quickly with a touch of style.</p>
            </div>
            <div class="box">
                <img src="{{ asset('images/step-3.png') }}" alt="Step 3">
                <h3>Enjoy Your Food</h3>
                <p>Sit back, relax, and enjoy your tasty food from Yes2Dev Restaurant, delivered right to your door.</p>
            </div>

        </div>
    </section>

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
                    <h3>Nessrine Mami</h3>
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
                    delay: 7000, // 7000 milliseconds = 7 seconds
                    disableOnInteraction: false,
                },
            });
        </script>

</body>
</html>
