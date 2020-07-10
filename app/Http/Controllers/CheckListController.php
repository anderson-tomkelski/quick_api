<?php

namespace App\Http\Controllers;

use App\Pergunta;
use App\Assunto;
use App\FormularioFechamento;
use App\FormularioSalvo;

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
                ->select('FF.id as FFid', 'FO.formulario', 'AR.area', 'FF.data', 'FF.id_formulario_ref')
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
                ->select('FF.id as FFid', 'FO.formulario', 'AR.area', 'FF.data',  'FF.id_formulario_ref')
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
    
    public function getCommentsByFormId($id)
    {
        return response()->json(
            DB::table('formulario_comentario as FC')
            ->select('*')
            ->where('FC.id_formulario_ref', '=', $id)
            ->get()
        );
    }

    public function getPhotosByFormId($id)
    {
        return response()->json(
            DB::table('formulario_fotos as FT')
            ->select('*')
            ->where('FT.id_formulario_ref', '=', $id)
            ->get()
        );
    }
    
    public function getFormById($id)
    {
        return response()->json(
            DB::table('formularios_fechamento as FF')
            ->select('*')
            ->join('formularios_salvos as FS', 'FS.id_formulario_salvo', '=', 'FF.id')
            ->where('FF.id', '=', $id)
            ->get()
        );
    }

    public function deletePendenteCheckList($id)
    {
        DB::table('arquivos_formulario')->where('id_formulario_ref', $id)->delete();
        DB::table('formulario_comentario')->where('id_formulario_ref', $id)->delete();
        DB::table('formularios_salvos')->where('id_formulario_salvo', $id)->delete();
        DB::table('formularios_fechamento')->where('id', $id)->delete();
        return response()->json('Deleted Successfully', 200);
    }

    public function showPerguntasByFormId($formId)
    {
        return response()->json(Pergunta::where(
            'id_formulario', '=', $formId)->get()
        );
    }

    public function showAssuntosByFormId($formId)
    {
        return response()->json(Assunto::where(
            'id_formulario', '=', $formId)->orderBy('ordem')->get()
        );
    }

    public function update(Request $request)
    {
        $closureForm = FormularioFechamento::find($request->id); 
        $closureForm->update([
            'id_formulario_ref' => $request->id_formulario_ref,
            'id_usuario' => $request->id_usuario,
            'comentarios' => isset($request->comentarios) ? $request->comentarios : "",
            'anexo' => isset($request->anexo) ? $request->anexo : "",
            'data' => date("Y-m-d H:i:s"),
            'qtd_b' => isset($request->qtd_b) ? $request->qtd_b : 0,
            'qtd_ok' => isset($request->qtd_ok) ? $request->qtd_ok : 0,
            'qtd_nok' => isset($request->qtd_nok) ? $request->qtd_nok : 0,
            'id_empresa' => $request->id_empresa,
            'perct' => isset($request->perct) ? $request->perct : 0,
            'status' =>  $request->status
        ]);

        $questions = $request->perguntas;
        
        foreach ($questions as $question){
            $model = [
                'id_formulario_salvo' => $request->id,
                'tratado' => isset($question['tratado']) ? $question['tratado'] : null,
                'plano' => isset($question['plano']) ? $question['plano'] : null,
                'critico' => isset($question['critico']) ? $question['critico'] : null,
                'id_formulario' => isset($question['id_formulario']) ? $question['id_formulario'] : null,
                'tipo' => isset($question['tipo']) ? $question['tipo'] : null,
                'id_pergunta' => isset($question['id_pergunta']) ? $question['id_pergunta'] : null,
                'respostaI' => isset($question['respostaI']) ? $question['respostaI'] : null,
                'respostaT' => isset($question['respostaT']) ? $question['respostaT'] : null,
                'data' => date("Y-m-d H:i:s"),
                'id_colaborador' => isset($question['id_colaborador']) ? $question['id_colaborador'] : null,
                'id_revenda' => isset($question['id_revenda']) ? $question['id_revenda'] : null,
                'id_funcao' => isset($question['id_funcao']) ? $question['id_funcao'] : nul
            ];

            if (isset($question['id'])) {
                $savedChecklist = FormularioSalvo::find($question['id']); 
                $savedChecklist->update($model);
            } else {
                $savedChecklist = FormularioSalvo::insert($model);
            } 
        }

        foreach ($questions as $question) {
            if(!isset($question['foto']) || $question['foto'] == null) continue;
            
            $model = [
                'id_formulario_ref' =>  $request->id,
                'id_pergunta' => isset($question['id_pergunta']) ? $question['id_pergunta'] : null,
                'foto' => isset($question['foto']) ? $question['foto'] : null,
            ];

            if($question['id']) {
                $savedChecklist = FormularioFoto::find($question['id']); 
                $savedChecklist->update($model);
            } else {
                $savedChecklist = FormularioFoto::insert($model);
            }
        }

        foreach($questions as $question) {
            if(!isset($question['comentario']) || $question['comentario'] == null) continue;
            
            $model = [
                'id_formulario_ref' =>  $request->id,
                'id_pergunta' => isset($question['id_pergunta']) ? $question['id_pergunta'] : null,
                'comentario' => isset($question['comentario']) ? $question['comentario'] : null,
            ];

            if($question['id']) {
                $savedChecklist = FormularioComentario::find($question['id']); 
                $savedChecklist->update($model);
            } else {
                $savedChecklist = FormularioComentario::insert($model);
            }        
        }

        return response()->json($closureForm);
    }

    public function saveChecklist(Request $request) {
        $closureChecklistId = DB::table('formularios_fechamento')->insertGetId(
            [
                'id_formulario_ref' => $request->id_formulario_ref,
                'id_usuario' => $request->id_usuario,
                'comentarios' => isset($request->comentarios) ? $request->comentarios : "",
                'anexo' => isset($request->anexo) ? $request->anexo : "",
                'data' => date("Y-m-d H:i:s"),
                'qtd_b' => isset($request->qtd_b) ? $request->qtd_b : 0,
                'qtd_ok' => isset($request->qtd_ok) ? $request->qtd_ok : 0,
                'qtd_nok' => isset($request->qtd_nok) ? $request->qtd_nok : 0,
                'id_empresa' => $request->id_empresa,
                'perct' => isset($request->perct) ? $request->perct : 0,
                'status' =>  isset($request->status) ? $request->status : 1 
            ]
        );

        $questions = $request->perguntas;
        foreach($questions as $question){
            $savedChecklist = DB::table('formularios_salvos')->insert(
                [
                    'id_formulario_salvo' => $closureChecklistId,
                    'tratado' => isset($question['tratado']) ? $question['tratado'] : null,
                    'plano' => isset($question['plano']) ? $question['plano'] : null,
                    'critico' => isset($question['critico']) ? $question['critico'] : null,
                    'id_formulario' => isset($question['id_formulario']) ? $question['id_formulario'] : null,
                    'tipo' => isset($question['tipo']) ? $question['tipo'] : null,
                    'id_pergunta' => isset($question['id_pergunta']) ? $question['id_pergunta'] : null,
                    'respostaI' => isset($question['respostaI']) ? $question['respostaI'] : null,
                    'respostaT' => isset($question['respostaT']) ? $question['respostaT'] : null,
                    'data' => date("Y-m-d H:i:s"),
                    'id_colaborador' => isset($question['id_colaborador']) ? $question['id_colaborador'] : null,
                    'id_revenda' => isset($question['id_revenda']) ? $question['id_revenda'] : null,
                    'id_funcao' => isset($question['id_funcao']) ? $question['id_funcao'] : null
                ]
            );
        }

        foreach($questions as $question){
            if(!isset($question['foto']) || $question['foto'] == null) continue;
            $savedChecklist = DB::table('formulario_fotos')->insert(
                [
                    'id_formulario_ref' => $closureChecklistId,
                    'id_pergunta' => isset($question['id_pergunta']) ? $question['id_pergunta'] : null,
                    'foto' => isset($question['foto']) ? $question['foto'] : null,
                ]
            );
        }

        foreach($questions as $question){
            if(!isset($question['comentario']) || $question['comentario'] == null) continue;
            $savedChecklist = DB::table('formulario_comentario')->insert(
                [
                    'id_formulario_ref' => $closureChecklistId,
                    'id_pergunta' => isset($question['id_pergunta']) ? $question['id_pergunta'] : null,
                    'comentario' => isset($question['comentario']) ? $question['comentario'] : null,
                ]
            );
        }

        return response()->json($savedChecklist, 201);

    }
}