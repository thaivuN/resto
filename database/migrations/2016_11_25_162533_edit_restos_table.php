<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditRestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restos', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('genre_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->foreign('user_id')->references('id')
                    ->on('users')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')
                    ->on('genres')->onDelete('cascade');
            //$table->foreign('address_id')->references('id')
              //      ->on('addresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restos', function (Blueprint $table) {
            //
        });
    }
}
