<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    protected $table = 'chamados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_criador', 'id_empresa', 'id_funcao', 'comentariofinal',
        'id_area', 'id_tipo', 'id_servico', 'id_categoria',
        'dt_criado', 'prazonovo', 'id_atendente', 'assunto',
        'descricao', 'situacao', 'encerrado', 'data_encerrado',
        'prazo', 'id_subcategoria', 'retornado', 'prazos'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}