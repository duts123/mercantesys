<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRAccountCredentialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('r_account_credentials', function(Blueprint $table)
		{
			$table->integer('rac_accountid', true);
			$table->string('rac_username', 25);
			$table->string('rac_profilepicture', 250)->default('userid_1.jpg');
			$table->string('rac_userbackgroundcover', 250)->default('defaultcover.jpg');
			$table->binary('rac_password', 50);
			$table->string('rac_email', 50);
			$table->string('rac_pnumb', 20);
			$table->string('rac_shortbio', 250)->nullable();
			$table->dateTime('rac_credentialsadded');
			$table->string('rac_mobileverification', 8)->nullable();
			$table->dateTime('rac_credentialsmodified');
			$table->string('rac_useraddress', 1500)->default('Address 1, block 1 lot 1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('r_account_credentials');
	}

}
