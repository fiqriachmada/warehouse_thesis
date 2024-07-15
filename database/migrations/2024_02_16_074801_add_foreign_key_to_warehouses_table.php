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
        Schema::table('warehouses', function (Blueprint $table) {
            $table->foreign(['admin_id'], 'warehouses_ibfk_1')->references(['id'])->on('admins')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['warehouse_category_id'], 'warehouses_ibfk_2')->references(['id'])->on('warehouse_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['country_id'], 'warehouses_ibfk_3')->references(['id'])->on('countries')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warehouses', function (Blueprint $table) {
            $table->dropForeign('warehouses_ibfk_1');
            $table->dropForeign('warehouses_ibfk_2');
            $table->dropForeign('warehouses_ibfk_3');
        });
    }
};
