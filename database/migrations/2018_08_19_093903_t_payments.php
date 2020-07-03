<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("T_PAYMENTS",function(Blueprint $table){
            $table->engine = "INNODB";

            $table->increments("PAY_ID");
            $table->unsignedInteger("INV_ID");
            $table->string("PAY_RECIEVED_BY",50);
            $table->double("PAY_AMOUNT_DUE",10,2);
            $table->double("PAY_SUB_TOTAL",10,2);
            $table->double("PAY_SALES_TAX",10,2);
            $table->double("PAY_DELIVERY_CHARGE",10,2);
            $table->datetime("PAY_CAPTURED_AT")->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('T_PAYMENTS');
    }
}
