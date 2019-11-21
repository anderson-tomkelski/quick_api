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

/** @var \Laravel\Lumen\Routing\Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'middleware' => ['tenant', 'autenticador']], function () use ($router) {
    $router->group(['prefix' => 'relato_tipo'], function () use ($router) {
        $router->get('', 'RelatoTipoController@showAllRelatoTipo');
        $router->get('{id}', 'RelatoTipoController@showOneRelatoTipo');
        $router->post('',  'RelatoTipoController@create');
        $router->delete('{id}', 'RelatoTipoController@delete');
        $router->put('{id}', 'RelatoTipoController@update');
    });

    $router->group(['prefix' => 'relato_local'], function () use ($router) {
        $router->get('', 'RelatoLocalController@showAllRelatoLocal');
    });

    $router->group(['prefix' => 'relato_motivo'], function () use ($router) {
        $router->get('', 'RelatoMotivoController@showAllRelatoMotivo');
    });

    $router->group(['prefix' => 'relato_infracao'], function () use ($router) {
        $router->get('', 'RelatoInfracaoController@showAllRelatoInfracao');
        $router->get('tipo/{id_tipo}/local/{id_local}/motivo/{id_motivo}',
        'RelatoInfracaoController@showRelatoTipoByIds'
        );
    });

    $router->group(['prefix' => 'relato'], function () use ($router) {
        $router->get('', 'RelatoController@showAllRelato');
        $router->get('{id}', 'RelatoController@showOneRelato');
        $router->post('', 'RelatoController@create');
    });

    $router->group(['prefix' => 'funcao'], function () use ($router) {
        $router->get('', 'FuncaoController@showAllFuncao');
        $router->get('{id}', 'FuncaoController@showOneFuncao');
    });
});

$router->post('/api/login', 'TokenController@gerarToken');
$router->post('/api/login/company', 'TokenController@gerarTokenEmpresa');