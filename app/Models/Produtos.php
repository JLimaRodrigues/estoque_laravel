<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $primaryKey = 'id_produto';

    protected $fillable = ['nome_produto', 'quantidade', 'custo', 'valor', 'tipo_produto_id'];

    protected $casts = [
        'custo' => 'float',
        'valor' => 'float',
    ];

    public function tipoProduto()
    {
        return $this->belongsTo(TipoProduto::class, 'tipo_produto_id', 'id_tipo_produto');
    }

    public function composicao()
    {
        return $this->hasMany(ProdutoComposicao::class, 'produto_composto_id', 'id_produto');
    }

    public function estaEmCompostos()
    {
        return $this->belongsToMany(
            Produtos::class,
            'produto_composicao',
            'produto_simples_id',
            'produto_composto_id'
        )->withPivot('quantidade')->withTimestamps();
    }

    public function calcularCustoComposto()
    {
        $custo = 0;
        foreach ($this->composicao as $componente) {
            $produtoSimples = Produtos::find($componente->produto_simples_id);
            if ($produtoSimples) {
                $custo += $produtoSimples->custo * $componente->quantidade;
            }
        }
        return $custo;
    }
}
