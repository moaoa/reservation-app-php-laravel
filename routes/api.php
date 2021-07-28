<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// hotels
Route::get('/hotels', [HotelController::class, 'index']);
Route::middleware('auth:sanctum')->post('hotels', [HotelController::class, 'store']);

// rooms 

// get the rooms of specific hotel
Route::get('/rooms/{hotelId}', [RoomController::class, 'show']);

Route::post('rooms', [RoomController::class, 'store']);

// reservations 
Route::get('/reservations/room/{roomId}', [ReservationController::class, 'show']);

Route::get('/reservations/date', [ReservationController::class, 'showDate']); // query params
Route::middleware('auth:sanctum')->get('/my-reservations', [ReservationController::class, 'getUserReservations']);
Route::middleware('auth:sanctum')->post('/reservations', [ReservationController::class, 'store']);

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);