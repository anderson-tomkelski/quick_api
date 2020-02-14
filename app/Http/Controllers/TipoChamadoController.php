<?php

namespace App\Http\Controllers;

use App\TipoChamado;
use Illuminate\Http\Request;

class TipoChamadoController extends Controller
{

    public function showAllTipoChamado()
    {
        return response()->json(TipoChamado::all());
    }
}