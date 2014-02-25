<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFcastValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fcast_values', function($table)
	    {
	        $table->increments('id');
	        $table->unsignedInteger('fcast_id');
	        $table->unsignedInteger('ifp_option_id');
	       	$table->float('value');
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fcast_values');
	}

}
