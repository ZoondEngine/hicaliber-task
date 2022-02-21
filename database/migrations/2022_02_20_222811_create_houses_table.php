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
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->integer('price')->nullable(false)->unsigned();
            $table->integer('bedrooms')->nullable(false)->unsigned();
            $table->integer('bathrooms')->nullable(false)->unsigned();
            $table->integer('storeys')->nullable(false)->unsigned();
            $table->integer('garages')->nullable(false)->unsigned();
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
        Schema::dropIfExists('houses');
    }
};
