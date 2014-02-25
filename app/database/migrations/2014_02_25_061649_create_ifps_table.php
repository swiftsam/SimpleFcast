<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIfpsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ifps', function($table)
	    {
	        $table->increments('id');
	        $table->tinyInteger('type');
	        $table->tinyInteger('status');
	        $table->string('short_title');
	        $table->string('text');
	        $table->text('desc');
	        $table->datetime('date_start');
	        $table->datetime('date_to_end');
	        $table->datetime('date_end')->nullable();
	        $table->string('outcome')->nullable();
	        $table->timestamps();
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ifps');
	}

}
