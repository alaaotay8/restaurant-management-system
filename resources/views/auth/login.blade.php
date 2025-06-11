<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <script src="{{ asset('js/user_script.js') }}"></script>

</head>
<body>

<!-- Display error messages -->
@if ($errors->any())
    <div class="message">
        @foreach ($errors->all() as $error)
            <span>{{ $error }}</span>
        @endforeach
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
@endif

<!-- Admin login form section starts -->
<section class="form-container">

    <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        <h3>Login Now</h3>
        <input type="email" name="email" maxlength="255" required placeholder="Enter your email" class="box">
        <input type="password" name="password" maxlength="255" required placeholder="Enter your password" class="box">
        <input type="submit" value="Login Now" class="btn">
    </form>

</section>
<!-- Admin login form section ends -->

</body>
</html>
