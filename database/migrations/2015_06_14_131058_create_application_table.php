<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Drop if application table exists
		Schema::dropIfExists('application');

		//Application table schema
		Schema::create('application', function (Blueprint $table) {

			$table->primary('request_id');
			$table->char('request_id', 6);
			$table->date('request_date');
			$table->decimal('loan_amount', 10, 2);
			$table->smallInteger('tenor');
			$table->float('interest_rate');
			$table->decimal('monthly_payment', 10, 2);
			$table->string('full_name');
			$table->string('email', 80);
			$table->string('phone', 15);
			$table->boolean('is_approved');
			$table->date('approve_date');
			$table->string('approve_by', 50);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Drop application table
		Schema::drop('application');
	}

}
