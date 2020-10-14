<?php

namespace App\Http\Controllers;

use App\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('America/Sao_Paulo');

class ComentarioController extends Controller {

		public function find(Request $request) {
			return response()->json(Comentario::where('id_plano', '=', $request->id_plano)->get());
		}

		public function create(Request $request) {
			$data = $request->all();

			$data['data_cadastro'] = date("Y-m-d H:i:s");
			$planoAcao = DB::table('comentario')->insert(
				$data
		);

		return response()->json($planoAcao, 201);
	}
}