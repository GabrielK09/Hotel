<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $fillable = [
        'customer_id',
        'customer',
        'room_id',
        'number_room'

    ];

    protected $hidden = [
        'customer_id',
        'room_id',
    ];
}
