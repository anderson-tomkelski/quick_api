<?php

namespace App\Http\Controllers;

use App\Reuniao;
use Illuminate\Http\Request;

class ReuniaoController extends Controller
{
    public function showAllReuniao()
    {
        return response()->json(Reuniao::all());
    }
}