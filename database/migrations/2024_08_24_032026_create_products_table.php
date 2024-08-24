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
            $table->string('title', 50);
            $table->text('short_description');
            $table->string('price', 50);
            $table->boolean('discount');
            $table->string('discount_price', 50);
            $table->string('image', 300);
            $table->boolean('stock');
            $table->double('star');
            $table->enum('remark',['top', 'new', 'old', 'low']);

            //foreng key
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            //Relation
            $table->foreign('category_id')->references('id')->on('categories')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('brand_id')->references('id')->on('brands')->restrictOnDelete()->cascadeOnUpdate();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->index('title');
            $table->index('price');
            $table->index('discount');
            $table->index('discount_price');
            $table->index('remark');
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
