<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reuniao extends Model
{
    protected $table = 'reuniao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reuniao', 'titulo', 'id_unidade', 'id_area_resp',
        'sts', 'id_dono_funcao', 'id_frequencia', 'duracao',
        'dt_proxima', 'descricao', 'criado', 'modificado', 
        'id_criador', 'tor', 'status', 'qtd_participantes',
        'qtd_assuntos'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}