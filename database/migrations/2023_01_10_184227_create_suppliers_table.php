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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->string('identifier');
            $table->string('address');
            $table->string('phone');
            $table->string('cellphone');
            $table->string('neightboarhood');

            $table->unsignedBigInteger('cities_city_id');
            $table->foreign('cities_city_id')->references('id')->on('cities');

            $table->unsignedBigInteger('users_contact_id');
            $table->foreign('users_contact_id')->references('id')->on('users');

            $table->enum('status', [0,1])->default(1);

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
        Schema::dropIfExists('suppliers');
    }
};
