<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Service\RoomService;

class RoomController extends Controller
{
    protected $roomService;
    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    public function allRooms()
    {
        return $this->roomService->allRooms(1);
    }

    public function create(RoomRequest $request)
    {
        $data = $request->validated();
        return $this->roomService->create($data);
    }

    public function find(RoomRequest $request)
    {
        return $this->roomService->findbyCustomer($request->input('id'));
    }
}   
