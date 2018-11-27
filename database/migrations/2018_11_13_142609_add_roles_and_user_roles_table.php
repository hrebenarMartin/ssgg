<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRolesAndUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('display_name');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('user_roles', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('role_id');
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
        Schema::dropIfExists('roles');
        Schema::dropIfExists('user_roles');
    }
}
