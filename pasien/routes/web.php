<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('pasien', ['uses' => 'PasienController@showAll']);
    $router->get('pasien/{id}', ['uses' => 'PasienController@showOne']);
    $router->post('pasien', ['uses' => 'PasienController@create']);
    $router->delete('pasien/{id}', ['uses' => 'PasienController@delete']);
    $router->put('pasien/{id}', ['uses' => 'PasienController@update']);

    // jwt-auth
    $router->post('login', ['uses' => 'AuthController@login']);
    $router->post('logout', ['uses' => 'AuthController@logout']);
    $router->post('refresh', ['uses' => 'AuthController@refresh']);
    $router->post('user-profile', ['uses' => 'AuthController@me']);
});