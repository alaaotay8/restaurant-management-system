{{-- filepath: resources/views/categories/show_categories.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Categories</title>
   <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
   <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
   <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<!-- Categories Management Section -->
<section class="show-categories" style="padding-top: 5em;">
    <!-- Add Category Button -->
    <h1 class="heading">Add Category</h1>
    <div class="register-btn-container" style="display: flex; justify-content: center; margin: 20px 0;">
        <a href="{{ route('categories.create') }}" class="option-btn add-category" style="width: 300px; margin: 0 10px;">Add new category</a>
    </div>

    <!-- All Categories List -->
    <h1 class="heading">All Categories</h1>
    <div class="box-container">
        @foreach ($categories as $category)
            <div class="box">
                <!-- Category Image -->
                <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}">
                <div class="flex">
                    <div class="name">{{ $category->name }}</div>
                </div>
                <!-- Update & Delete Buttons -->
                <div class="flex-btn">
                    <a href="{{ route('categories.edit', $category->id) }}" class="option-btn">Update</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn" onclick="return confirm('Delete this category?');">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach

        @if($categories->isEmpty())
            <p class="empty">No categories added yet!</p>
        @endif
    </div>
</section>
<!-- End Categories Management Section -->

<script src="{{ asset('js/admin_script.js') }}"></script>
</body>
</html>
