<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('conference_id');

            $table->boolean('day1_breakfast')->default(0);
            $table->boolean('day1_lunch')->default(0);
            $table->boolean('day1_dinner')->default(0);
            $table->boolean('day2_breakfast')->default(0);
            $table->boolean('day2_lunch')->default(0);
            $table->boolean('day2_dinner')->default(0);
            $table->boolean('day3_breakfast')->default(0);
            $table->boolean('day3_lunch')->default(0);
            $table->boolean('day3_dinner')->default(0);
            $table->boolean('day4_breakfast')->default(0);
            $table->boolean('day4_lunch')->default(0);
            $table->boolean('day4_dinner')->default(0);
            $table->boolean('day5_breakfast')->default(0);
            $table->boolean('day5_lunch')->default(0);
            $table->boolean('day5_dinner')->default(0);

            $table->boolean('special_1')->default(0);
            $table->boolean('special_2')->default(0);
            $table->boolean('special_3')->default(0);

            $table->boolean('accom_1')->default(0);
            $table->boolean('accom_2')->default(0);
            $table->boolean('accom_3')->default(0);
            $table->boolean('accom_4')->default(0);
            $table->boolean('accom_5')->default(0);

            $table->text('extra')->nullable();

            $table->integer('status')->default(0); //0=vytvorená, 1=potvrdená, 2=zaplatená

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
        Schema::dropIfExists('applications');
    }
}
