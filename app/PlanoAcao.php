<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanoAcao extends Model
{
    protected $table = 'planodeacao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_reuniao', 'assunto', 'quando', 'id_responsavel',
        'id_criador', 'como', 'id_area', 'lido', 'id_status',
        'id_colab_fechou', 'checklist', 'datacriado', 'datafechado',
        'id_revenda', 'id_funcao', 'comentariofinal', 'id_reuniao_ref',
        'id_assunto_ref', 'aprovado', 'avulso', 'reaberto', 'msg_reabrir',
        'id_relato', 'criticidade'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}