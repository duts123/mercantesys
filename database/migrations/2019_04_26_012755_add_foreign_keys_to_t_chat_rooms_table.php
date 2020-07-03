<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTChatRoomsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t_chat_rooms', function(Blueprint $table)
		{
			$table->foreign('tcr_creator', 't_chat_rooms_ibfk_1')->references('rac_accountid')->on('r_account_credentials')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('tcr_pairtowho', 't_chat_rooms_ibfk_2')->references('rac_accountid')->on('r_account_credentials')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('tcr_roomtype', 't_chat_rooms_ibfk_3')->references('tcrt_roomtypeid')->on('t_chat_rooms_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('t_chat_rooms', function(Blueprint $table)
		{
			$table->dropForeign('t_chat_rooms_ibfk_1');
			$table->dropForeign('t_chat_rooms_ibfk_2');
			$table->dropForeign('t_chat_rooms_ibfk_3');
		});
	}

}
