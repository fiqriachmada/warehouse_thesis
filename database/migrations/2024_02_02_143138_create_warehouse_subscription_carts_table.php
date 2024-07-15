<?php

use App\Models\Subscription;
use App\Models\Warehouse;
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
        Schema::create('warehouse_subscription_carts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Warehouse::class)->nullable();
            $table->foreignIdFor(Subscription::class)->nullable();
            $table->bigInteger('price_rate')->nullable();
            $table->bigInteger('total_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_subscription_carts');
    }
};
