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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->string('color');
            $table->double('price');
            $table->double('sale');
            $table->unsignedBigInteger('wish_id')->unsigned();
            $table->unsignedBigInteger('car_id')->unsigned();
            $table->unsignedBigInteger('detail_id')->unsigned();
            $table->unsignedBigInteger('category_id')->unsigned();

            $table->timestamps();
        });
//
//        Schema::table('products', function (Blueprint $table){
//            $table
//                ->foreign('wish_id')
//                ->references('id')
//                ->on('wish_lists')
//                ->onDelete('cascade');
//        });
//
//
//




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('products');

        Schema::enableForeignKeyConstraints();

    }
}
