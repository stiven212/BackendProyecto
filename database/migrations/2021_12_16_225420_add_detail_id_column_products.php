<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailIdColumnProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('details_buy_product', function (Blueprint $table){
            $table->unsignedBigInteger('details_buy_id')->unsigned();
            $table
                ->foreign('details_buy_id')
                ->references('id')
                ->on('details_buys')
                ->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->unsigned();
            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
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
        //
        Schema::enableForeignKeyConstraints();
        Schema::dropIfExists('products_details');
        Schema::enableForeignKeyConstraints();

    }
}
