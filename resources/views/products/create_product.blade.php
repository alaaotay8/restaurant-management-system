{{-- filepath: resources/views/products/create_product.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Product</title>
   <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
   <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
   <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<!-- Add Product Section -->
<section class="add-products" style="padding-top: 10rem">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3>Add Product</h3>
        <!-- Product Name Input -->
        <input type="text" required placeholder="Enter product name" name="name" maxlength="100" class="box">
        <!-- Product Price Input -->
        <input type="number" min="0" max="9999999999" step="0.01" required placeholder="Enter product price" name="price" class="box">
        <!-- Category Selection -->
        <select name="category_id" class="box" required>
            <option value="" disabled selected>Select category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <!-- Product Image Input -->
        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
        <div class="flex-btn">
            <input type="submit" value="Add Product" class="btn">
            <a href="{{ route('admin.products') }}" class="option-btn">Go Back</a>
        </div>
    </form>
</section>
<!-- End Add Product Section -->

<script src="{{ asset('js/admin_script.js') }}"></script>
</body>
</html>
