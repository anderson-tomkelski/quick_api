<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('America/Sao_Paulo');

class ArquivoController extends Controller
{
    public function showAll(Request $request)
    {
          return response()->json(
            DB::select(
                DB::raw(
                  "SELECT AR.*, ARE.area areas, CA.categoria
                          FROM arquivos AR
                          INNER JOIN area ARE ON AR.area = ARE.id
                          INNER JOIN categoria_arquivos CA ON AR.categoria = CA.id
                          WHERE  AR.id_revenda =".$id_revenda." AND AR.prazo >= NOW() AND AR.id  IN (SELECT id FROM permissao_arquivos WHERE id_funcao=".$id_funcao." AND id_arquivo = AR.id)")));
    }
}