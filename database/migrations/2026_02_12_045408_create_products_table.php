<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            // Add table columns
            $table->id();
            $table->string('name');
            $table->string('sku')->unique()->nullable(); //Stock Keeping Unit - auto generate unique 8 character string
            $table->decimal('price', 10, 2);
            $table->integer('stock_quantity');
            $table->string('image_path')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
