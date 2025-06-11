{{-- filepath: resources/views/categories/update_category.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<!-- Update Category Section -->
<section class="update-category" style="padding-top: 8rem">
    <h1 class="heading">Update Category</h1>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Keep old image if not updated -->
        <input type="hidden" name="old_image" value="{{ $category->image }}">

        <!-- Show current image -->
        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" style="max-width: 200px; margin-bottom: 1rem;"><br>

        <!-- Category Name Input -->
        <span>Update Name</span>
        <input type="text" name="name" required placeholder="Enter category name" maxlength="100" class="box" value="{{ $category->name }}">

        <!-- Category Image Input -->
        <span>Update Image</span>
        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">

        <div class="flex-btn">
            <button type="submit" class="btn">Update</button>
            <a href="{{ route('admin.categories') }}" class="option-btn">Go Back</a>
        </div>
    </form>
</section>
<!-- End Update Category Section -->

<script src="{{ asset('js/admin_script.js') }}"></script>
</body>
</html>
