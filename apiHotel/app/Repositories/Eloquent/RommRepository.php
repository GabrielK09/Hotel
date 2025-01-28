<?php
namespace App\Repositories\Eloquent;

use App\Models\Customer;
use App\Models\HotelRoom;
use App\Repositories\Interface\RommContract;

class RommRepository implements RommContract
{

    public function all(int $active)
    {
        return HotelRoom::where('active', $active)->get();
        
    }

    public function create(array $data)
    {
        $customer = Customer::where('id', $data['id'])->first();

        return HotelRoom::create([
            'customer_id' => $customer->id,
            'custome' => $customer->name
        ]);        
    }

    public function find(string $param)
    {
        return HotelRoom::where('id', $param)
                        ->orWhere('number_room', $param)
                        ->first();
        
    }

    public function update(array $data, int $id)
    {
        return HotelRoom::where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        return HotelRoom::where('id', $id)->update([
            'active' => 0
            
        ]);
    }

}