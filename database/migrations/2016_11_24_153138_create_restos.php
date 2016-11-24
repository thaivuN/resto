<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestos extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restos', function (Blueprint $table) {
            $table->increments('id');
            //$table->timestamps('created');
            $table->timestamps('modified')->nullable();
            $table->string('name');
            $table->integer('civic#')->unsigned();
            $table->string('street');
            $table->string('city');
            $table->string('postal_code');
            $table->string('price');
            $table->decimal('longitude',9,6);
            $table->decimal('latitude',9,6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restos');
    }
}
