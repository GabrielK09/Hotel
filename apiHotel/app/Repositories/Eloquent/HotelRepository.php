<?php

namespace App\Repositories\Eloquent;

use App\Models\{
    DetailRooms,
    HotelDetail,
    Capacity
};

use App\Repositories\Interface\HotelDetailContract;

class HotelRepository implements HotelDetailContract
{
    public function all(int $active)
    {
        //return HotelDetail::where('active', $active)->first();
        $hotel = HotelDetail::where('active', $active)->first();
        return $hotel;
        //return $this->checkAddress($hotel);
    
    }

    public function checkAddress(object $hotel)
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => "https://viacep.com.br/ws/$hotel->cep/json/",
            CURLOPT_RETURNTRANSFER => true, 
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => false

        ]);

        $data = curl_exec($ch);

        if(curl_errno($ch))
        {
            return "Erro CURL: \n" . curl_error($ch) . " rota: https://viacep.com.br/ws/$hotel->cep/json/";

        }

        $response = json_decode($data, true);
        curl_close($ch);

        if($hotel->address != $response['logradouro'])
        {
            $hotel->update([
                'address' => $response['logradouro']
            ]);

            $hotel->save();

            return $hotel;

        }

        return $hotel;
    }

    public function create(array $data)
    {
        $hotel = HotelDetail::create($data);
        
        for ($number = 1; $number <= $hotel->number_of_rooms; $number++)
        {
            $detailRoom = DetailRooms::create([
                'capacity' => rand(2, 5),
                'price_for_night' => rand(20, 45),
                'number_room' => $number,
                'hotel_id' => $hotel->id,
                
            ]);

            Capacity::create([
                'room_id' => $detailRoom->id,
                'capacity' => $detailRoom->capacity
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