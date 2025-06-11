{{-- filepath: resources/views/users/create_user.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>
    @include('components.admin_header')

    <section class="form-container">
        <form action="{{ route('users.store') }}" method="POST" autocomplete="off">
            @csrf
            <h3>Create User</h3>
            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Error Message -->
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <input type="text" name="name" placeholder="Name" class="box" required>
            <input type="email" name="email" placeholder="Email" class="box" required autocomplete="new-email">
            <input type="text" name="number" placeholder="Phone Number" class="box">
            <input type="password" name="password" placeholder="Password" class="box" required autocomplete="off">
            <div class="flex-btn">
                <input type="submit" value="Create User" class="btn">
                <a href="{{ route('admin.users') }}" class="option-btn">Go Back</a>
            </div>
        </form>
    </section>
    <script src="{{ asset('js/admin_script.js') }}"></script>
</body>
</html>
