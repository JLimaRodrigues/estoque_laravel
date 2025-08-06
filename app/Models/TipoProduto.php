<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProduto extends Model
{
    protected $table      = 'tipo_produto';
    protected $primaryKey = 'id_tipo_produto';

    public function produtos()
    {
        return $this->hasMany(Produtos::class, 'tipo_produto_id', 'id_tipo_produto');
    }
}
