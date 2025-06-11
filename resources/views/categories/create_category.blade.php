{{-- filepath: resources/views/categories/create_category.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Create Category</title>
   <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
   <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
   <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<!-- Add Category Section -->
<section class="add-category" style="padding-top: 8rem">
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3>Add Category</h3>
        <!-- Category Name Input -->
        <input type="text" required placeholder="Enter category name" name="name" maxlength="100" class="box">
        <!-- Category Image Input -->
        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
        <div class="flex-btn">
            <input type="submit" value="Add Category" class="btn">
            <a href="{{ route('admin.categories') }}" class="option-btn">Go Back</a>
        </div>
    </form>
</section>
<!-- End Add Category Section -->

<script src="{{ asset('js/admin_script.js') }}"></script>
</body>
</html>
