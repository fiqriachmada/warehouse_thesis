<?php

use App\Models\Admin;
use App\Models\Country;
use App\Models\WarehouseCategory;
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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Admin::class);
            $table->foreignIdFor(WarehouseCategory::class);
            $table->foreignIdFor(Country::class);
            $table->string('name');
            $table->string('capacity');
            $table->integer('surface_area');
            $table->integer('building_area');
            $table->string('city');
            $table->integer('zip_code');
            $table->longText('address');
            $table->longText('description')->nullable();
            $table->integer('storage_shelves');
            $table->json('goods_handling_equipment')->nullable();
            $table->enum('effective_lighting_system', ['yes', 'no']);
            $table->enum('advanced_security_system', ['yes', 'no']);
            $table->integer('toilet_and_rest_area');
            $table->enum('electricity', ['yes', 'no']);
            $table->enum('administrative_room_or_office', ['yes', 'no']);
            $table->enum('worker_safety_equipment', ['yes', 'no']);
            $table->enum('firefighting_tools', ['yes', 'no']);
            $table->enum('status', ['available', 'rented', 'maintenance', 'damaged', 'unavailable'])->default('available');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
