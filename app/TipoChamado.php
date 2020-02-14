<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoChamado extends Model
{
    protected $table = 'tipo_chamados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo', 'cor2', 'cor'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}