<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::post('/', function (){
    return response()->json('Rota: /');
    
});

Route::prefix('v1')->group( function (){
    Route::prefix('hotel')->group( function (){
        Route::get('/all', [HotelController::class, 'allHotel']);
        Route::get('/find', [HotelController::class, 'findHotel']);
        Route::post('/create', [HotelController::class, 'create']);

    });

    Route::prefix('customer')->group( function (){
        Route::get('/all', [CustomerController::class, 'allCustomers']);
        Route::get('/find', [CustomerController::class, 'findCustomer']);
        Route::post('/create', [CustomerController::class, 'create']);

    });

    Route::prefix('')->group(function () {
        // ID do quarton
        Route::post('/stay/room', [RoomController::class, 'create']);
    });
});