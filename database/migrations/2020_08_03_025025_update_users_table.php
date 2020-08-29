<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->enum('gender', ['male','female']);
            $table->string('nationality');
            $table->date('dob');
            $table->integer('age');
            $table->integer('height');
            $table->integer('weight');
            $table->string('skin_color');
            $table->boolean('tribal');
            $table->string('hair_color');
            $table->string('hair_type');
            $table->string('eye_color');
            $table->enum('marital_status', ['single','married','divorced','widowed']);
            $table->string('job');
            $table->enum('education', ['middle_school','high_school','bachelors','masters','doctorate']);
            $table->boolean('smoker');
            $table->longText('details');
            $table->boolean('polygamy_friendly');
            $table->boolean('misyar_friendly');
            $table->enum('account_status', ['standard','paid']);
            $table->date('membership_expiry')->nullable();
            $table->longText('search_index')->nullable();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
