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

    public function showPendetesCheckList(Request $request)
    {
        return response()->json(
            DB::table('formularios_fechamento as FF')
                ->select('FF.id as FFid', 'FO.formulario', 'AR.area', 'FF.data')
                ->join('formularios as FO', 'FF.id_formulario_ref', '=', 'FO.id')
                ->join('area as AR', 'FO.id_area', '=', 'AR.id')
                ->orderBy('FF.data', 'desc')
                ->where('FF.id_usuario', '=', $request->id_usuario)
                ->where('FF.status', 0)
                ->where('FO.status', 1)
                ->limit(5)
                ->get()
        );
    }

    public function showConcluidosCheckList(Request $request)
    {
        return response()->json(
            DB::table('formularios_fechamento as FF')
                ->select('FF.id as FFid', 'FO.formulario', 'AR.area', 'FF.data')
                ->join('formularios as FO', 'FF.id_formulario_ref', '=', 'FO.id')
                ->join('area as AR', 'FO.id_area', '=', 'AR.id')
                ->orderBy('FF.data', 'desc')
                ->where('FF.id_usuario', '=', $request->id_usuario)
                ->where('FF.status', 1)
                ->where('FO.status', 1)
                ->limit(5)
                ->get()
        );
    }
}