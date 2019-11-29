<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

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
}