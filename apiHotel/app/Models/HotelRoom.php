<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class HotelRoom extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'hotel_rooms';

    protected $fillable = [
        'customer_id',
        'customer',
        'capacity',
        'level',
        'price_for_night',
        'number_room',
        'busy',

    ];
}
