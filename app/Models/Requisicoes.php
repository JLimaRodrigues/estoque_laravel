<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisicoes extends Model
{
    protected $primaryKey = 'id_requisicao';

    protected $fillable = ['usuario_id', 'entregador_id', 'data', 'status'];

    public function requisicao()
    {
        return $this->belongsTo(Requisicoes::class, 'requisicao_id');
    }

    public function produto()
    {
        return $this->belongsTo(Produtos::class, 'produto_id');
    }

    public function itens()
    {
        return $this->hasMany(ItensRequisicoes::class, 'requisicao_id');
    }
}
