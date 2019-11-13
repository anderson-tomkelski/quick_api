<?php

namespace App\Http\Controllers;

use App\Funcao;
use Illuminate\Http\Request;

class FuncaoController extends Controller
{
    public function showAllFuncao()
    {
        return response()->json(Funcao::all());
    }

    public function showOneFuncao($id)
    {
        return response()->json(Funcao::find($id));
    }

    public function searchFuncao(Request $request)
    {
        if($request->search)
            return response()->json(Funcao::where(
                'funcao', 'LIKE', "%$request->search%"
            )->get());
        
        return response()->json(Funcao::all());
    }
}