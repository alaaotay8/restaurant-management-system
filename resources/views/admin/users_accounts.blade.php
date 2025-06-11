{{-- filepath: resources/views/admin/users_accounts.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Accounts</title>
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<!-- Users accounts section starts -->
<section class="accounts">
    <h1 class="heading">Add User Account</h1>
    <!-- Add new user button -->
    <div class="register-btn-container" style="display: flex; justify-content: center; margin: 20px 0;">
        <a href="{{ route('users.create') }}" class="option-btn add-user" style="width: 300px; margin: 0 10px;">Add new user</a>
    </div>

    <h1 class="heading">Users Accounts</h1>
    <div class="box-container">
        @if($users->count() > 0)
            @foreach($users as $user)
                <div class="box">
                    <p>User ID: <span>{{ $user->id }}</span></p>
                    <p>Username: <span>{{ $user->name }}</span></p>
                    <!-- Delete user account -->
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn" onclick="return confirm('delete this account?');">Delete</button>
                    </form>
                </div>
            @endforeach
        @else
            <p class="empty">No accounts available</p>
        @endif
    </div>
</section>
<!-- Users accounts section ends -->

<!-- Custom JS file -->
<script src="{{ asset('js/admin_script.js') }}"></script>

</body>
</html>
