<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspecificacaoRelato extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tipo', 'especificacao'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}