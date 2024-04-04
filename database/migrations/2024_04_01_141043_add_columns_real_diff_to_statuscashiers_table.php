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
        Schema::table('status_cashiers', function (Blueprint $table) {
            $table->decimal('real_cash',12, 2)->nullable()->default(0)->after('cash');
            $table->decimal('diff_cash',12, 2)->nullable()->default(0)->after('real_cash');
            $table->decimal('real_debits',12, 2)->nullable()->default(0)->after('debits');
            $table->decimal('diff_debits',12, 2)->nullable()->default(0)->after('real_debits');
            $table->decimal('real_credits',12, 2)->nullable()->default(0)->after('credits');
            $table->decimal('diff_credits',12, 2)->nullable()->default(0)->after('real_credits');
            $table->decimal('real_transfers',12, 2)->nullable()->default(0)->after('transfers');
            $table->decimal('diff_transfers',12, 2)->nullable()->default(0)->after('real_transfers');
            $table->decimal('real_total',12, 2)->nullable()->default(0)->after('total');
            $table->decimal('diff_total',12, 2)->nullable()->default(0)->after('real_total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('status_cashiers', function (Blueprint $table) {
            $table->dropColumn('real_cash');
            $table->dropColumn('diff_cash');
            $table->dropColumn('real_debits');
            $table->dropColumn('diff_debits');
            $table->dropColumn('real_credits');
            $table->dropColumn('diff_credits');
            $table->dropColumn('real_transfers');
            $table->dropColumn('diff_transfers');
            $table->dropColumn('real_total');
            $table->dropColumn('diff_total');
        });
    }
};
