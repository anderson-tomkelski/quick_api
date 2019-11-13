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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('relato_tipo',  ['uses' => 'RelatoTipoController@showAllRelatoTipo']);
    $router->get('relato_tipo/{id}', ['uses' => 'RelatoTipoController@showOneRelatoTipo']);
    $router->post('relato_tipo', ['uses' => 'RelatoTipoController@create']);
    $router->delete('relato_tipo/{id}', ['uses' => 'RelatoTipoController@delete']);
    $router->put('relato_tipo/{id}', ['uses' => 'RelatoTipoController@update']);

    $router->get('relato_local',  ['uses' => 'RelatoLocalController@showAllRelatoLocal']);

    $router->get('relato_motivo', ['uses' => 'RelatoMotivoController@showAllRelatoMotivo']);

    $router->get('relato_infracao', ['uses' => 'RelatoInfracaoController@showAllRelatoInfracao']);

    $router->get('relato_infracao/tipo/{id_tipo}/local/{id_local}/motivo/{id_motivo}',
        ['uses' => 'RelatoInfracaoController@showRelatoTipoByIds']
    );

    $router->get('relato', ['uses' => 'RelatoController@showAllRelato']);
    $router->get('relato/{id}', ['uses' => 'RelatoController@showOneRelato']);
    $router->post('relato', ['uses' => 'RelatoController@create']);

    $router->get('funcao', ['uses' => 'FuncaoController@searchFuncao']);
    $router->get('funcao/{id}', ['uses' => 'FuncaoController@showOneFuncao']);
  });