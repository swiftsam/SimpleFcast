<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIfpOptsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ifp_options', function($table)
	    {
	        $table->integer('id')->unique();
	        $table->integer('ifp_id');
	        $table->string('option');
	        $table->string('text');
	        $table->timestamps();
	        $table->foreign('ifp_id')->references('id')->on('ifps');
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ifp_options');
	}

}
