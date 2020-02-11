<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{

    public function showAllUsuario()
    {
        return response()->json(Usuario::all());
    }

    public function showOneUsuario($id)
    {
        return response()->json(Usuario::find($id));
    }

    public function showUsuarioByLogin(Request $request)
    {
        return response()->json(Usuario::where('usuario', $request->usuario)->first());
    }

    public function showUsuariosByMeetingId($idReuniao, $idUnidade)
    {
        return response()->json(
            DB::select(
                DB::raw("
                    select id, nome, id_revenda, id_funcao 
                    from usuario 
                    where id_funcao in 
                    (select id_funcao from participantes where id_reuniao = " . $idReuniao . ") 
                    and status = 1 
                    and id_revenda in (" . $idUnidade . ")
                    order by nome
                ")
            )
        );
    }
}