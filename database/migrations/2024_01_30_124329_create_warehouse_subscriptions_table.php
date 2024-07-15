<?php

use App\Models\Warehouse;
use App\Models\Subscription;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('warehouse_subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Warehouse::class);
            $table->foreignIdFor(Subscription::class);
            $table->bigInteger('price_rate');
            $table->bigInteger('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_subscriptions');
    }
};
