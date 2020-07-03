<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRPostGetyouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('r_post_getyou', function(Blueprint $table)
		{
			$table->foreign('rpg_postrelate', 'r_post_getyou_ibfk_1')->references('tafd_postid')->on('t_account_feeds')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('rpg_actormakeget', 'r_post_getyou_ibfk_2')->references('rac_accountid')->on('r_account_credentials')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('r_post_getyou', function(Blueprint $table)
		{
			$table->dropForeign('r_post_getyou_ibfk_1');
			$table->dropForeign('r_post_getyou_ibfk_2');
		});
	}

}
