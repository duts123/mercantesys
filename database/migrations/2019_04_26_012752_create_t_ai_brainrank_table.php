<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTAiBrainrankTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_ai_brainrank', function(Blueprint $table)
		{
			$table->integer('tab_airelationid', true);
			$table->integer('tab_imotionidtorel')->index('tab_imotionidtorel');
			$table->string('tab_value', 250);
			$table->dateTime('tab_dateadded')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t_ai_brainrank');
	}

}
