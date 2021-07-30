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
    $router->get('invoice', 'Api\InvoiceController@index');
    $router->post('invoice', 'Api\InvoiceController@login');
    $router->post('getToken', 'Api\InvoiceController@getToken');
});
