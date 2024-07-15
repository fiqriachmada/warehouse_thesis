<?php

use App\Models\Tenant;
use App\Models\Product;
use App\Models\Outbound;
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
        Schema::create('detail_outbounds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Tenant::class);
            $table->foreignIdFor(Warehouse::class);
            $table->foreignIdFor(Subscription::class);
            $table->foreignIdFor(Outbound::class);
            $table->foreignIdFor(Product::class);
            $table->bigInteger('quantity');
            $table->bigInteger('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_outbounds');
    }
};
