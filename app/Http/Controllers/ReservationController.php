<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    //
    function show($roomId){
        try {
            //code...
            $reservations = Reservation::where('room_id', $roomId)->get();
            return $reservations ;
        } catch (\Throwable $th) {
            //throw $th;
            return response(['msg'=> 'poblem getting the reservations for this room'], 500);
        }
    }
    function showDate(Request $req){
     try {
         
        $startDate = $req->from;
        $endDate = $req->to;
        
        $rooms = DB::table('rooms')
        ->join('hotels', 'rooms.hotel_id', '=', 'hotels.id')
        ->select('rooms.id', 'rooms.hotel_id', 'rooms.room_number', 'rooms.price_per_night', 'rooms.capacity', 'hotels.name as hotel_name')
        ->whereNotIn('rooms.id', 
            DB::table('reservations')
            ->select('room_id')
            ->whereRaw("$startDate between reservations.start_date AND reservations.end_date")
            ->orWhereRaw("$endDate between reservations.start_date AND reservations.end_date")
            ->orWhereRaw("$startDate = $endDate AND $startDate = reservations.start_date AND $startDate = reservations.end_date")
        )->orderBy('hotel_id')
        ->get();
        return  $rooms;
     } catch (\Throwable $th) {
         return response(500, ['msg' => $th]);
     }
    }
    function store(Request $req){
        $newReservation = new Reservation();
        $newReservation->start_date = $req->startDate;
        $newReservation->end_date = $req->endDate;
        $newReservation->user_id = $req->user_id;
        $newReservation->room_id = $req->room_id;

        $result = $newReservation->save();
        if($result){
            return response([], 201);
        }else{
            return response(['msg'=> 'error creating the reservation'], 500);
        }
    }
    function getUserReservations(Request $req){
        try {
            $userId = $req->user()->id;
            $userReservations = DB::table('reservations')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->join('hotels', 'rooms.hotel_id', '=', 'hotels.id')
            ->select('reservations.*', 'hotels.name', 'rooms.room_number')->get();

            return $userReservations;
        } catch (\Throwable $th) {
            return response(['msg' => $th], 500);
        }
    }
}
