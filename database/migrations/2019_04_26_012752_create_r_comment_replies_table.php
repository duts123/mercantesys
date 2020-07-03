<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRCommentRepliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('r_comment_replies', function(Blueprint $table)
		{
			$table->integer('rcr_replyid', true);
			$table->integer('rcr_replyparent')->index('rcr_replyparent');
			$table->integer('rcr_replyactor')->index('rcr_replyactor');
			$table->string('rcr_replybody', 250);
			$table->dateTime('rcr_replydate');
			$table->integer('rcr_isdeleted')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('r_comment_replies');
	}

}
