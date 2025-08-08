<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $primaryKey = 'entradas';

    protected $fillable = ['produto_id', 'quantidade', 'custo_unitario', 'valor_unitario'];

    public function produto()
    {
        return $this->belongsTo(Produtos::class, 'produto_id', 'id_produto');
    }
}
