<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\ArquivosRelatos;

date_default_timezone_set('America/Sao_Paulo');

class ArquivosRelatosController extends Controller
{
  public function create(Request $request)
  {
      $relato = ArquivosRelatos::create($request->all());

      return response()->json($relato, 201);
  }
}