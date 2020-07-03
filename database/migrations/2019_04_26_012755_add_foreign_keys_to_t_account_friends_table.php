<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTAccountFriendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t_account_friends', function(Blueprint $table)
		{
			$table->foreign('tafr_userprofileid', 't_account_friends_ibfk_1')->references('rac_accountid')->on('r_account_credentials')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('tafr_friendlyuserid', 't_account_friends_ibfk_2')->references('rac_accountid')->on('r_account_credentials')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('t_account_friends', function(Blueprint $table)
		{
			$table->dropForeign('t_account_friends_ibfk_1');
			$table->dropForeign('t_account_friends_ibfk_2');
		});
	}

}
