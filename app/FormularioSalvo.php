<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormularioSalvo extends Model
{
    protected $table = 'formularios_salvos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'id_formulario_salvo', 'tratado', 'plano', 'critico', 'id_formulario', 'tipo', 'id_pergunta', 'respostaI', 'formularios_salvos', 'respostaT', 'data', 'id_colaborador', 'id_revenda', 'id_funcao'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}

