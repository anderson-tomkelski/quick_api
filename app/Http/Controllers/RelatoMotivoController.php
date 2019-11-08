<?php

namespace App\Http\Controllers;

use App\RelatoMotivo;
use Illuminate\Http\Request;

class RelatoMotivoController extends Controller
{

    public function showAllRelatoMotivo()
    {
        return response()->json(RelatoMotivo::all());
    }
}