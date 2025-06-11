{{-- filepath: resources/views/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<!-- Dashboard Section -->
<section class="dashboard">
    <h1 class="heading">Welcome! <span>{{ $admin->name }}</span></h1>
    <div class="box-container">

        <!-- Pending Orders -->
        <div class="box">
            <h3>Total Pendings</h3>
            <p>{{ $totalPendings }}<span> DT</span></p>
            <a href="{{ route('orders.pending') }}" class="btn">See Orders</a>
        </div>

        <!-- Completed Orders -->
        <div class="box">
            <h3>Total Completes</h3>
            <p>{{ $totalCompletes }}<span> DT</span></p>
            <a href="{{ route('orders.completed') }}" class="btn">See Orders</a>
        </div>

        <!-- All Orders -->
        <div class="box">
            <h3>All Orders</h3>
            <p>{{ $numbersOfOrders }}</p>
            <a href="{{ route('admin.orders') }}" class="btn">See Orders</a>
        </div>

        <!-- All Tables -->
        <div class="box">
            <h3>All Tables</h3>
            <p>{{ $numbersOfTables }}</p>
            <a href="{{ route('admin.tables') }}" class="btn">See Tables</a>
        </div>

        <!-- Categories -->
        <div class="box">
            <h3>Categories Added</h3>
            <p>{{ $numbersOfCategories }}</p>
            <a href="{{ route('admin.categories') }}" class="btn">See Categories</a>
        </div>

        <!-- Products -->
        <div class="box">
            <h3>Products Added</h3>
            <p>{{ $numbersOfProducts }}</p>
            <a href="{{ route('admin.products') }}" class="btn">See Products</a>
        </div>

        <!-- Messages -->
        <div class="box">
            <h3>New Messages</h3>
            <p>{{ $numbersOfMessages }}</p>
            <a href="{{ route('admin.messages') }}" class="btn">See Messages</a>
        </div>

        <!-- Admin Accounts -->
        <div class="box">
            <h3>Admins Accounts</h3>
            <p>{{ $numbersOfAdmins }}</p>
            <a href="{{ route('admin.admin_accounts') }}" class="btn">See Admins</a>
        </div>

    </div>
</section>
<!-- End Dashboard Section -->

<script src="{{ asset('js/admin_script.js') }}"></script>
</body>
</html>
