<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration file for creating restos
 * @author Hau Gilles Che
 */
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
            $table->string('suite')->nullable();
            $table->string('city');
            $table->string('country');
            $table->string('postal_code');
            $table->decimal('longitude',11,7);
            $table->decimal('latitude',11,7);
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
