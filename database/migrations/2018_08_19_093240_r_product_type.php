<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RProductType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('R_PRODUCT_TYPES', function (Blueprint $table) {
            //

            $table->engine = 'INNODB';

            $table->increments("PRODT_ID");
            $table->string("PRODT_TITLE");
            $table->text("PRODT_DESC");
            $table->string("PRODT_ICON")->nullable();
            $table->unsignedInteger("PRODT_PARENT")->nullable();
            $table->boolean("PRODT_DISPLAY_STATUS")->default(1);
            $table->timestamps();

            $table->foreign('PRODT_PARENT')->references('PRODT_ID')->on('R_PRODUCT_TYPES')
                ->onUpdate('cascade')
                ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('R_PRODUCT_TYPES', function (Blueprint $table) {
            //
        });
    }
}
