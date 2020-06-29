<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormularioFechamento extends Model
{
    protected $table = 'formularios_fechamento';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'status', 'id_formulario_ref', 'id_usuario', 'comentarios', 'anexo', 'formularios_fechamento', 'data', 'qtd_b', 'qtd_ok', 'qtd_nok', 'id_empresa', 'perct',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}