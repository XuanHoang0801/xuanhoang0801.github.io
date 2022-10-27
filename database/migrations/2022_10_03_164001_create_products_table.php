<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('body');
            $table->integer('price');
            $table->integer('promotion');
            $table->unsignedBigInteger('categories_id');
            $table->unsignedBigInteger('producer_id');
            $table->string('image');
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('producer_id')->references('id')->on('producers');          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
