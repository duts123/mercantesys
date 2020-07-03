<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TShipments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("T_SHIPMENTS",function(Blueprint $table){
            $table->engine="INNODB";

            $table->increments("SHIP_ID");
            $table->unsignedInteger("ORD_ID");
            $table->unsignedInteger("INV_ID");
            $table->string("SHIP_TRACKING_NO",20);
            $table->string("SHIP_STATUS",30)->default('Pending');
            $table->text("SHIP_DESC")->nullable();
            $table->timestamps();

            $table->foreign("ORD_ID")->references("ORD_ID")->on("T_ORDERS")
                ->onUpdate("cascade")
                ->onDelete("no action");

            $table->foreign("INV_ID")->references("INV_ID")->on("T_INVOICES")
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
        Schema::dropIfExists('T_SHIPMENTS');
    }
}
