<?php

use App\Models\Category;
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
        Schema::create('category_products', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignIdFor(Products::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->timestamp($columen = "created_at")->useCurrent()->nullable();
            $table->timestamp($columen = "updated_at")->useCurrent()->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
