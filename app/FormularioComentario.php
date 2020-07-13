<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormularioComentario extends Model
{
    protected $table = 'formulario_comentario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'id_formulario_ref', 'id_pergunta', 'comentario',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
