<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRReportTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('r_report_types', function(Blueprint $table)
		{
			$table->integer('rrt_reporttypeid', true);
			$table->string('rrt_reportvalue', 50);
			$table->string('rrt_reporticon', 50);
			$table->integer('rrt_criticallevel');
			$table->timestamp('rrt_reporttypestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('r_report_types');
	}

}
