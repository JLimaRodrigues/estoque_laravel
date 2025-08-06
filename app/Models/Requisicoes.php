<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Requisicoes extends Model
{
    protected $primaryKey = 'id_requisicao';

    protected $fillable = ['usuario_id', 'entregador_id', 'data', 'status'];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function entregador()
    {
        return $this->belongsTo(User::class, 'entregador_id');
    }

    public function itens()
    {
        return $this->hasMany(ItensRequisicoes::class, 'requisicao_id');
    }
}
