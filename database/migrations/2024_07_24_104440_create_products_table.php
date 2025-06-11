<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->unsignedBigInteger('category_id'); // Column for category name
            $table->float('price');
            $table->string('image', 100);
            $table->timestamps();

            // Ensure the category_id column exists before adding foreign key
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade')->nullable()->default(null);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // Drop foreign key constraint
        });

        Schema::dropIfExists('categories'); // Drop referenced table
        Schema::dropIfExists('products');
    }
};
