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
	$ifps_newest   = Ifp::where('status', '=', '1')->orderBy('date_start', 'DESC')->limit(5)->get();
	$ifps_closed   = Ifp::where('status', '=', '4')->orderBy('date_end', 'DESC')->limit(5)->get();
	$recent_fcasts = Fcast::latest()->orderBy('created_at', 'DESC')->limit(10)->get();
	return View::make('dashboard')->with(array('ifps_newest' => $ifps_newest,
											   'ifps_closed' => $ifps_closed,
											   'recent_fcasts' => $recent_fcasts));
});

Route::get('questions', function()
{
    $ifps = Ifp::all();

    return View::make('ifps')->with('ifps', $ifps);
});

Route::get('questions/{id}', function($ifp_id)
{
	$ifp = Ifp::with('options')->find($ifp_id);
	$fcasts_ifp = Fcast::where('ifp_id','=',$ifp_id)->get();
    return View::make('ifp')->with(array('ifp' => $ifp, 'fcasts_ifp' => $fcasts_ifp));
});

Route::get('scores', function()
{
	return View::make('scores');
});

Route::post('fcast',function(){
	$user = User::find(1);
	$ifp  = Ifp::find(Input::get('ifp_id'));

	$fcast = new Fcast;
	$fcast->ifp_id = $ifp->id;
	$fcast->user_id = $user->id;
	$fcast->save();

	foreach($ifp->options as $opt) {
	 	$fcast_value                = new FcastValue;
	 	$fcast_value->ifp_option_id = $opt->id;
	 	$fcast_value->value         = Input::get('opt_'.$opt->option);
	 	$fcast_value->fcast_id      = $fcast->id;
	 	$fcast_value->save();
	 }

	return Redirect::to('/');
});

