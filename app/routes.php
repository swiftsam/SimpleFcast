<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('dashboard');
});

Route::get('questions', function()
{
    $ifps = Ifp::all();

    return View::make('ifps')->with('ifps', $ifps);
});

Route::get('questions/{id}', function($ifp_id)
{
	$ifp = Ifp::with('options')->find($ifp_id);
    return View::make('ifp')->with('ifp', $ifp);
});

Route::get('scores', function()
{
	return View::make('scores');
});

Route::post('fcast',function(){
	$user = User::find(1);
	$ifp  = Ifp::find(Input::get('ifp_id'));

	# There must be a far more elegant solution to this
	#$values = Input::all();
	#for($values as $val){
#		if(substr($val->name, 1, 4) == "opt_"){
		#	$fcast_value = new FcastValue();
	#		$fcast_value->value = $val->name
#		}
#	}

	$fcast = new Fcast;
	$fcast->ifp_id = $ifp->id;
	$fcast->user_id = $user->id;
	$fcast->save();

	return Redirect::to('/');
});

