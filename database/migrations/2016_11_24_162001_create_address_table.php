<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('civic#')->unsigned();
            $table->string('street');
            $table->integer('suite')->unsigned()->nullable();
            $table->string('city');
            $table->string('country');
            $table->string('postal_code');
            $table->decimal('longitude',10,6);
            $table->decimal('latitude',10,6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
