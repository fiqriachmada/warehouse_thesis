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
        Schema::table('detail_outbounds', function (Blueprint $table) {
            $table->foreign(['tenant_id'], 'detail_outbounds_ibfk_1')->references(['id'])->on('tenants')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['warehouse_id'], 'detail_outbounds_ibfk_2')->references(['id'])->on('warehouses')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['subscription_id'], 'detail_outbounds_ibfk_3')->references(['id'])->on('subscriptions')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['outbound_id'], 'detail_outbounds_ibfk_4')->references(['id'])->on('outbounds')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['product_id'], 'detail_outbounds_ibfk_5')->references(['id'])->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_outbounds', function (Blueprint $table) {
            $table->dropForeign('detail_outbounds_ibfk_1');
            $table->dropForeign('detail_outbounds_ibfk_2');
            $table->dropForeign('detail_outbounds_ibfk_3');
            $table->dropForeign('detail_outbounds_ibfk_4');
            $table->dropForeign('detail_outbounds_ibfk_5');
        });
    }
};
