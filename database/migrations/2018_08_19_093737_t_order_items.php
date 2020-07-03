<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TOrderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("T_ORDER_ITEMS",function(Blueprint $table){
            $table->engine = "INNODB";

            $table->increments("ORDI_ID");
            $table->unsignedInteger("ORD_ID");
            $table->unsignedInteger("PROD_ID");
            $table->unsignedInteger("PRODV_ID")->nullable();
            $table->integer("ORDI_QTY")->default(1);
            $table->text("ORDI_NOTE")->nullable();
            $table->text("PROD_NAME");
            $table->text("PROD_DESC");
            $table->double("PROD_MY_PRICE",10,2);
            $table->text("PROD_SKU");
            $table->double("ORDI_SOLD_PRICE",10,2);
            $table->timestamps();

            $table->foreign("ORD_ID")->references("ORD_ID")->on("T_ORDERS")
                ->onUpdate("cascade")
                ->onDelete("no action");
            $table->foreign("PROD_ID")->references("PROD_ID")->on("r_product_infos")
                ->onUpdate("cascade")
                ->onDelete("no action");
            $table->foreign("PRODV_ID")->references("PRODV_ID")->on("T_PRODUCT_VARIANCES")
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
        Schema::dropIfExists('T_ORDER_ITEMS');
    }
}
