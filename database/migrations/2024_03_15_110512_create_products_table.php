<?php

use App\Models\ProductCategory;
use App\Models\Rack;
use App\Models\Subscription;
use App\Models\Supplier;
use App\Models\Tenant;
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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Tenant::class);
            $table->foreignIdFor(Warehouse::class);
            $table->foreignIdFor(Subscription::class);
            $table->foreignIdFor(ProductCategory::class);
            $table->foreignIdFor(Rack::class);
            $table->string('name');
            $table->bigInteger('sale_price');
            $table->bigInteger('weight');
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->date('expired_date')->nullable();
            $table->longText('description')->nullable();
            $table->enum('status', ['active', 'inactive', 'damaged'])->default('active');
            $table->enum('availability_status', ['available', 'run_out'])->default('available');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
