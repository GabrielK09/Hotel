<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelDetailRequest;
use App\Service\HotelService;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    protected $hotelService;
    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function all()
    {
        return $this->hotelService->all(1);
    }

    public function create(HotelDetailRequest $request)
    {
        return $request->all();
        $data = $request->validated();
        return $this->hotelService->create($data);

    }

    public function update(HotelDetailRequest $request, int $id)
    {
        $data = $request->validated();
        return $this->hotelService->update($data, $id);

    }

    public function find(Request $request)
    {
        return $this->hotelService->findHotel($request->input('param'));
        
    }

    public function delete(int $id)
    {
        return $this->hotelService->delete($id);

    }
}
