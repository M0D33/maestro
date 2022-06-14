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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'customer']) ->default('customer');

         // Personal Information
         $table->enum('title', ['mr', 'mrs', 'miss', 'dr', 'prof', 'etc'])->nullable();
         $table->string('first_name')->nullable();
         $table->string('last_name')->nullable();
         $table->enum('gender', ['male', 'female'])->nullable();
         $table->date('birthday')->nullable();
         $table->text('bio')->nullable();

         // Address
         $table->text('address_1')->nullable();
         $table->text('address_2')->nullable();

         $table->string('city')->nullable();
         $table->string('postcode')->nullable();
         $table->string('county')->default('LK')->nullable();

         $table->string('phone')->nullable();
         $table->string('mobile')->unique()->nullable();

         $table->string('avatar')->nullable();

         $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
