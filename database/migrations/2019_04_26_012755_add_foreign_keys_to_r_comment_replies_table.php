<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRCommentRepliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('r_comment_replies', function(Blueprint $table)
		{
			$table->foreign('rcr_replyparent', 'r_comment_replies_ibfk_1')->references('rfc_commentid')->on('r_feeds_comments')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('rcr_replyactor', 'r_comment_replies_ibfk_2')->references('rac_accountid')->on('r_account_credentials')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('r_comment_replies', function(Blueprint $table)
		{
			$table->dropForeign('r_comment_replies_ibfk_1');
			$table->dropForeign('r_comment_replies_ibfk_2');
		});
	}

}
