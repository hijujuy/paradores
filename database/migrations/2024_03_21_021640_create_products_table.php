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
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('description')->nullable();
            $table->decimal('purchase_price', 12, 2)->nullable()->default(0.00);
            $table->decimal('sale_price', 12, 2)->nullable()->default(0.00);
            $table->integer('stock')->default(0);
            $table->integer('minimum_stock')->nullable()->default(0);
            $table->string('barcode')->nullable();
            $table->date('expiration_date')->nullable();
            $table->boolean('active')->nullable()->default(true);
            $table->foreignId('category_id')
                ->nullable()->constrained()->onDelete('SET NULL');
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
