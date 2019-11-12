<?php

namespace App\Http\Controllers;

use App\Relato;
use Illuminate\Http\Request;

class RelatoController extends Controller
{

    public function showAllRelato()
    {
        return response()->json(Relato::all());
    }

    public function showOneRelato($id)
    {
        return response()->json(Relato::find($id));
    }

    public function create(Request $request)
    {
        $relato = Relato::create($request->all());

        return response()->json($relato, 201);
    }
}