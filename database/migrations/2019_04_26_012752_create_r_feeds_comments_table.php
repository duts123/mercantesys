<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRFeedsCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('r_feeds_comments', function(Blueprint $table)
		{
			$table->integer('rfc_commentid', true);
			$table->integer('rfc_feedparent')->index('rfc_feedparent');
			$table->integer('rfc_commentcreator')->index('rfc_commentcreator');
			$table->text('rfc_commentbody', 16777215);
			$table->integer('rfc_reported')->default(0);
			$table->dateTime('rfc_dateadded');
			$table->integer('rfc_deleted')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('r_feeds_comments');
	}

}
