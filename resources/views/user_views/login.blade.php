<!-- resources/views/user_views/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="{{ asset('css/user_style.css') }}">
</head>
<body>
    <!-- Include Header Component -->
    @include('components.user_header')

    <section class="form-container" style="padding-top: 18rem; padding-bottom: 16rem;">
        <form action="{{ route('user.login.submit') }}" method="POST" >
            @csrf
            <h3>Login Now</h3>
            @if ($errors->any())
            <div class="alert alert-danger mt-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <input type="email" name="email" id="email" required placeholder="Enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="password" id="password" required placeholder="Enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="Login Now" class="btn">
            <p>Don't have an account? <a href="{{ route('user.register') }}">Register now</a></p>
        </form>
    </section>

    <!-- Include Footer Component -->
    @include('components.user_footer')

    <!-- Custom JS file link -->
    <script src="{{ asset('js/user_script.js') }}"></script>

</body>
</html>
