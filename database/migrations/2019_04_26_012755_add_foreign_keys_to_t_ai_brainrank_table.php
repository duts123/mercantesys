<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTAiBrainrankTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t_ai_brainrank', function(Blueprint $table)
		{
			$table->foreign('tab_imotionidtorel', 't_ai_brainrank_ibfk_1')->references('rid_imotionid')->on('r_imotions_details')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('t_ai_brainrank', function(Blueprint $table)
		{
			$table->dropForeign('t_ai_brainrank_ibfk_1');
		});
	}

}
