<?php
namespace App\Repositories\Eloquent;

use App\Models\{
    Customer,
    DetailRooms,
    HotelDetail,
    Room
};

use App\Repositories\Interface\RoomContract;

class RoomRepository implements RoomContract
{
    public function all(int $active)
    {
        return Room::all();

    }

    public function create(array $data)
    {
        $customer = Customer::where('id', $data['customer_id'])->first();
        $detailRoom = DetailRooms::where('id', $data['room_id'])->first();
        
        $hotel = HotelDetail::where('id', $detailRoom->hotel_id)->first();
        
        if($customer && $detailRoom && $hotel)
        {
            $room = Room::create([
                'customer_id' => $customer->id,
                'customer' => $customer->name,
                'room_id' => $detailRoom->id,
                'number_room' => $detailRoom->number_room,
                'start_period' => $data['start_period'],
                'end_period' => $data['end_period'],
                
            ]);

            $hotel->update([
                'total_busy_rooms' => $detailRoom->sum('busy')
                
            ]);
            
            $hotel->save();

            $detailRoom->update([
            'busy' => 1

            ]);

            $detailRoom->save();

            return $room;

        } else if (!$customer){
            return "Cliente não encontrado";

        } else if (!$detailRoom){
            return "Quarto não encontrado";

        } else if (!$hotel){
            return "Hotel não encontrado";
            
        }
    
        return false;
    }

    public function checkDate()
    {
        
    }


    public function find(string $param)
    {
        return Room::where('id', $param)->first();
    }

    public function findbyCustomer(int $param)
    {
        return Room::where('customer_id', $param)->first()?->fresh();
    }

    public function update(array $data, int $id)
    {
        
    }

    public function delete(int $id)
    {
        
    }

}