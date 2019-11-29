<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatoTipo extends Model
{
    protected $table = 'relato_tipo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo', 'icone', 'status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}