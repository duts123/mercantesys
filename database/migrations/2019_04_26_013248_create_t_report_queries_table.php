<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTReportQueriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_report_queries', function(Blueprint $table)
		{
			$table->integer('trq_queryid', true);
			$table->integer('trq_sender')->index('trq_sender');
			$table->integer('trq_reportedpost')->index('trq_reportedpost');
			$table->integer('trq_reporttype')->index('trq_reporttype');
			$table->timestamp('trq_reportstamp')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t_report_queries');
	}

}
