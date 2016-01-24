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
    'uses' => 'CruiseController@priceByDepartureTime'
]);

$app->get('/cruise/countByDepartureTime', [
    'uses' => 'CruiseController@countByDepartureTime'
]);

$app->get('/cruise/priceByDuration', [
    'uses' => 'CruiseController@priceByDuration'
]);


$app->post('/cruise/crawl', [
    'uses' => 'CruiseController@crawl'
]);

$app->post('/cruise/dump', [
    'uses' => 'CruiseController@dump'
]);

