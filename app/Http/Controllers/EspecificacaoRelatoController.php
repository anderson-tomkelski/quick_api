<?php

namespace App\Http\Controllers;

use App\EspecificacaoRelato;
use Illuminate\Http\Request;

class EspecificacaoRelatoController extends Controller
{

    public function showAllEspecificacaoRelato()
    {
        return response()->json(EspecificacaoRelato::all());
    }
}