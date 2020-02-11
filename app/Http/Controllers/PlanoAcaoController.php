<?php

namespace App\Http\Controllers;

use App\PlanoAcao;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class PlanoAcaoController extends Controller
{

    public function showAllPlanoAcao()
    {
        return response()->json(PlanoAcao::all());
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