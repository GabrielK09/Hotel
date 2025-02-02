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
            $create = $this->roomRepository->create($data);
            if($create == true)
            {
                return response()->json([
                    'success' => true,
                    'crate' => $create
    
                ], 201);
            }

            return response()->json([
                'success' => false,
                'crate' => $create

            ], 400);
            
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'th' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine()

            ]);
        }
    }

    public function find(string $param)
    {
        try {
            //return response()->json( $this->roomRepository->find($param));
            return $this->roomRepository->find($param);
            
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'th' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine()

            ]);
        }
    }
    
    public function checkIn(array $data)
    {
        try {
            $this->roomRepository->checkIn($data);
            return response()->json([
                'success' => true,
                //'check-in' => $checkIn,
                'message' => 'Check-in bem sucedido!'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'th' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine()

            ]);
        }
    }
}