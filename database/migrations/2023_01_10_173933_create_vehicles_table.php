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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            
            $table->string('reference')->nullable();
            $table->string('brand')->nullable();
            $table->string('colour')->nullable();
            $table->string('car_license_plate')->nullable();
            
            $table->unsignedBigInteger('users_owner_id')->nullable();
            $table->foreign('users_owner_id')->references('id')->on('users');

            $table->unsignedBigInteger('type_vehicles_type_id')->nullable();
            $table->foreign('type_vehicles_type_id')->references('id')->on('type_vehicles');

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
        Schema::dropIfExists('vehicles');
    }
};
