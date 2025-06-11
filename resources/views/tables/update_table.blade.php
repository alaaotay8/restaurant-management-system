{{-- filepath: resources/views/tables/update_table.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Table</title>
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<!-- Update Table Section -->
<section class="update-table">
    <h1 class="heading">Update Table</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <form action="{{ route('tables.update', $table->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Table Number Input -->
        <div class="inputBox">
            <label for="table_number">Table Number:</label>
            <input type="text" id="table_number" name="table_number" value="{{ $table->table_number }}" required class="box">
        </div>

        <!-- Hall Input -->
        <div class="inputBox">
            <label for="hall">Hall:</label>
            <input type="text" id="hall" name="hall" value="{{ $table->hall }}" required class="box">
        </div>

        <!-- Reserved Status -->
        <div class="inputBox">
            <label for="is_reserved">Is Reserved:</label>
            <select id="is_reserved" name="is_reserved" class="box">
                <option value="0" {{ !$table->is_reserved ? 'selected disabled' : '' }}>No</option>
                <option value="1" {{ $table->is_reserved ? 'selected disabled' : '' }}>Yes</option>
            </select>
        </div>

        <div class="flex-btn">
            <button type="submit" class="btn">Update</button>
            <a href="{{ route('admin.tables') }}" class="option-btn">Go Back</a>
        </div>
    </form>
</section>

<!-- Custom JS -->
<script src="{{ asset('js/admin_script.js') }}"></script>
</body>
</html>
