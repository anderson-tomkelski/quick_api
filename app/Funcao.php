<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'funcao', 'id_area', 'status', 'nivel_relato'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}