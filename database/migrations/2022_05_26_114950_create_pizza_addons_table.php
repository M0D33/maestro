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
        Schema::create('pizza_addons', function (Blueprint $table) {

            $table->id();

            $table->bigInteger('pizza_id')->unsigned();
            $table->foreign('pizza_id')->references('id')->on('pizzas');

            $table->string('name'); // varchar 255

            // $table->enum('size', ['small','medium','large']);

            $table->string('topping')->nullable(); // varchar 255

            $table->longText('description')->nullable(); // text

            $table->string('image')->nullable(); // varchar 255

            $table->float('value', 10, 2)->nullable();

            $table->boolean('is_active')->default(true); // tinyint 2 - 0 or 1

            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizza_addons');
    }
};
