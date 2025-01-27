<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelDetail extends Model
{
    protected $table = 'hotel_details';

    protected $fillable = [
        'name',
        'cnpj',
        'email',
        'address',
        'number',
        'number_of_rooms',
        'number_of_employees',
        
    ];
}
