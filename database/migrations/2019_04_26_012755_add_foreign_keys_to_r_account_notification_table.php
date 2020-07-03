<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRAccountNotificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('r_account_notification', function(Blueprint $table)
		{
			$table->foreign('ran_postid', 'r_account_notification_ibfk_1')->references('tafd_postid')->on('t_account_feeds')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('ran_notifywho', 'r_account_notification_ibfk_2')->references('rac_accountid')->on('r_account_credentials')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('ran_notifyby', 'r_account_notification_ibfk_3')->references('rac_accountid')->on('r_account_credentials')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('r_account_notification', function(Blueprint $table)
		{
			$table->dropForeign('r_account_notification_ibfk_1');
			$table->dropForeign('r_account_notification_ibfk_2');
			$table->dropForeign('r_account_notification_ibfk_3');
		});
	}

}
