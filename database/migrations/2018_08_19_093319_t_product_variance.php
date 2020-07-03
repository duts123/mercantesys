<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TProductVariance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T_PRODUCT_VARIANCES', function (Blueprint $table) {
            $table->increments('PRODV_ID');
            $table->unsignedInteger('PROD_ID');
            $table->string('PRODV_NAME',100);
            $table->string('PRODV_SKU',100);
            $table->text('PRODV_DESC');
            $table->integer('PRODV_INIT_QTY');
            $table->double('PRODV_ADD_PRICE',10,2)->default(0.00);
            $table->text('PRODV_IMG')->nullable();
            $table->timestamps();

            $table->foreign('PROD_ID')->references('PROD_ID')->on('r_product_infos')
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
        Schema::dropIfExists('T_PRODUCT_VARIANCES');
    }
}
