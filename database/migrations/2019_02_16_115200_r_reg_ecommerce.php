<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RRegEcommerce extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('R_REG_ECOMMERCE', function (Blueprint $table) {
            $table->engine = 'INNODB';

            $table->increments("REG_ID");
            $table->text('REG_ACCRE_CODE')->nullable();
            $table->text('REG_SERIAL_CODE')->nullable();
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
        Schema::table('R_REG_ECOMMERCE', function (Blueprint $table) {
            //
        });
    }
}
