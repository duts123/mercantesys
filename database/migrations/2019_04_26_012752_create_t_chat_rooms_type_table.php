<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTChatRoomsTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_chat_rooms_type', function(Blueprint $table)
		{
			$table->integer('tcrt_roomtypeid', true);
			$table->string('tcrt_roomtypevalue', 100);
			$table->dateTime('tcrt_dateadded')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t_chat_rooms_type');
	}

}
