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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->longText('description');

            //foreng key
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            //Relation
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('product_id')->references('id')->on('products')->restrictOnDelete()->cascadeOnUpdate();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
    }
};
