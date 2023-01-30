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
        Schema::create('sale_parkings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('parking_places_id');
            $table->foreign('parking_places_id')->references('id')->on('parkin_places');

            $table->unsignedBigInteger('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('parkin_places');

            $table->unsignedBigInteger('promotions_id');
            $table->foreign('promotions_id')->references('id')->on('promotions');

            $table->unsignedBigInteger('type_bussines_id');
            $table->foreign('type_bussines_id')->references('id')->on('type_bussines');

            $table->unsignedBigInteger('users_saler_id');
            $table->foreign('users_saler_id')->references('id')->on('users');

            $table->double('subtotal')->nullable();
            $table->integer('iva')->nullable();
            $table->double('total')->nullable();
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
        Schema::dropIfExists('sale_parkings');
    }
};
