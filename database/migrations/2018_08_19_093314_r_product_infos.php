<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RProductInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("r_product_infos",function(Blueprint $table){
            $table->engine = 'INNODB';

            $table->increments("PROD_ID");
            $table->unsignedInteger("PRODT_ID")->nullable();
            $table->unsignedInteger("AFF_ID");
            $table->text("PROD_DESC")->nullable();
            $table->text("PROD_NOTE")->nullable();
            $table->text("PROD_IMG")->nullable();
            $table->string("PROD_CODE",20)->unique();
            $table->string("PROD_NAME",100);
            $table->integer('PROD_INIT_QTY')->default(500);
            $table->integer('PROD_DISCOUNT')->default(0);
            $table->integer('PROD_CRITICAL')->default(100);
            $table->double("PROD_BASE_PRICE",10,2);
            $table->double("PROD_MY_PRICE",10,2)->default(0.00);
            $table->text("PROD_AVAILABILITY")->nullable();
            $table->boolean("PROD_IS_APPROVED")->nullable();
            $table->dateTime("PROD_APPROVED_AT")->nullable();
            $table->boolean("PROD_DISPLAY_STATUS")->default(1);
            $table->timestamps(                                                                                                                                                                                                                                                                                                                                           );

            $table->foreign("PRODT_ID")->references("PRODT_ID")->on("R_PRODUCT_TYPES")
                ->onUpdate("cascade")
                ->onDelete("no action");
            $table->foreign("AFF_ID")->references("AFF_ID")->on("R_AFFILIATE_INFOS")
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
        Schema::dropIfExists('r_product_infos');
    }
}
