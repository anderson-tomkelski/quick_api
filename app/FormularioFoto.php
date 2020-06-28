<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormularioFoto extends Model
{
    protected $table = 'formulario_fotos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'id_formulario_ref', 'id_pergunta', 'foto'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
