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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'middleware' => 'autenticado'], function () use ($router) {
    $router->group(['prefix' => 'actor'], function () use ($router) {
        $router->post('', 'ActorController@create');
        $router->get('', 'ActorController@index');
        //$router->get('{where}', 'ActorController@searchOne');
        $router->put('{id}', 'ActorController@update');
        $router->delete('{id}', 'ActorController@destroy');

        //$router->get('{serieId}/episodios', 'EpisodiosController@buscaPorSerie');
    });
    /*
    $router->group(['prefix' => 'episodios'], function () use ($router) {
        $router->post('', 'EpisodiosController@store');
        $router->get('', 'EpisodiosController@index');
        $router->get('{id}', 'EpisodiosController@show');
        $router->put('{id}', 'EpisodiosController@update');
        $router->delete('{id}', 'EpisodiosController@destroy');
    });
    */
});
//$router->get('/api/actor', 'ActorController@index');
$router->post('/api/login', 'TokenController@gerarToken');