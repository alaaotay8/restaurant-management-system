<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
   <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
   <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')


<!-- Register admin section starts -->
<section class="form-container">
    <form method="POST" action="{{ route('admin.register') }}">
        @csrf
        <h3>Register New</h3>
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif
        <input type="text" name="name" maxlength="20" required placeholder="Enter your username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="email" name="email" maxlength="50" required placeholder="Enter your email address" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="password" maxlength="50" required placeholder="Enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="password_confirmation" maxlength="50" required placeholder="Confirm your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="Register Now" name="submit" class="btn">
    </form>
</section>
<!-- Register admin section ends -->

<!-- Custom JS file link -->
<script src="{{ asset('js/admin_script.js') }}"></script>

</body>
</html>
