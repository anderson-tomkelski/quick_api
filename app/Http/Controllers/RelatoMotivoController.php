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

    public function counter(Request $request) {
        $transdate = date('m-d-Y', time());
     
        $month = date('m', strtotime($transdate));
        $year = date('Y', strtotime($transdate));

        $relato = DB::table('relato as RA')
            ->where('RA.id_usuario_cad', '=', $request->id)
            ->where('month(created_at)', '=', $month)
            ->where('RA.id_usuario_cad', '=', $year)
            ->get();

        return response()->json($relato);
    }
}