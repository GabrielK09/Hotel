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

    public function create(array $data)
    {
        try {
            $this->roomRepository->create($data);
            return response()->json([
                'success' => true

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