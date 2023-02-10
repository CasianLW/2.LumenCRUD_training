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
$router-> get('/users','UtilisateurController@index');
$router-> get('/users/{id}','UtilisateurController@show');
$router-> post('/users/create','UtilisateurController@store');
$router-> put('/users/update/{id}','UtilisateurController@update');
$router-> delete('/users/delete/{id}','UtilisateurController@delete');


$router->get('/', function () use ($router) {
    return $router->app->version();
});
