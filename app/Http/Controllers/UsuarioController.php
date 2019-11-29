<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    public function showAllUsuario()
    {
        return response()->json(user::all());
    }

    public function showOneUsuario($id)
    {
        return response()->json(User::find($id));
    }

    public function showUsuarioByLogin(Request $request)
    {
        return response()->json(User::where('usuario', $request->usuario)->first());
    }
}