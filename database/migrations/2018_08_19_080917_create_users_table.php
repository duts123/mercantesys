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

        Schema::create('USERS', function (Blueprint $table) {
            $table->engine = 'INNODB';

            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('member');
            $table->unsignedInteger('AFF_ID')->nullable();
            $table->rememberToken();
            $table->boolean('USER_DisplayStat')->default(1);
            $table->timestamps();
        });
        Schema::table("users",function(Blueprint $table){

            $table->foreign("AFF_ID")->references("AFF_ID")->on("R_AFFILIATE_INFOS")
                ->onUpdate("cascade")
                ->onDelete("cascade");

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('USERS');
    }
}
