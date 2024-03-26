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
        Schema::create('cashiers', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('code');
            $table->string('name', 100);
            $table->boolean('open')->default(false);
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('cashiers');
    }
};
