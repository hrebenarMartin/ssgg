<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfrenceConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conference_config', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conference_id');
            
            $table->boolean('day1_breakfast');
            $table->boolean('day1_lunch');
            $table->boolean('day1_dinner');
            $table->boolean('day2_breakfast');
            $table->boolean('day2_lunch');
            $table->boolean('day2_dinner');
            $table->boolean('day3_breakfast');
            $table->boolean('day3_lunch');
            $table->boolean('day3_dinner');
            $table->boolean('day4_breakfast');
            $table->boolean('day4_lunch');
            $table->boolean('day4_dinner');
            $table->boolean('day5_breakfast');
            $table->boolean('day5_lunch');
            $table->boolean('day5_dinner');

            $table->boolean('special_1');
            $table->text('special_1_desc_sk');
            $table->text('special_1_desc_en');
            $table->boolean('special_2');
            $table->text('special_2_desc_sk');
            $table->text('special_2_desc_en');
            $table->boolean('special_3');
            $table->text('special_3_desc_sk');
            $table->text('special_3_desc_en');

            $table->boolean('accom_1');
            $table->integer('accom_1_price');
            $table->boolean('accom_2');
            $table->integer('accom_2_price');
            $table->boolean('accom_3');
            $table->integer('accom_3_price');
            $table->boolean('accom_4');
            $table->integer('accom_4_price');
            $table->boolean('accom_5');
            $table->integer('accom_5_price');

            $table->text('extra_info_sk');
            $table->text('extra_info_en');

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
        Schema::dropIfExists('conference_config');
    }
}
