{{-- filepath: resources/views/tables/create_table.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Table</title>
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<!-- Add Table Section -->
<section class="add-table">
    <form action="{{ route('tables.store') }}" method="POST">
        @csrf
        <h1 class="heading">Add New Table</h1>
        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Table Number Input -->
        <input type="text" placeholder="Enter Table Number" id="table_number" name="table_number" class="box" required>
        <!-- Hall Input -->
        <input type="text" placeholder="Enter Hall name" id="hall" name="hall" class="box" required>
        <!-- Reserved Status -->
        <select id="is_reserved" name="is_reserved" class="box">
            <option value="" disabled selected>Is reserved ? --</option>
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
        <div class="flex-btn">
            <input type="submit" value="Add table" class="btn">
            <a href="{{ route('admin.tables') }}" class="option-btn">Go Back</a>
        </div>
    </form>
</section>

<!-- Custom JS -->
<script src="{{ asset('js/admin_script.js') }}"></script>
</body>
</html>
