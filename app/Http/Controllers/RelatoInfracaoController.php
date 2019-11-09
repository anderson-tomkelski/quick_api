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
}