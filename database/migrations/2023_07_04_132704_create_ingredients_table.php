<?php

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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ingredient_category_id');
            $table->string('name');
            $table->string('description');
            $table->string('image');
            $table->decimal('quantity');
            $table->decimal('price');
            $table->timestamps();

            $table->foreign('ingredient_category_id')->references('id')->on('ingredients_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
