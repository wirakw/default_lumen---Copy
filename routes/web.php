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

$router->get('/email/verify', function ()  {
    return view('verification');
});
$router->post('/email/request-verification', ['as' => 'email.request.verification', 'uses' => 'Api\AuthController@emailRequestVerification']);

$router->post('/email/verify', ['as' => 'email.verify', 'uses' => 'Api\AuthController@emailVerify']);


$router->group(['prefix' => 'api/v1'], function () use ($router) {
    //auth
    $router->get('invoice', 'Api\KuitansiController@index');
    $router->post('invoice', 'Api\KuitansiController@login');
    $router->get('getToken', 'Api\KuitansiController@getToken');
    // $router->get('dump', 'Api\KuitansiController@dump');
    $router->get('abc', 'Api\KuitansiController@importTest');
    $router->post('import', 'Api\KuitansiController@import');
});
