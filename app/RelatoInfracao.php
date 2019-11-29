<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatoInfracao extends Model
{
    protected $table = 'relato_infracao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tipo', 'id_local', 'id_motivo', 'infracao', 'icone', 'ordem'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}