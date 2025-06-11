{{-- Update Product Blade View --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>

    <!-- Icon and Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<!-- Update Product Section -->
<section class="update-product">
    <h1 class="heading">Update Product</h1>

    {{-- Show success message if available --}}
    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    {{-- Show error message if available --}}
    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <!-- Product Update Form -->
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Hidden field to keep old image if not updated -->
        <input type="hidden" name="old_image" value="{{ $product->image }}">

        <!-- Display current product image -->
        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">

        <!-- Product Name Input -->
        <span>Update Name</span>
        <input type="text" name="name" required placeholder="Enter product name" maxlength="100" class="box" value="{{ $product->name }}">

        <!-- Product Price Input -->
        <span>Update Price</span>
        <input type="number" min="0" max="9999999999" step="0.01" required placeholder="enter product price" name="price" class="box" value="{{ $product->price }}">

        <!-- Category Selection -->
        <span>Update Category</span>
        <select name="category_id" class="box" required>
            <option value="">select category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <!-- Product Image Input -->
        <span>Update Image</span>
        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" value="{{ $product->image }}">

        <!-- Form Buttons -->
        <div class="flex-btn">
            <button type="submit" class="btn">Update</button>
            <a href="{{ route('admin.products') }}" class="option-btn">Go Back</a>
        </div>
    </form>
</section>

<!-- Custom JS -->
<script src="{{ asset('js/admin_script.js') }}"></script>

</body>
</html>
