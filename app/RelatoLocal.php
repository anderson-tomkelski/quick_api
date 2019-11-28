<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatoLocal extends Model
{
    protected $table = 'relato_local';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'local', 'icone', 'status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}