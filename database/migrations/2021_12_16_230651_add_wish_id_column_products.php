<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWishIdColumnProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('products_wish', function (Blueprint $table){
            $table->unsignedBigInteger('wish_id')->unsigned();
            $table
                ->foreign('wish_id')
                ->references('id')
                ->on('wish_lists')
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
        Schema::table('products', function (Blueprint $table){
            $table->dropForeign(['wish_id']);
        });
    }
}
