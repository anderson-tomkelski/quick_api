<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class CheckListController extends Controller
{
    public function showAllCheckList(Request $request)
    {
        return response()->json(
            DB::table('permissao_checklist as PC')
                ->select('AR.id as ARid', 'AR.area', 'F.id as Fid', 'F.formulario')
                ->join('formularios as F', 'F.id', '=', 'PC.id_checklist')
                ->join('area as AR', 'F.id_area', '=', 'AR.id')
                ->orderBy('F.formulario', 'asc')
                ->where('PC.id_funcao', '=', $request->id_funcao)
                ->where('F.status', 1)
                ->get()
        );
    }
}