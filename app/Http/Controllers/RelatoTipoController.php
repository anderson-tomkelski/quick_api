<?php

namespace App\Http\Controllers;

use App\RelatoTipo;
use Illuminate\Http\Request;

class RelatoTipoController extends Controller
{

    public function showAllRelatoTipo()
    {
        return response()->json(RelatoTipo::all());
    }

    public function showOneRelatoTipo($id)
    {
        return response()->json(RelatoTipo::find($id));
    }

    public function create(Request $request)
    {
        $relatoTipo = RelatoTipo::create($request->all());

        return response()->json($relatoTipo, 201);
    }

    public function update($id, Request $request)
    {
        $relatoTipo = RelatoTipo::findOrFail($id);
        $relatoTipo->update($request->all());

        return response()->json($relatoTipo, 200);
    }

    public function delete($id)
    {
        RelatoTipo::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}