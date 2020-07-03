<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTChatRoomsMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t_chat_rooms_messages', function(Blueprint $table)
		{
			$table->foreign('tcrm_chatroomid', 't_chat_rooms_messages_ibfk_1')->references('tcr_chatroomid')->on('t_chat_rooms')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('tcrm_messenger', 't_chat_rooms_messages_ibfk_2')->references('rac_accountid')->on('r_account_credentials')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('tcrm_reciver', 't_chat_rooms_messages_ibfk_3')->references('rac_accountid')->on('r_account_credentials')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('t_chat_rooms_messages', function(Blueprint $table)
		{
			$table->dropForeign('t_chat_rooms_messages_ibfk_1');
			$table->dropForeign('t_chat_rooms_messages_ibfk_2');
			$table->dropForeign('t_chat_rooms_messages_ibfk_3');
		});
	}

}
