<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatoMotivo extends Model
{
    protected $table = 'relato_motivo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'motivo', 'icone', 'status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}