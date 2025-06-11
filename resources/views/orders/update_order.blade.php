{{-- filepath: resources/views/orders/update_order.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order</title>
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<!-- Update Order Section -->
<section class="update-order">
    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h3>Update Order</h3>
        <!-- Table Selection -->
        <select name="table_id" class="box" required>
            <option value="" disabled>Select table number --</option>
            @foreach($tables as $table)
                <option value="{{ $table->id }}" {{ $table->is_reserved ? 'disabled' : '' }} {{ $table->id == $order->table_id ? 'selected' : '' }}>
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
                                    @php
                                        $previousProduct = collect(json_decode($order->order_products, true))->firstWhere('id', $product->id);
                                    @endphp
                                    <li>
                                        <input type="checkbox"
                                               name="order_products[{{ $product->id }}][id]"
                                               value="{{ $product->id }}"
                                               class="product-checkbox"
                                               data-target="#qty-{{ $product->id }}"
                                               @if($previousProduct) checked @endif>
                                        {{ $product->name }}
                                        <input type="number"
                                               id="qty-{{ $product->id }}"
                                               name="order_products[{{ $product->id }}][quantity]"
                                               value="{{ $previousProduct ? $previousProduct['quantity'] : 0 }}"
                                               min="0"
                                               class="qty"
                                               placeholder="Quantity">
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Remarks and Payment Status -->
        <textarea name="remarks" placeholder="Enter remarks (e.g., spicy food, extra napkins)" class="remarks">{{ $order->remarks }}</textarea>
        <select name="payment_status" class="box" required>
            <option value="" disabled>Select payment status --</option>
            <option value="pending" @if($order->payment_status == 'pending') selected @endif>Pending</option>
            <option value="completed" @if($order->payment_status == 'completed') selected @endif>Completed</option>
        </select>
        <div class="flex-btn">
            <button type="submit" class="btn">Update</button>
            <a href="{{ route('admin.orders') }}" class="option-btn">Go Back</a>
        </div>
    </form>
</section>

<script src="{{ asset('js/admin_script.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dropdown = document.querySelector('.update-order .anchor');
        var items = document.querySelector('.update-order .anchor .items');

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
            } else {
                qtyInput.disabled = true;
                qtyInput.value = 0;
            }
        });
    });
</script>
</body>
</html>
