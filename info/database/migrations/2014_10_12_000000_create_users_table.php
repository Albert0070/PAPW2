<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->nullable();
            $table->string('nick', 20)->unique();
            $table->string('name', 255);
            $table->string('address', 255)->nullable();
            $table->string('phone', 255)->nullable();

            $table->string('email', 250)->unique();
            $table->string('password', 255);
            $table->rememberToken();
            $table->timestamps();
            //$table->unique('email');
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
    }
}
