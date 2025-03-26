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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->integer('price');
            $table->integer('sale')->nullable();
            $table->integer('hot')->default(0);
            $table->text('description');
            $table->string('img', 255);
            $table->text('content');
            $table->integer('status')->default(1);
            $table->integer('total_pay')->default(0);
            $table->timestamps();
            $table->unsignedBigInteger('categories_id');

            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
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
