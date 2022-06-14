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
        Schema::create('pizzas', function (Blueprint $table) {

            $table->id();


             $table->bigInteger('size_id')->unsigned()->nullable();
             $table->foreign('size_id')->references('id')->on('sizes');

            $table->string('name'); // varchar 255

            $table->text('summary')->nullable();

            $table->float('price')->nullable();

            $table->enum('size', ['small','medium','large']);

            $table->longText('description')->nullable(); // text

            $table->string('image')->nullable(); // varchar 255

            $table->boolean('is_active')->default(true); // tinyint 2 - 0 or 1

            $table->boolean('is_featured')->default(false); // tinyint 2 - 0 or 1

            $table->tinyInteger('sort_order')->default(0);

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
        Schema::dropIfExists('pizzas');
    }
};
