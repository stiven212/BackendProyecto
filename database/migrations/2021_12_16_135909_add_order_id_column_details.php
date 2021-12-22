<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderIdColumnDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('buy_details', function (Blueprint $table){
            $table->unsignedBigInteger('order_buy_id')->unsigned();
            $table->foreign('order_buy_id')->references('id')->on('order_buys')->onDelete('cascade');
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
        Schema::table('buy_details', function (Blueprint $table){
            $table->dropForeign(['order_id']);
        });
    }
}
