<?php

namespace App\Http\Controllers;

use App\Reuniao;
use App\Participante;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ReuniaoController extends Controller
{
    public function showAllReuniao()
    {
        return response()->json(Reuniao::all());
    }

    public function showParticipantesByReuniaoId($idReuniao)
    {
        return response()->json(Participante::where(
            'id_reuniao', '=', $idReuniao)->get()
        );
    }

    public function showReuniaoByFunction($idFuncao, $idUnidade)
    {
        return response()->json(
            DB::select(
                DB::raw("
                    SELECT re.id, re.reuniao, re.dt_proxima, re.id_dono_funcao,
                    (SELECT data_realizacao FROM reuniao_realizada
                    WHERE id_reuniao = re.id ORDER BY id DESC LIMIT 1) utl_realizada,
                    (SELECT empresa FROM empresa WHERE id = id_unidade) emp
                    FROM reuniao re WHERE id IN
                    (SELECT id_reuniao FROM participantes pa WHERE id_funcao = " . $idFuncao . ")
                    AND id_unidade = " . $idUnidade . "
                    AND status = 1
                    ORDER BY 1 
                ")
            )
        );
    }
    
}