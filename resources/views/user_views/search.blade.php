<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="{{ asset('css/user_style.css') }}">
</head>
<body>

    <!-- Header Component -->
    @include('components.user_header')
    <!-- Search form section starts -->
    <section class="search-form py-5">
        <div class="container">
            <form class="d-flex" role="search" method="POST" action="{{ route('search.submit') }}" style=" padding-top: 3rem;">
                @csrf
                <input class="form-control me-2" type="search" placeholder="search product name  " aria-label="Search" id="search_box" name="search_box">
            </form>
        </div>
    </section>
    <!-- Search form section ends -->
    <!-- Products section starts -->
    <section class="products">
        <div class="box-container" style="white-space: pre-line; min-height: 60rem;">
            <div class="row" id="products-container">
                <!-- Products will be dynamically added here -->
                @if(isset($products))
                @foreach ($products as $product)
                    <form action="{{ route('cart.add') }}" method="post" class="box">
                        @csrf
                        <input type="hidden" name="pid" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <input type="hidden" name="image" value="{{ $product->image }}">
                        <a href="{{ route('product.quick_view', $product->name) }}" class="fas fa-eye"></a>
                        <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                        <a href="{{ route('category.view', $product->category->name) }}" class="cat">{{ $product->category->name }}</a>
                        <div class="name">{{ $product->name }}</div>
                        <div class="flex">
                            <div class="price" id="price">{{ $product->price }}<span> DT</span></div>
                            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                        </div>
                    </form>
                @endforeach
                @if ($products->isEmpty())
                    <p class="empty">No products found!</p>
                @endif
                @endif
            </div>
        </div>
    </section>
    <!-- Products section ends -->
    <br><br><br>


    <!-- Footer Component -->
    @include('components.user_footer')

    <!-- Custom JS file link -->
    <script src="{{ asset('js/user_script.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch all products initially
            fetchProducts('');

            document.getElementById('search_box').addEventListener('input', function() {
                let query = this.value;
                fetchProducts(query);
            });
        });

        function fetchProducts(query) {
            fetch('{{ route("search.ajax") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ search_box: query })
            })
            .then(response => response.json())
            .then(data => {
                let container = document.getElementById('products-container');
                container.innerHTML = '';
                if(data.products.length > 0) {
                    data.products.forEach(product => {
                        let productHTML = `
                            <div class="col-md-4">
                                <form action="{{ route('cart.add') }}" method="post" class="box">
                                    @csrf
                                    <input type="hidden" name="pid" value="${product.id}">
                                    <input type="hidden" name="name" value="${product.name}">
                                    <input type="hidden" name="price" value="${product.price}">
                                    <input type="hidden" name="image" value="${product.image}">
                                    <a href="{{ route('product.quick_view', '') }}/${product.name}" class="fas fa-eye"></a>
                                    <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                                    <img src="{{ Storage::url('') }}/${product.image}" alt="${product.name}">
                                    <div class="name">${product.name}</div>
                                    <div class="flex">
                                        <div class="price">${product.price}<span> DT</span></div>
                                        <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                                    </div>
                                </form>
                            </div>`;
                        container.innerHTML += productHTML;
                    });
                } else {
                    container.innerHTML = '<p class="empty">No products found!</p>';
                }
            });
        }

    </script>
</body>
</html>
