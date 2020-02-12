<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function showCategoriaByTipoChamado($idTipo)
    {
        return response()->json(
            Categoria::where(
                'id_tipo', $idTipo
            )->get()
        );
        
    }
}