<?php

namespace App\Repositories\Eloquent;

use App\Models\DetailRooms;
use App\Repositories\Interface\HotelDetailContract;
use App\Models\HotelDetail;

class HotelRepository implements HotelDetailContract
{
    public function all(int $active)
    {
        return HotelDetail::where('active', $active)->get();

    }

    public function create(array $data)
    {
        $hotel = HotelDetail::create($data);

        for ($a = 1; $a <= $hotel->number_of_rooms; $a++)
        {
            DetailRooms::create([
                'capacity' => 2,
                'price_for_night' => 25.00,
                'number_room' => $a,
                'hotel_id' => $hotel->id,
                
            ]);
        }
    
        return $hotel;
        
    }

    public function update(array $data, int $id)
    {
        return HotelDetail::where('id', $id)->update($data);

    }
    
    public function find(string $param)
    {
        return HotelDetail::where('id', $param)
                            ->orWhere('cnpj', $param)
                            ->orWhere('name', 'like', '%' . $param . '%' )
                            ->get();
        
    }

    public function delete(int $id) // fechar a empresa na prática kkkk
    {
        return HotelDetail::where('id', $id)->update([
            'active' => 0
            
        ]);
        
    }
}