<?php
namespace App\Repositories\Eloquent;

use App\Models\{
    Customer,
    DetailRooms,
    HotelDetail,
    Room,
    CheckIn,
    Capacity
};

use App\Repositories\Interface\RoomContract;
use Illuminate\Support\Facades\Log;

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
                'busy' => 1,
                'capacity' => $detailRoom->capacity - 1

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

    public function checkIn(array $data, int $id)
    {
        $customer = Customer::where('id', $data['customer_id'])->first();
        $room = $this->findByRoomID($id);
        Log::info("Quarto encontrado: $room");
        if($room && $customer)
        {
            CheckIn::create([
                'customer_id' => $customer->id,
                'customer' => $customer->name,
                'room_id' => $room->id,
                'number_room' => $room->number_room,
                'end_period' => $data['end_period'],
                
            ]);

            $room->update([
                'active' => 0 // Desocupa o cliente do quarto

            ]);

            $capacity = Capacity::where('id', $data['room_id'])->first(); // Pega a quantia anterior
            $detailRoom = DetailRooms::where('id', $data['room_id'])->first();

            Log::info('Ativos no quarto: ' . $room->where('active', '1')->count('active'));

            if($room->where('active', '1')->count('active') <= 0)
            {
                Log::info('Vai voltar para a quantia do quarto');

                $detailRoom->update([
                    'capacity' => $capacity->capacity - 1
    
                ]);

                $detailRoom->save();

            }
            
            $room->save();

            return [
                'local' => 'Linha 118',
                'customer' => $customer,
                'room' => $room
            ];;
            
        }
        return [
            'local' => 'Linha 125',
            'customer' => $customer,
            'room' => $room
        ];
    }

    public function checkDate()
    {
        
    }


    public function find(string $param)
    {
        Log::info("Param: $param");
        return Room::where('id', $param)->first();

    }

    public function findByRoomID(int $id)
    {
        return Room::where('room_id', $id)->first();

    }

    public function update(array $data, int $id)
    {
        
    }

    public function delete(int $id)
    {
        
    }

}