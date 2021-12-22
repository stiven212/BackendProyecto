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

        Schema::create('buy_detail_product', function (Blueprint $table){
            $table->unsignedBigInteger('buy_detail_id')->unsigned();
            $table
                ->foreign('buy_detail_id')
                ->references('id')
                ->on('buy_details')
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
        Schema::dropIfExists('details_buy_product');
        Schema::enableForeignKeyConstraints();

    }
}
