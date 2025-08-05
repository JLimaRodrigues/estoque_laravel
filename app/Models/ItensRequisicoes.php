<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItensRequisicoes extends Model
{
    protected $fillable = ['requisicao_id', 'produto_id', 'quantidade', 'valor_unitario'];

}
