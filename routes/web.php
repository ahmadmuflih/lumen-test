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

$router->get('/users', 'UserController@index');
$router->get('/users/{user}', 'UserController@view');
$router->post('/login', 'SecureController@login');

$router->group(['middleware' => 'auth'], function($router) {
	$router->get('/secure/my-profile', 'SecureController@profile');
});