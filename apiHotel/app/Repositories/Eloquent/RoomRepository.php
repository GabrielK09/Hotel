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
        return DetailRooms::paginate(10);

    }

    public function create(array $data)
    {
        $customer = Customer::where('id', $data['customer_id'])->first();
        $room = DetailRooms::where('id', $data['room_id'])->first();
        
        $hotel = HotelDetail::where('id',$room->hotel_id)->first();
        
        Room::create([
            'customer_id' => $customer->id,
            'customer' => $customer->name,
            'room_id' => $room->id,
            'number_room' => $room->number_room
        ]);

        $hotel->update([
            'total_busy_rooms' => $room->sum('busy')
            
        ]);
        
        $hotel->save();

        $room->update([
           'busy' => 1

        ]);

        $room->save();

    }

    public function find(string $param)
    {

    }

    public function update(array $data, int $id)
    {
        
    }

    public function delete(int $id)
    {
        
    }

}