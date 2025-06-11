<!-- resources/views/components/user_footer.blade.php -->
<footer class="footer">
    <section class="grid">
        <!-- Address Box -->
        <div class="box">
            <img src="{{ asset('images/map-icon.png') }}" alt="Map Icon">
            <h3>Our Address</h3>
            <a href="#">Rue Ibn El Jazzar, Skanes, 5000 Monastir, Tunisie</a>
        </div>
        <!-- Opening Hours Box -->
        <div class="box">
            <img src="{{ asset('images/clock-icon.png') }}" alt="Clock Icon">
            <h3>Opening Hours</h3>
            <p>08:00am to 05:00pm</p>
        </div>
        <!-- Phone Numbers Box -->
        <div class="box">
            <img src="{{ asset('images/phone-icon.png') }}" alt="Phone Icon">
            <h3>Our Numbers</h3>
            <a href="tel:+21699415661">+216 54 056 747</a>
            <a href="tel:+21670295486">+216 95 430 616</a>
        </div>
        <!-- Email Box -->
        <div class="box">
            <img src="{{ asset('images/email-icon.png') }}" alt="Email Icon">
            <h3>Our Email</h3>
            <a href="mailto:alaaotay8@gmail.com">alaaotay8@gmail.com</a>
            <a href="mailto:alaaotay345@gmail.com">alaaotay345@gmail.com</a>
        </div>
    </section>
    <div class="credit">
        &copy; copyright @ <span id="current-year">{{ date('Y') }}</span>
        by <span>Alaa Otay</span> | all rights reserved!
    </div>
</footer>

<!-- Loader Animation -->
<div class="loader">
    <img src="{{ asset('images/loader.gif') }}" alt="Loading...">
</div>

<!-- JS Libraries -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
