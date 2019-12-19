<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    protected $table = 'formulario_perguntas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'caracteres', 'id_formulario', 'id_assunto',
        'pergunta', 'tipo', 'ordem', 'critico', 'status',
        'foto', 'comentario', 'opcao', 'inteiro'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}