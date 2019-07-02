<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname');
            $table->string('username')->unique();
            $table->string('password');
            $table->integer('type');
            $table->integer('active');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('user_departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('department_id');
            $table->integer('active');
            $table->timestamps();
        });
        Schema::create('user_communicate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('department_id');
            $table->text('title');
            $table->text('description');
            $table->integer('active');
            $table->timestamps();
        });
        Schema::create('user_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('department_id');
            $table->string('code');
            $table->float('price');
            $table->text('title');
            $table->text('description');
            $table->integer('active');
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('user_departments');
        Schema::dropIfExists('user_communicate');
        Schema::dropIfExists('user_payment');
    }
}
