{{-- filepath: resources/views/orders/create_order.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Order</title>
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>
@include('components.admin_header')

<!-- Add Order Section -->
<section class="add-order">
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <h3>Add New Order</h3>
        <!-- Table Selection -->
        <select name="table_id" class="box" required>
            <option value="" disabled selected>Select table number --</option>
            @foreach($tables as $table)
                <option value="{{ $table->id }}" {{ $table->is_reserved ? 'disabled' : '' }}>
                    {{ $table->table_number }} {{ $table->is_reserved ? '(Reserved)' : '' }}
                </option>
            @endforeach
        </select>
        <!-- Product Selection Dropdown -->
        <div class="anchor" tabindex="100">
            <span class="dropdown-label">Select Products --</span>
            <div class="items">
                <ul>
                    @foreach($categories as $category)
                        <li><strong>{{ $category->name }}</strong>
                            <ul>
                                @foreach($category->products as $product)
                                    <li>
                                        <input type="checkbox" class="product-checkbox" data-target=".qty-{{ $product->id }}" value="{{ $product->id }}" name="selected_products[]"> {{ $product->name }}
                                        <input type="number" name="quantities[{{ $product->id }}]" class="qty qty-{{ $product->id }}" value="1" min="1" disabled>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Remarks and Payment Status -->
        <textarea name="remarks" placeholder="Enter remarks (e.g., spicy food, extra napkins)" class="remarks"></textarea>
        <select name="payment_status" class="box" required>
            <option value="" disabled selected>Select payment status --</option>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
        </select>
        <div class="flex-btn">
            <input type="submit" value="Add Order" class="btn">
            <a href="{{ route('admin.orders') }}" class="option-btn">Go Back</a>
        </div>
    </form>
</section>

<script src="{{ asset('js/admin_script.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dropdown = document.querySelector('.add-order .anchor');
        var items = document.querySelector('.add-order .anchor .items');

        items.style.display = 'none';

        dropdown.addEventListener('click', function (event) {
            event.stopPropagation();
            items.style.display = (items.style.display === 'block') ? 'none' : 'block';
        });

        document.addEventListener('click', function (event) {
            if (!dropdown.contains(event.target)) {
                items.style.display = 'none';
            }
        });

        items.addEventListener('click', function (event) {
            event.stopPropagation();
        });

        // Enable/disable quantity input based on checkbox
        document.querySelectorAll('.product-checkbox').forEach(function (checkbox) {
            var qtyInput = document.querySelector(checkbox.dataset.target);

            checkbox.addEventListener('change', function () {
                if (checkbox.checked) {
                    qtyInput.disabled = false;
                    qtyInput.value = 1;
                } else {
                    qtyInput.disabled = true;
                    qtyInput.value = 0;
                }
            });

            // Set initial state
            if (checkbox.checked) {
                qtyInput.disabled = false;
                qtyInput.value = 1;
            } else {
                qtyInput.disabled = true;
                qtyInput.value = 0;
            }
        });
    });
</script>
</body>
</html>
