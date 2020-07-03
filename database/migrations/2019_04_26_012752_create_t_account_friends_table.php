<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTAccountFriendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_account_friends', function(Blueprint $table)
		{
			$table->integer('tafr_makefriendtranscationid', true);
			$table->integer('tafr_userprofileid')->index('taf_userprofileid');
			$table->integer('tafr_friendlyuserid')->index('taf_friendlyuserid');
			$table->dateTime('tafr_dateaccompanied');
			$table->integer('tafr_isfollowed')->default(1);
			$table->integer('tafd_isaccepted')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t_account_friends');
	}

}
