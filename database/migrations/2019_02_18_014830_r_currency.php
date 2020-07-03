<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RCurrency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('R_CURRENCIES', function (Blueprint $table) {
            $table->engine = 'INNODB';

            $table->increments("CURR_ID");
            $table->unsignedInteger("TAXP_ID");
            $table->string("CURR_NAME");
            $table->string("CURR_COUNTRY");
            $table->string("CURR_SYMBOL");
            $table->string("CURR_ACR");
            $table->double("CURR_RATE",10,2);
            $table->timestamps();

            $table->foreign("TAXP_ID")->references("TAXP_ID")->on("R_TAX_TABLE_PROFILES")
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
        Schema::table('R_CURRENCIES', function (Blueprint $table) {
            //
        });
    }
}
