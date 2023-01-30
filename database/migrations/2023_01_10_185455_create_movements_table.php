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
        Schema::create('movements', function (Blueprint $table) {
            $table->id();

            $table->double('revenue');
            $table->double('spent');

            $table->unsignedBigInteger('users_saler_id');
            $table->foreign('users_saler_id')->references('id')->on('users');
            
            $table->text('description')->nullable();
            $table->timestamp('date')->nullable();
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
        Schema::dropIfExists('movements');
    }
};
