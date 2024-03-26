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
        Schema::create('status_cashiers', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time');
            $table->enum('operation', ['open', 'close']);
            $table->foreignId('cashier_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->decimal('cash', 12, 2)->nullable()->default(0);
            $table->decimal('debits', 12, 2)->nullable()->default(0);
            $table->decimal('credits', 12, 2)->nullable()->default(0);
            $table->decimal('transfers', 12, 2)->nullable()->default(0);
            $table->decimal('total', 12, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_cashiers');
    }
};
