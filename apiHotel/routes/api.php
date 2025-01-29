<?php

use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group( function (){
    Route::get('/hotel/all', [HotelController::class, 'getAll'])->name('hotel.all');
    Route::get('/hotel/find', [HotelController::class, 'find']);
    Route::post('/hotel/create', [HotelController::class, 'create']);

});