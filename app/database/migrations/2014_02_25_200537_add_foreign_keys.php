<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	   	Schema::table('ifp_options', function($table){
	    	$table->foreign('ifp_id')->references('id')->on('ifps');
	    });

	    Schema::table('fcasts', function($table){
			$table->foreign('ifp_id')->references('id')->on('ifps');
	        $table->foreign('user_id')->references('id')->on('users');
	    });

	    Schema::table('fcast_values', function($table){
			$table->foreign('fcast_id')->references('id')->on('fcasts');
	       	$table->foreign('ifp_option_id')->references('id')->on('ifp_options');
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	   	Schema::table('ifp_options', function($table){
	    	$table->dropForeign('ifp_options_ifp_id_foreign');
	    });

	    Schema::table('fcasts', function($table){
	    	$table->dropForeign('fcasts_ifp_id_foreign');
	    	$table->dropForeign('fcasts_user_id_foreign');
	    });

	    Schema::table('fcast_values', function($table){
	    	$table->dropForeign('fcast_values_fcast_id_foreign');
	    	$table->dropForeign('fcast_values_ifp_option_id_foreign');
	    });
	}

}
