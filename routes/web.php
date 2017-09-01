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

$app->get('/dashboard', 'DashboardController@index');
$app->get('/', 'DashboardController@index');
$app->get('/events', 'EventController@get'); //Get all events
$app->get('/event/stat','EventController@stats');
$app->get('/event/severity/distribution','EventController@event_severity_percentage');


/*
|--------------------------------------------------------------------------
| Graph Routes
|--------------------------------------------------------------------------
*/
$app->get('graph/barchart', 'DashboardController@barchart');
$app->get('graph/piechart', 'DashboardController@piechart');

