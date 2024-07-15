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
        Schema::table('renteds', function (Blueprint $table) {
            $table->foreign(['tenant_id'], 'renteds_ibfk_1')->references(['id'])->on('tenants')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['warehouse_subscription_id'], 'renteds_ibfk_2')->references(['id'])->on('warehouse_subscriptions')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['warehouse_id'], 'renteds_ibfk_3')->references(['id'])->on('warehouses')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['transaction_id'], 'renteds_ibfk_4')->references(['id'])->on('transactions')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('renteds', function (Blueprint $table) {
            $table->dropForeign('renteds_ibfk_1');
            $table->dropForeign('renteds_ibfk_2');
            $table->dropForeign('renteds_ibfk_3');
            $table->dropForeign('renteds_ibfk_4');
        });
    }
};
