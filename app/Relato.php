<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relato extends Model
{
    protected $table = 'relato';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tipo', 'id_local', 'id_motivo', 'id_infracao',
        'id_revenda', 'id_usuario_cad', 'id_usuario_resp',
        'id_programa_denunciado', 'id_programa_relator',
        'id_funcao', 'dt_ocorrido', 'envolvido', 'detalhes',
        'dt_cadastro', 'status', 'atribuido', 'oquefazer', 'obs'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}