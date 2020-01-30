<?php

namespace App\Http\Controllers;

use App\PlanoAcao;
use Illuminate\Http\Request;

class PlanoAcaoController extends Controller
{

    public function showAllPlanoAcao()
    {
        return response()->json(PlanoAcao::all());
    }

    public function create(Request $request)
    {
        $planoAcao = PlanoAcao::create($request->all());

        return response()->json($planoAcao, 201);
    }
}