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
        Schema::table('products', function (Blueprint $table) {
            $table->foreign(['tenant_id'], 'products_ibfk_1')->references(['id'])->on('tenants')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['warehouse_id'], 'products_ibfk_2')->references(['id'])->on('warehouses')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['subscription_id'], 'products_ibfk_3')->references(['id'])->on('subscriptions')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['rack_id'], 'products_ibfk_4')->references(['id'])->on('racks')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['product_category_id'], 'products_ibfk_5')->references(['id'])->on('product_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_ibfk_1');
            $table->dropForeign('products_ibfk_2');
            $table->dropForeign('products_ibfk_3');
            $table->dropForeign('products_ibfk_4');
            $table->dropForeign('products_ibfk_5');
        });
    }
};
