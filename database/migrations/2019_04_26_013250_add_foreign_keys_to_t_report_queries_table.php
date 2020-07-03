<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTReportQueriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t_report_queries', function(Blueprint $table)
		{
			$table->foreign('trq_sender', 't_report_queries_ibfk_1')->references('rac_accountid')->on('r_account_credentials')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('trq_reportedpost', 't_report_queries_ibfk_2')->references('tafd_postid')->on('t_account_feeds')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('trq_reporttype', 't_report_queries_ibfk_3')->references('rrt_reporttypeid')->on('r_report_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('t_report_queries', function(Blueprint $table)
		{
			$table->dropForeign('t_report_queries_ibfk_1');
			$table->dropForeign('t_report_queries_ibfk_2');
			$table->dropForeign('t_report_queries_ibfk_3');
		});
	}

}
