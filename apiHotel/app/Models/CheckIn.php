<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    protected $table = 'check_ins';
    protected $fillable = [
        'customer_id',
        'customer',
        'room_id',
        'number_room',
        'end_period',
    ];
}
