<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_buys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('details');
            $table->float('iva');
            $table->float('subtotal');
            $table->float('total');
            $table->integer('quantity');
            $table->text('products');
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
        Schema::dropIfExists('details_buys');
    }
}
