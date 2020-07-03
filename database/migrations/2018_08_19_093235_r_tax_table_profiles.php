<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RTaxTableProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('R_TAX_TABLE_PROFILES', function (Blueprint $table) {
            $table->engine="INNODB";

            $table->increments('TAXP_ID');
            $table->string('TAXP_NAME',200);
            $table->text('TAXP_DESC');
            $table->double('TAXP_RATE',10,2);
            $table->boolean('TAXP_TYPE');
            $table->boolean('TAXP_DISPLAY_STATUS')->default(1);

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
        Schema::dropIfExists('R_TAX_TABLE_PROFILES');
    }
}
