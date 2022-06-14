<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_pizza', function (Blueprint $table) {

           $table->bigInteger('cart_id')->unsigned();
            $table->foreign('cart_id')->references('id')->on('carts');

            $table->bigInteger('pizza_id')->unsigned();
            $table->foreign('pizza_id')->references('id')->on('pizzas');

            $table->integer('quantity');
            $table->float('price');
            $table->float('total', 10, 2);
            $table->json('addons')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_pizza');
    }
};
