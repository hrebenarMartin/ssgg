<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conference', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_sk');
            $table->string('title_en');
            $table->smallInteger('status');
            $table->string('address_city');
            $table->string('address_place');
            $table->string('address_country');
            $table->dateTime('registration_start');
            $table->dateTime('registration_end');
            $table->dateTime('conference_start');
            $table->dateTime('conference_end');
            $table->string('proceedings_file');
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
        Schema::dropIfExists('conference');
    }
}
