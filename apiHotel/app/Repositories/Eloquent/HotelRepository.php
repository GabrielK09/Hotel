<?php

namespace App\Repositories\Eloquent;

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
        return HotelDetail::create($data);
        
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