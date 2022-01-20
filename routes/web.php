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
    
    $router->group(['prefix' => 'training'], function () use ($router) {
        $router->post('evaluationCourse', 'TreinamentoController@evaluationCourse');
        $router->post('saveAnswers', 'TreinamentoController@saveAnswers');
        $router->post('confirmPresence', 'TreinamentoController@confirmPresence');
        $router->post('saveResult', 'TreinamentoController@saveResult');
        $router->get('findEvaluationCourse', 'TreinamentoController@findEvaluationCourse');
        $router->get('findAllPendingTraining', 'TreinamentoController@findAllPendingTraining');
        $router->get('findQuestionnaires', 'TreinamentoController@findQuestionnaires');
    });

    $router->group(['prefix' => 'relato_local'], function () use ($router) {
        $router->get('', 'RelatoLocalController@showAllRelatoLocal');
    });

    $router->group(['prefix' => 'relato_motivo'], function () use ($router) {
        $router->get('', 'RelatoMotivoController@showAllRelatoMotivo');
    });

    $router->group(['prefix' => 'relato_infracao'], function () use ($router) {
        $router->get('', 'RelatoInfracaoController@showAllRelatoInfracao');
        $router->get(
            'tipo/{id_tipo}/local/{id_local}/motivo/{id_motivo}',
            'RelatoInfracaoController@showRelatoInfracaoByIds'
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

    $router->group(['prefix' => 'usuario'], function () use ($router) {
        $router->post('', 'UsuarioController@showUsuarioByLogin');
        $router->get(
            '/reuniao/{id_reuniao}/unidade/{id_unidade}', 
            'UsuarioController@showUsuariosByMeetingId'
        );
        $router->get('{id}', 'UsuarioController@showOneUsuario');
    });

    $router->group(['prefix' => 'formulario'], function () use ($router) {
        $router->post('', 'CheckListController@showAllCheckList');
        $router->post('pendentes', 'CheckListController@showPendetesCheckList');
        $router->delete('pendentes/{id}', 'CheckListController@deletePendenteCheckList');
        $router->post('concluidos', 'CheckListController@showConcluidosCheckList');
        
        $router->get('getPhotosByFormId/{id}', 'CheckListController@getPhotosByFormId');
        $router->get('getFormById/{id}', 'CheckListController@getFormById');
        $router->get('getCommentsByFormId/{id}', 'CheckListController@getCommentsByFormId');
        
        $router->get('assuntos/{formId}', 'CheckListController@showAssuntosByFormId');
        $router->get('perguntas/{formId}', 'CheckListController@showPerguntasByFormId');
        
        $router->put('update', 'CheckListController@update');
        $router->post('salvar', 'CheckListController@saveChecklist');
        $router->post('salvar', 'CheckListController@saveChecklist');
        $router->post('salvarFoto', 'CheckListController@savePhoto');
    }); 
    
    $router->group(['prefix' => 'reuniao'], function () use ($router) {
        $router->get('', 'ReuniaoController@showAllReuniao');
        $router->get(
            'participantes/{idReuniao}', 
            'ReuniaoController@showParticipantesByReuniaoId'
        );
        $router->get(
            'funcao/{idFuncao}/unidade/{idUniddade}', 
            'ReuniaoController@showReuniaoByFunction'
        );
    });

    $router->group(['prefix' => 'plano_acao'], function () use ($router) {
        $router->get('', 'PlanoAcaoController@showAllPlanoAcao');
        $router->get('findActionPlan', 'PlanoAcaoController@findActionPlan');
        $router->post('', 'PlanoAcaoController@create');
        $router->get('{id}', 'PlanoAcaoController@findOne');
    });

    $router->group(['prefix' => 'comentario'], function () use ($router) {
        $router->get('', 'ComentarioController@find');
        $router->post('', 'ComentarioController@create');
    });
    
    $router->group(['prefix' => 'arquivos_relatos'], function () use ($router) {
        $router->post('', 'ArquivosRelatosController@create');
    });
    
    $router->group(['prefix' => 'tipo_chamado'], function () use ($router) {
        $router->get('', 'TipoChamadoController@showAllTipoChamado');
    });

    $router->group(['prefix' => 'categoria'], function () use ($router) {
        $router->get('tipo/{id_tipo}', 'CategoriaController@showCategoriaByTipoChamado');
    });

    $router->group(['prefix' => 'chamado'], function () use ($router) {
        $router->post('', 'ChamadoController@create');
    });

    $router->group(['prefix' => 'arquivo'], function () use ($router) {
        $router->post('', 'ArquivoController@showAll');
    });
});

$router->post('/api/login', 'TokenController@gerarToken');
$router->post('/api/login/company', 'TokenController@gerarTokenEmpresa');