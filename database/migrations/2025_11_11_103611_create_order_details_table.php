<?php

use App\Models\Order;
use App\Models\Products;
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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignIdFor(Order::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Products::class)->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->float('subTotal');
            $table->timestamp($columen = "created_at")->useCurrent()->nullable();
            $table->timestamp($columen = "updated_at")->useCurrent()->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
