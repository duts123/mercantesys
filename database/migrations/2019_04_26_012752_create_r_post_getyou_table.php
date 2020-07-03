<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRPostGetyouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('r_post_getyou', function(Blueprint $table)
		{
			$table->integer('rpg_postrelate')->index('rpg_postrelate');
			$table->integer('rpg_actormakeget')->index('rpg_actormakeget');
			$table->dateTime('rpg_getyoudateadded')->nullable();
			$table->integer('rpg_isremoved');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('r_post_getyou');
	}

}
