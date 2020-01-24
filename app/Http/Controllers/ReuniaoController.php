<?php

namespace App\Http\Controllers;

use App\Reuniao;
use App\Participante;
use Illuminate\Http\Request;

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
}