<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create("T_INVOICES",function(Blueprint $table){
            $table->engine="INNODB";

            $table->increments("INV_ID");
            $table->unsignedInteger("ORD_ID");
            $table->string("INV_NO",25);
            $table->string("INV_STATUS",25);
            $table->text("INV_DETAILS");
            $table->timestamps();

            $table->foreign("ORD_ID")->references("ORD_ID")->on("T_ORDERS")
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
        Schema::dropIfExists('T_INVOICES');
    }
}
