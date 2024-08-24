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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->string('img1', 300);
            $table->string('img2', 300);
            $table->string('img3', 300);
            $table->string('color', 50);
            $table->string('size', 50);
            $table->longText('description');

            //foreng key
            $table->unsignedBigInteger('product_id')->unique();
            //Relation
            $table->foreign('product_id')->references('id')->on('products')->restrictOnDelete()->cascadeOnUpdate();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->index('img1');
            $table->index('color');
            $table->index('size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
