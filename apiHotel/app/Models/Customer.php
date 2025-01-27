<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    
    protected $fillable = [
        'name',
        'cnpj',
        'cpf',
        'address',
        'number',
        'account',
        'password',
        'active',
    ];
}
