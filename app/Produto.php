<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'quantidade', 'tipo_produto_id', 'produto_pai_id'];

    
}
