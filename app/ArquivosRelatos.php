<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArquivosRelatos extends Model
{
    protected $table = 'arquivos_relatos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'id_relato', 'nome', 'data',
        'tipo'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}