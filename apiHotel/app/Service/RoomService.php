<?php

namespace App\Service;

use App\Repositories\Eloquent\RoomRepository;

class RoomService
{
    protected $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository= $roomRepository;
        
    }


    public function allRooms(int $active)
    {
        try {
            return response()->json([
                'success' => true,
                'all' => $this->roomRepository->all($active)
                
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'th' => $th->getMessage(),
                'line' => $th->getLine()
            ]);
        }
    }

    public function create(array $data)
    {
        try {

            return response()->json([
                'success' => true,
                'create' => $this->roomRepository->create($data)

            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'th' => $th->getMessage(),
                'line' => $th->getLine()
            ]);
        }
    }
    
}