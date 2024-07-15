<?php

use App\Models\Bank;
use App\Models\Tax;
use App\Models\Tenant;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Tenant::class);
            $table->foreignIdFor(Tax::class);
            $table->foreignIdFor(Bank::class)->nullable();
            $table->bigInteger('grand_total');
            $table->enum('status', ['payment', 'success', 'confirmed', 'declined'])->default('payment');
            $table->dateTime('payment_due')->nullable();
            $table->string('snap_token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
