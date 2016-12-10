<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration file for updating restos
 * @author Hau Gilles Che
 */
class UpdateRestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restos', function (Blueprint $table) {
          /*  $table->dropColumn('civic_num');
            $table->dropColumn('street');
            $table->dropColumn('city');
            $table->dropColumn('postal_code');
            $table->dropColumn('longitude');
            $table->dropColumn('latitude');*/
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('link')->nullable();
            $table->string('province');
            $table->text('image_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
       // Schema::table('restos', function (Blueprint $table) {
           /*$table->integer('civic#')->unsigned();
            $table->string('street');
            $table->string('city');
            $table->string('postal_code');
            $table->string('price');
            $table->decimal('longitude',9,6);
            $table->decimal('latitude',9,6);
            $table->dropColumn('email');
            $table->dropColumn('phone#');*/
       // });
    }
}
