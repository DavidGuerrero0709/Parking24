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
        Schema::create('type_bussines', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->timestamp('time')->nullable();
            $table->double('prize')->nullable();
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
        Schema::dropIfExists('type_bussines');
    }
};
