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
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign(['tenant_id'], 'transactions_ibfk_1')->references(['id'])->on('tenants')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['tax_id'], 'transactions_ibfk_2')->references(['id'])->on('taxes')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['bank_id'], 'transactions_ibfk_3')->references(['id'])->on('banks')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('transactions_ibfk_1');
            $table->dropForeign('transactions_ibfk_2');
            $table->dropForeign('transactions_ibfk_3');
        });
    }
};
