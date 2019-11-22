<?php

namespace App\Http\Controllers;

use App\RelatoInfracao;
use Illuminate\Http\Request;

class RelatoInfracaoController extends Controller
{

    public function showAllRelatoInfracao()
    {
        return response()->json(RelatoInfracao::all());
    }

    public function showRelatoInfracaoByIds($idTipo, $idLocal, $idMotivo)
    {
        return response()->json(RelatoInfracao::where(
            'id_tipo', '=', $idTipo)->where(
            'id_local', '=', $idLocal)->where(
            'id_motivo', '=', $idMotivo)->get()
        );
    }
}