<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TShipmentOrderitems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("T_SHIPMENT_ORDERITEMS",function(Blueprint $table){
            $table->engine = "INNODB";

            $table->increments("SHIPORDI_ID");
            $table->unsignedInteger("SHIP_ID");
            $table->unsignedInteger("ORDI_ID");
            $table->timestamps();

            $table->foreign("SHIP_ID")->references("SHIP_ID")->on("T_SHIPMENTS")
                ->onUpdate("cascade")
                ->onDelete("no action");
            $table->foreign("ORDI_ID")->references("ORDI_ID")->on("T_ORDER_ITEMS")
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
        Schema::dropIfExists('T_SHIPMENT_ORDERITEMS');
    }
}
