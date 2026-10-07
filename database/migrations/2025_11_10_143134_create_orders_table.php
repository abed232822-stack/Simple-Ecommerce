<?php

use App\Models\Products;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->float('total');
            $table->string('status');
            $table->timestamp($columen = "created_at")->useCurrent()->nullable();
            $table->timestamp($columen = "updated_at")->useCurrent()->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
