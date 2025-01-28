<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemNfce extends Model
{
    protected $table = 'ItemNfce';

    protected $fillable = [
        'cod_produto',
        'produto',
        'quantidade',
        'preco_bruto',
        'preco_liquido',
        'preco_desconto',
        'NCM',
        'CEST',
        'CSOSN',
        'CFOP',
        'active',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
