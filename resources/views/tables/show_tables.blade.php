{{-- filepath: resources/views/tables/show_tables.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tables</title>
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<!-- Tables Management Section -->
<section class="show-tables">
    <h1 class="heading">Tables</h1>

    <div class="box-container">
        @if($tables->isEmpty())
            <p class="empty">No tables available yet!</p>
        @else
            @foreach($tables as $table)
                <div class="box">
                    <p> Table Number: <span>{{ $table->table_number }}</span> </p>
                    <p> Hall: <span>{{ $table->hall }}</span> </p>
                    <p> Reserved:</p>
                    <!-- Reserved Status Update Form -->
                    <form action="{{ route('tables.updateReservedStatus') }}" method="POST">
                        @csrf
                        <input type="hidden" name="table_id" value="{{ $table->id }}">
                        <select name="is_reserved" class="drop-down">
                            <option value="0" {{ !$table->is_reserved ? 'selected disabled' : '' }}>No</option>
                            <option value="1" {{ $table->is_reserved ? 'selected disabled' : '' }}>Yes</option>
                        </select>
                        <button type="submit" class="option-btn" style="background-color:#f5b246 ">Update Status</button>
                    </form>
                    <div class="flex-btn">
                        <a href="{{ route('tables.edit', $table->id) }}" class="option-btn">Edit</a>
                        <form action="{{ route('tables.destroy', $table->id) }}" method="POST" onsubmit="return confirm('Delete this table?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <!-- Add new table button -->
    <div class="register-btn-container" style="display: flex; justify-content: center; margin: 20px 0;">
        <a href="{{ route('tables.create') }}" class="option-btn add-order" style="width: 300px; margin: 0 10px;">Add new table</a>
    </div>
</section>

<script src="{{ asset('js/admin_script.js') }}"></script>
</body>
</html>
