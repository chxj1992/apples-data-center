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


$app->get('/', [
    'as' => 'cruise', 'uses' => 'CruiseController@index'
]);

$app->get('/cruise/priceByDepartureTime', [
    'as' => 'cruise-chart', 'uses' => 'CruiseController@priceByDepartureTime'
]);

$app->get('/cruise/priceByDuration', [
    'as' => 'cruise-chart', 'uses' => 'CruiseController@priceByDuration'
]);

