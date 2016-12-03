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
            $table->timestamps();
            $table->string('name');
             $table->integer('civic_num')->unsigned();
            $table->string('street');
            $table->integer('suite')->unsigned()->nullable();
            $table->string('city');
            $table->string('country');
            $table->string('postal_code');
            $table->decimal('longitude',10,6);
            $table->decimal('latitude',10,6);
            $table->decimal('price',2,1);
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
