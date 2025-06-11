<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

   <!-- Bootstrap CSS -->
   <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

   <!-- Swiper CSS -->
   <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">

   <!-- Font Awesome CSS -->
   <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="{{ asset('css/user_style.css') }}">
</head>
<body>

   <!-- Header Section Starts -->
   @include('components.user_header')
   <!-- Header Section Ends -->

   <section class="form-container" style="padding-top: 8rem; padding-bottom: 4rem;">
      <form action="{{ route('user.register.submit') }}" method="POST">
         @csrf
         <h3>Register Now</h3>
         <input type="text" name="name" required placeholder="Enter your name" class="box" maxlength="50">
         <input type="email" name="email" required placeholder="Enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="number" name="number" required placeholder="Enter your number" class="box" min="0" max="9999999999" maxlength="10">
         <input type="password" name="password" required placeholder="Enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="password_confirmation" required placeholder="Confirm your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="submit" value="Register Now" class="btn">
         <p>Already have an account? <a href="{{ route('user.login') }}">Login now</a></p>
      </form>
   </section>

   <!-- Footer Section Starts -->
   @include('components.user_footer')
   <!-- Footer Section Ends -->

   <!-- Bootstrap JS -->
   <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

   <!-- Swiper JS -->
   <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

   <!-- Custom JS File Link -->
   <script src="{{ asset('js/user_script.js') }}"></script>
</body>
</html>
