<?php

namespace App\Http\Controllers;

use App\PlanoAcao;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class PlanoAcaoController extends Controller
{

    public function showAllPlanoAcao() {
        return response()->json(PlanoAcao::all());
    }


    public function findActionPlan(Request $request) {
        return response()->json(PlanoAcao::where('id_status', '<', '3')->where('id_responsavel', '=', $request->id_responsavel)->get());
    }

    public function findOne($id) {
        return response()->json(
            DB::table('planodeacao as PLAN')
            ->select(DB::raw('PLAN.*, RE.titulo, USER.nome as criador'))
            ->join('reuniao as RE', 'RE.id', '=', 'PLAN.id_reuniao')
            ->join('usuario as USER', 'USER.id', '=', 'PLAN.id_criador')
            ->where('PLAN.id', '=', $id)
            ->first()
        );

     #   return response()->json(PlanoAcao::find($id)->innerJoin('reuniao as RE', 'RE.id', '=', '147'));
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $idReuniao = $data['id_reuniao'];
        
        $results = DB::select(
            "SELECT * FROM reuniao_realizada
                WHERE id_reuniao = " . $idReuniao . "
                ORDER BY id DESC LIMIT 1
            "
        );

        $data['id_reuniao_ref'] = $results[0]->id;
        $data['datacriado'] = date("Y-m-d H:i:s");


        $planoAcao = PlanoAcao::create($data);

        return response()->json($planoAcao, 201);
    }
}