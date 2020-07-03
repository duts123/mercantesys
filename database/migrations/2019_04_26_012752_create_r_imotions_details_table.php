<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRImotionsDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('r_imotions_details', function(Blueprint $table)
		{
			$table->integer('rid_imotionid', true);
			$table->string('rid_imotionname', 100);
			$table->string('rid_imotionimagepath', 1500);
			$table->dateTime('rid_imotionadded')->nullable();
			$table->dateTime('rid_imotionremove')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('r_imotions_details');
	}

}
