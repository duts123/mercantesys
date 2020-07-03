<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTChatRoomsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_chat_rooms', function(Blueprint $table)
		{
			$table->integer('tcr_chatroomid', true);
			$table->string('tcr_chatroomname', 250)->nullable();
			$table->dateTime('tcr_dateadded')->nullable();
			$table->integer('tcr_creator')->index('tcr_creator');
			$table->integer('tcr_pairtowho')->index('tcr_pairtowho');
			$table->integer('tcr_roomtype')->index('tcr_roomtype');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t_chat_rooms');
	}

}
