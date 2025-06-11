<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_id')->constrained();
            $table->json('order_products'); // JSON column for products
            $table->integer('total_products');
            $table->integer('total_price');
            $table->string('remarks', 300)->nullable();
            $table->string('payment_status', 20)->default('pending');
            $table->timestamp('placed_on')->useCurrent();
            $table->timestamps(); // Add timestamps for created_at and updated_at

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
