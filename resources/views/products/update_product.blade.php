{{-- filepath: resources/views/products/update_product.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<!-- Update Product Section -->
<section class="update-product" style="padding-top: 10rem">
    <h1 class="heading">Update Product</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Keep old image if not updated -->
        <input type="hidden" name="old_image" value="{{ $product->image }}">

        <!-- Show current image -->
        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" style="max-width: 200px; margin-bottom: 1rem;">

        <span>Update Name</span>
        <input type="text" name="name" required placeholder="Enter product name" maxlength="100" class="box" value="{{ $product->name }}">

        <span>Update Price</span>
        <input type="number" min="0" max="9999999999" step="0.01" required placeholder="Enter product price" name="price" class="box" value="{{ $product->price }}">

        <span>Update Category</span>
        <select name="category_id" class="box" required>
            <option value="">Select category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <span>Update Image</span>
        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">

        <div class="flex-btn">
            <button type="submit" class="btn">Update</button>
            <a href="{{ route('admin.products') }}" class="option-btn">Go Back</a>
        </div>
    </form>
</section>

<script src="{{ asset('js/admin_script.js') }}"></script>
</body>
</html>
