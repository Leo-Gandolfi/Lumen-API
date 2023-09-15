<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\ClienteController;

$router->get('/clientes', 'ClienteController@index');
$router->get('/teste', 'ClienteController@testConnection');
$router->get('/clientes/{id}', 'ClienteController@show');
$router->post('/register', 'ClienteController@store');

$router->post('/login', 'ClienteController@login');


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router){
    $router->get('/posts', 'PostController@index');
    $router->get('/posts/{id}', 'PostController@searchPost');
    $router->post('/posts', 'PostController@store');
    $router->put('/update/{id}', 'PostController@update');
    $router->delete('/delete/{id}', 'PostController@delete');
});