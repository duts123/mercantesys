<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TSetup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T_SETUPS', function (Blueprint $table) {
            $table->engine = 'INNODB';

            $table->increments('SET_ID');
            $table->unsignedInteger('CURR_ID');
            $table->double('SET_DEL_CHARGE',10,2);
            $table->double('SET_SERVICE_FEE',10,2);
            $table->timestamps();

            $table->foreign("CURR_ID")->references("CURR_ID")->on("R_CURRENCIES")
                ->onUpdate("cascade")
                ->onDelete("no action");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('T_SETUPS', function (Blueprint $table) {
            //
        });
    }
}
