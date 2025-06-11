{{-- filepath: resources/views/products/show_products.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>
   <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
   <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
   <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<section class="show-products" style="padding-top: 5em;">
    <!-- Add Product Button -->
    <h1 class="heading">Add Product</h1>
    <div class="register-btn-container" style="display: flex; justify-content: center; margin: 20px 0;">
        <a href="{{ route('products.create') }}" class="option-btn add-product" style="width: 300px; margin: 0 10px;">Add new product</a>
    </div>

    <!-- All Products Grouped by Category -->
    <h1 class="heading">All Products</h1>
    @forelse ($categories as $category)
        <h2 class="heading2">{{ $category->name }}</h2>
        @php $hasProducts = false; @endphp
        <div class="box-container">
            @foreach ($products as $product)
                @if ($product->category_id == $category->id)
                    @php $hasProducts = true; @endphp
                    <div class="box">
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                        <div class="flex">
                            <div class="name">{{ $product->name }}</div>
                            <div class="category">{{ $category->name }}</div>
                        </div>
                        <div class="price">{{ $product->price }}<span> DT</span></div>
                        <div class="flex" style="margin-top: auto">
                            <a href="{{ route('products.edit', $product->id) }}" class="option-btn">Update</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        @if (!$hasProducts)
            <p class="empty">No products in this category!</p>
        @endif
        <br>
    @empty
        <p class="empty">No categories available!</p>
        <br>
    @endforelse
</section>

<script src="{{ asset('js/admin_script.js') }}"></script>
</body>
</html>
