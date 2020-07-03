<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTAccountFeedsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_account_feeds', function(Blueprint $table)
		{
			$table->integer('tafd_postid', true);
			$table->string('tafd_postcontent', 5000)->nullable();
			$table->string('tafd_postimage_source', 250)->nullable()->default('empty');
			$table->dateTime('tafd_postadded');
			$table->string('tafd_imotion', 150)->default('imotion_13_happy');
			$table->integer('tafd_igetyoucount')->default(0);
			$table->integer('tafd_giftcount')->default(0);
			$table->integer('tafd_commentcount')->default(0);
			$table->integer('tafd_postcreator')->index('tafd_postcreator');
			$table->integer('tafd_postaudience');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t_account_feeds');
	}

}
