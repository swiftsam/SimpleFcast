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
	$ifp = Ifp::find($ifp_id);
    return View::make('ifp')->with('ifp', $ifp);
});

Route::get('scores', function()
{
	return View::make('scores');
});

