<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $fillable = ['nome', 'quantidade', 'tipo_produto_id', 'produto_pai_id'];

}
