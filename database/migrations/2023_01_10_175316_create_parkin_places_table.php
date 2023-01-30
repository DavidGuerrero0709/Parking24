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
        Schema::create('parkin_places', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('letter');
            $table->string('number');
            $table->enum('status', [0,1])->default(0);

            $table->unsignedBigInteger('type_vehicles_id');
            $table->foreign('type_vehicles_id')->references('id')->on('type_vehicles');

            $table->unsignedBigInteger('type_business_id');
            $table->foreign('type_business_id')->references('id')->on('type_bussines');

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
        Schema::dropIfExists('parkin_places');
    }
};
