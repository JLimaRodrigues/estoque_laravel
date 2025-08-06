<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $primaryKey = 'id_produto';

    protected $fillable = ['nome_produto', 'quantidade', 'custo', 'valor', 'tipo_produto_id'];

    public function tipoProduto()
    {
        return $this->belongsTo(TipoProduto::class, 'tipo_produto_id', 'id_tipo_produto');
    }

}
