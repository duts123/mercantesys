<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RAffiliateInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('R_AFFILIATE_INFOS',function(Blueprint $table){
            $table->engine = 'INNODB';

            $table->increments('AFF_ID');
            $table->string("AFF_CODE",20)->unique();
            $table->string("AFF_NAME",100)->unique();
            $table->text("AFF_DESC");
            $table->text("AFF_PAYMENT_INSTRUCTION");
            $table->string("AFF_PAYMENT_MODE",50);
            $table->boolean("AFF_DISPLAY_STATUS")->default(1);
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
        Schema::dropIfExists('R_AFFILIATE_INFOS');
    }
}
