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
        Schema::table('warehouse_subscription_carts', function (Blueprint $table) {
            $table->foreign(['warehouse_id'], 'warehouse_subscription_carts_ibfk_1')->references(['id'])->on('warehouses')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['subscription_id'], 'warehouse_subscription_carts_ibfk_2')->references(['id'])->on('subscriptions')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warehouse_subscription_carts', function (Blueprint $table) {
            $table->dropForeign('warehouse_subscription_carts_ibfk_1');
            $table->dropForeign('warehouse_subscription_carts_ibfk_2');
        });
    }
};
