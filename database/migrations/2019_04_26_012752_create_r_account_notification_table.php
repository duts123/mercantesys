<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRAccountNotificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('r_account_notification', function(Blueprint $table)
		{
			$table->integer('ran_notificationid', true);
			$table->integer('ran_postid')->index('ran_postid');
			$table->integer('ran_notifywho')->index('ran_notifywho');
			$table->integer('ran_notifyby')->index('ran_notifyby');
			$table->string('ran_notificationbody', 10000);
			$table->dateTime('ran_activitydate')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('r_account_notification');
	}

}
