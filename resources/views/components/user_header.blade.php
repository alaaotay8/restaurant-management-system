<!-- resources/views/components/user_header.blade.php -->
<header class="header">
    <section class="flex">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 68px; height: 68px; vertical-align: middle;">
        </a>
        <!-- Navigation Links -->
        <nav class="navbar">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('menu') }}">Menu</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('contactUs') }}">Contact Us</a>
            <div class="switch"></div>
            <!-- Mobile Buttons -->
            <div class="mobile-buttons">
                <button type="button" class="btn">
                    <a href="{{ route('search') }}" class="fas fa-search"> search</a>
                </button>
            </div>
        </nav>
        <!-- Icons -->
        <div class="icons">
            <a href="{{ route('search') }}" class="desktop-search"><i class="fas fa-search"></i></a>
            <a href="{{ route('cart.index') }}" style="position: relative;">
                <i class="fas fa-shopping-cart"></i>
                @if(isset($cartCount) && $cartCount > 0)
                    <span style="position: absolute; top: -8px; right: -10px; background: #e74c3c; color: #fff; border-radius: 50%; padding: 2px 7px; font-size: 12px;">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>
    </section>
</header>
