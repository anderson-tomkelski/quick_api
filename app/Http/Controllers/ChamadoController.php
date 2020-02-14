<?php

namespace App\Http\Controllers;

use App\Chamado;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ChamadoController extends Controller
{

    public function create(Request $request)
    {
        $data = $request->all();
        $data['dt_criado'] = date("Y-m-d H:i:s");

        $chamado = Chamado::create($data);

        return response()->json($chamado, 201);
    }
}