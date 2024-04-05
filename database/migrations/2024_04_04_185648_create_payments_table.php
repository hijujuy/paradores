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
        Schema::create('payment_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('active')->nullable()->default(true);
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->double('amount', 12, 2)->nullable()->default(0);
            $table->string('reference')->nullable()->default('');
            $table->foreignId('payment_type_id')->nullable()
                ->default(1)
                ->constrained()
                ->onDelete('SET NULL');
            $table->foreignId('sale_id')->nullable()->constrained()
                ->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {            
            $table->dropForeign('payments_sale_id_foreign');
            $table->dropForeign('payments_payment_type_id_foreign');
        });     
        Schema::dropIfExists('payments');
        Schema::dropIfExists('payment_types');
    }
};
