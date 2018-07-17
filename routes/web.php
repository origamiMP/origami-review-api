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


$router->group(['prefix' => 'v1'], function () use ($router) {

    $router->group(['middleware' => ['auth:api']], function() use($router) {
        $router->get('users/{id}', 'UserController@show');
        $router->get('/me', 'UserController@showCurrentUser');
    });

    $router->post('users', 'UserController@store');
    $router->get('orders/{id}', 'OrderController@show');

    $router->get('sellers', 'SellerController@index');
    $router->get('sellers/{id}', 'SellerController@show');

    $router->post('reviews', 'ReviewController@store');

});

