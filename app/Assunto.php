<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    protected $table = 'formulario_assuntos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_formulario', 'assunto', 'ordem'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}