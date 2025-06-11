<!-- resources/views/components/admin_header.blade.php -->
<header class="header">
    <section class="flex">
        <!-- Logo -->
        <a href="{{ route('admin.dashboard') }}" class="logo">
            <img src="{{ asset('logo2.png') }}" alt="Logo" style="width: 35px; height: 35px; vertical-align: middle;">
            Admin<span>Panel</span>
        </a>
        <!-- Navigation Links -->
        <nav class="navbar">
            <a href="{{ route('admin.dashboard') }}">Home</a>
            <a href="{{ route('admin.categories') }}">Categories</a>
            <a href="{{ route('admin.products') }}">Products</a>
            <a href="{{ route('admin.orders') }}">Orders</a>
            <a href="{{ route('admin.tables') }}">Tables</a>
            <a href="{{ route('admin.messages') }}">Messages</a>
            <a href="{{ route('admin.admin_accounts') }}">Admins</a>
        </nav>
        <!-- Icons and Profile -->
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>
        <div class="profile">
            @php $admin = Auth::user(); @endphp
            <p>{{ $admin->name }}</p>
            <a href="{{ route('profile.update') }}" class="btn">Update Profile</a>
            <div class="flex-btn">
                <a href="{{ route('admin.register') }}" class="option-btn">Register</a>
            </div>
            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="delete-btn">Logout</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </section>
</header>

<!-- Flash Messages -->
@if(session('message'))
    @if(is_array(session('message')))
        @foreach(session('message') as $message)
            <div class="message">
                <span>{{ $message }}</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
        @endforeach
    @else
        <div class="message">
            <span>{{ session('message') }}</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
    @endif
@endif

<!-- Admin JS -->
<script src="{{ asset('js/user_script.js') }}"></script>
