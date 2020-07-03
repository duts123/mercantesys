<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RInventoryInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('R_INVENTORY_INFOS', function (Blueprint $table) {
            $table->increments('INV_ID');
            $table->unsignedInteger('PROD_ID');
            $table->unsignedInteger('PRODV_ID')->nullable();
            $table->integer('INV_QTY')->default(0);
            $table->string('INV_TYPE',25)->default('add'); //add, dispose, order
            $table->unsignedInteger('ORDI_ID')->nullable();
            $table->timestamps();

            $table->foreign('ORDI_ID')->references('ORDI_ID')->on('T_ORDER_ITEMS')
                ->onUpdate("cascade")
                ->onDelete("No Action");

            $table->foreign('PROD_ID')->references('PROD_ID')->on('r_product_infos')
                ->onUpdate("cascade")
                ->onDelete("No Action");

            $table->foreign('PRODV_ID')->references('PRODV_ID')->on('T_PRODUCT_VARIANCES')
                ->onUpdate("cascade")
                ->onDelete("No Action");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('R_INVENTORY_INFOS');
    }
}
