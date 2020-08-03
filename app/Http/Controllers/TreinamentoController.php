<?php

namespace App\Http\Controllers;

use App\Pergunta;
use App\Assunto;
use App\TreinamentoParticipantes;
use App\FormularioSalvo;
use App\FormularioComentario;
use App\FormularioFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreinamentoController extends Controller {

	public function confirmPresence(Request $request) {
		$model = DB::table('treinamento_participantes')
		-> where('id', $request->idTreinamento)
		-> where('id_usuario', $request->id_usuario)
		-> update([ 'status' => '1', 'aprovado' => '1', 'especial' => '2', 'participou' => '1']);
		return response()->json($model);	
	}

	public function saveAnswers(Request $request) {
		$model = DB::table('questionario_resposta')
			->insert([ 
				'id_treinamento_agenda' => $request->idTreinamentoAgenda,
				'id_prova' => $request->prova,
				'id_colaborador' => $request->colaborador,
				'id_questao' => $request->pergunta, 
				'resposta' => $request->resposta,
				'correto' => $request->correto, 
				'data' => date("Y-m-d H:i:s"),
				'tipo' => 1
				]
			);
		return response()->json($model);	
	}

	public function saveResult(Request $request) {
		$nota = $request->nota;

		$isApproved = $nota >= $request->n_minima ? '1' : '0';
		
		$model = DB::table('treinamento_participantes')
			-> where('id_treinamento_agenda', $request->id_treinamento_agenda)
			-> where('id_usuario', $request->id_usuario)
			-> update([ 'nota' => intval($request->nota), 'status' => '1', 'aprovado' => $isApproved, 'especial' => '2', 'participou' => '1']);

		return response()->json(['isApproved' => intval($isApproved)]);	
		
	}

	public function evaluationCourse(Request $request) {
		$model = DB::table('questionario_avaliacao_resposta')
			->insert([ 
				'id_treinamento_agenda' => $request->id_treinamento_agenda,
				'id_pergunta' => $request->prova,
				'id_usuario' => $request->colaborador,
				'respostaI' => $request->resposta,
				'data' => date("Y-m-d H:i:s"),
				'id_treinamento' => $request->id_treinamento
				]
			);
		return response()->json($model);	
	}

	public function findQuestionnaires(Request $request) {
		$model = DB::table('questionario as QUE')
			->select('QUE.id as id_questao', 'PR.id', 'PR.nome as prova', 'QUE.pergunta', 'QUE.opcao1', 'QUE.opcao2', 'QUE.opcao3', 'QUE.opcao4', 'QUE.resposta')
			->join('provas as PR', 'QUE.id_prova', '=', 'PR.id')
			->where('id_prova', '=', $request->id_prova)
			->get();
		return response()->json($model);	
	}

	public function findAllPendingTraining(Request $request) {
		$model = DB::table('treinamento_participantes as TP')
			->select(
				'TP.id',
				'TP.id_treinamento_agenda',
				'TP.tipo',
				'TP.id_usuario',
				'LT.treinamento',
				'LT.id_prova',
				'LT.id as id_treinamento_lent',
				'PV.nome as prova', 
				'LT.n_perguntas', 
				'LT.n_minima')
			->join('agendamento_treinamentos as ATT', 'TP.id_treinamento_agenda', '=', 'ATT.id')
			->join('lent as LT', 'ATT.id_treinamento', '=', 'LT.id')
			->leftJoin('provas as PV', 'LT.id_prova', '=', 'PV.id')
			->where(function ($query) use ($request) {
        $query->where('TP.status', '=', '0')
				->where('ATT.status', '=', '3')
				->where('TP.id_usuario', '=', $request->cod_usuario);
			})
			->orWhere(function ($query) use ($request) {
        $query->where('TP.especial', '=', '1')
				->where('TP.id_usuario', '=', $request->cod_usuario);
			})
			->orWhere(function ($query) use ($request) {
				$query->where('TP.status', '=', '0')
				->where('LT.aplica_prova', '=', '2')
				->where('TP.id_usuario', '=', $request->cod_usuario);
			})
			->limit(6)
			->get();
		return response()->json($model);	
	}

	public function findEvaluationCourse(Request $request) {
		$model = DB::table('questionario_avaliacao')
			->select('*')
			->orderBy('ordem', 'desc')
			->get();
		return response()->json($model);	
	}
}