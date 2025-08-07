<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoComposicao extends Model
{
    protected $table = 'produto_composicao';

    protected $fillable = [
        'produto_composto_id',
        'produto_simples_id',
        'quantidade',
    ];

    public function produtoComposto()
    {
        return $this->belongsTo(Produtos::class, 'produto_composto_id', 'id_produto');
    }

    public function produtoSimples()
    {
        return $this->belongsTo(Produtos::class, 'produto_simples_id', 'id_produto');
    }
}
