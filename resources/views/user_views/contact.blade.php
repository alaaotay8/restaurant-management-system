<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
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

<!-- Header Section Starts -->
@include('components.user_header')
<!-- Header Section Ends -->

<div class="heading">
    <h3>Contact Us</h3>
    <p><a href="{{ route('home') }}">home</a> <span> / contact</span></p>
</div>

<!-- Contact Section Starts -->
<section class="contact">
    <div class="row">
        <div class="image">
            <img src="{{ asset('images/contact-img.svg') }}" alt="Contact Image">
        </div>

        <form id="contact-form" method="POST" action="{{ route('contact.submit') }}">
            @csrf
            <h3>Tell us something!</h3>
            <input type="text" name="name" maxlength="50" class="box" placeholder="Enter your name" required>
            <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="Enter your number" required maxlength="10">
            <input type="email" name="email" maxlength="50" class="box" placeholder="Enter your email" required>
            <textarea name="msg" class="box" required placeholder="Enter your message" maxlength="500" cols="30" rows="10"></textarea>
            <input type="submit" value="Send Message" class="btn">
        </form>
    </div>
</section>
<!-- Contact Section Ends -->

<!-- Footer Section Starts -->
@include('components.user_footer')
<!-- Footer Section Ends -->

<!-- Custom JS File Link -->
<script src="{{ asset('js/user_script.js') }}"></script>

<script>
document.getElementById('contact-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const data = {
        name: formData.get('name'),
        number: formData.get('number'),
        email: formData.get('email'),
        msg: formData.get('msg')
    };

    fetch('{{ route('contactUs') }}', { // Make sure to update this route to match your actual route
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Message sent successfully!');
        } else {
            alert('Failed to send message.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while sending the message.');
    });
});
</script>
</body>
</html>
