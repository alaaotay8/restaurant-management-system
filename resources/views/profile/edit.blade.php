<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Update</title>
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<!-- Admin profile update section starts -->
<section class="form-container">
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <h3>Update Profile</h3>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input type="text" name="name" maxlength="20" class="box" placeholder="{{ $admin->name }}" value="{{ old('name', $admin->name) }}">
        <input type="email" name="email" maxlength="50" class="box" placeholder="{{ $admin->email }}" value="{{ old('email', $admin->email) }}">
        <input type="password" name="old_pass" maxlength="20" placeholder="Enter your old password" class="box">
        <input type="password" name="new_pass" maxlength="20" placeholder="Enter your new password" class="box">
        <input type="password" name="new_pass_confirmation" maxlength="20" placeholder="Confirm your new password" class="box">

        <div class="flex-btn">
            <input type="submit" value="Update Now" class="btn">
            <a href="{{ route('admin.admin_accounts') }}" class="option-btn">Go Back</a>
        </div>

    </form>
</section>
<!-- Admin profile update section ends -->

<!-- Custom JS file link -->
<script src="{{ asset('js/admin_script.js') }}"></script>

</body>
</html>
