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
        Schema::create('product_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->text('short_description');
            $table->string('img', 300);


            //foreng key
            $table->unsignedBigInteger('product_id')->unique();
            //Relation
            $table->foreign('product_id')->references('id')->on('products')->restrictOnDelete()->cascadeOnUpdate();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();


            $table->index('img');
            $table->index('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sliders');
    }
};
