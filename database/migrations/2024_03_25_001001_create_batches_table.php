<?php

use App\Models\Product;
use App\Models\Tenant;
use App\Models\Warehouse;
use App\Models\Subscription;
use App\Models\Supplier;
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
        Schema::create('batches', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Tenant::class);
            $table->foreignIdFor(Warehouse::class);
            $table->foreignIdFor(Subscription::class);
            $table->foreignIdFor(Supplier::class);
            $table->foreignIdFor(Product::class);
            $table->string('code')->unique();
            $table->bigInteger('price');
            $table->bigInteger('on_hand');
            $table->bigInteger('available');
            $table->dateTime('received_at');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
