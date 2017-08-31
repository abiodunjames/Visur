<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function ()  {
    return view('pages.home');
});
$app->get('/events', 'EventController@all'); //Get all events
$app->get('/event/stat','EventController@stats');
$app->get('distinct/event','DistinctEventController@all');
