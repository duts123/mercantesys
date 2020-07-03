<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTChatRoomsMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_chat_rooms_messages', function(Blueprint $table)
		{
			$table->integer('tcrm_messageid', true);
			$table->integer('tcrm_chatroomid')->index('tcrm_chatroomid');
			$table->string('tcrm_messagecontent', 10000);
			$table->dateTime('tcrm_messagetimestamp')->nullable();
			$table->integer('tcrm_messenger')->index('tcrm_messenger');
			$table->integer('tcrm_reciver')->index('tcrm_reciver');
			$table->integer('tcrm_isarchived')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t_chat_rooms_messages');
	}

}
