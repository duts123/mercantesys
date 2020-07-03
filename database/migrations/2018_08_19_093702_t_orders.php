<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("T_ORDERS",function(Blueprint $table){
            $table->engine= "INNODB";

            $table->increments("ORD_ID");
            $table->unsignedInteger("ORD_FROM_SYMPIES_ID")->nullable();
            $table->unsignedInteger("ORD_TO_SYMPIES_ID")->nullable();
            $table->text("ORD_SYMP_TRANS_CODE");
            $table->text("ORD_TRANS_CODE");
            $table->text("ORD_PAY_CODE");
            $table->string("ORD_FROM_NAME",50);
            $table->string("ORD_TO_NAME",50);
            $table->string("ORD_FROM_EMAIL",50);
            $table->string("ORD_TO_EMAIL",50);
            $table->string("ORD_FROM_CONTACT",50)->nullable();
            $table->string("ORD_TO_CONTACT",50)->nullable();
            $table->text("ORD_TO_ADDRESS");
            $table->string("ORD_FUNDING",50);
            $table->double("ORD_DISCOUNT",10,2)->default(0);
            $table->string("ORD_STATUS",25)->default("Pending");
            $table->string("ORD _VOUCHER_CODE",20)->nullable();
            $table->dateTime("ORD_COMPLETE")->nullable();
            $table->dateTime("ORD_CANCELLED")->nullable();
            $table->boolean("ORD_DISPLAY_STATUS")->default(1);
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
        Schema::dropIfExists('T_ORDERS');
    }
}
