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
        Schema::table('coupons', function (Blueprint $table) {            
            $table->dropColumn('total_amount');
            $table->dropColumn('percentage');
            $table->dropColumn('effective_date');
            $table->enum('type', ['total_amount', 'percentage'])->after('coupon_code');
            $table->decimal('value', 10, 2)->after('type');
            $table->integer('limit')->nullable()->after('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
             $table->dropColumn(['type', 'value', 'limit']);

            $table->decimal('total_amount', 10, 2)->default(0);
            $table->integer('percentage')->default(0);
            $table->dateTime('effective_date')->nullable();
        });
    }
};
