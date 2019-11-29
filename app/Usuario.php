<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    protected $table = 'usuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nome', 'usuario', 'atendente', 'tipo_atendente', 'email',
        'tp_visao_relato', 'id_area', 'id_funcao', 'id_revenda', 'id_superior',
        'id_nivel_acesso', 'status', 'cel', 'fone_fixo', 'imagem', 'ver_registro',
        'expiracao'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'senha',
    ];
}
