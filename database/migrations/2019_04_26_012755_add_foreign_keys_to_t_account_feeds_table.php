<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTAccountFeedsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t_account_feeds', function(Blueprint $table)
		{
			$table->foreign('tafd_postcreator', 't_account_feeds_ibfk_1')->references('rac_accountid')->on('r_account_credentials')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('t_account_feeds', function(Blueprint $table)
		{
			$table->dropForeign('t_account_feeds_ibfk_1');
		});
	}

}
