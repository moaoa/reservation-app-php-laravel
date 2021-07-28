<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    //
    function show($hotelId){
        $rooms = DB::table('rooms')->join('hotels', 'hotels.id', '=', 'rooms.hotel_id')->select('rooms.id', 'rooms.hotel_id', 'rooms.room_number', 'rooms.price_per_night', 'rooms.capacity', 'hotels.name as hotel_name')
        ->where('hotels.id', $hotelId)
        ->get();
        return $rooms;
    }
    function store(Request $req){
        $newRoom = new Room();
        
        $newRoom->room_number  = $req->room_number;
        $newRoom->hotel_id = $req->hotel_id;
        $newRoom->price_per_night = $req->price_per_night;
        $newRoom->capacity = $req->capacity;

        $result = $newRoom->save();
        if($result){
            return response('', 201);
        }else{
            return response(['msg' => 'problem creating room'], 500);
        }
    }
    
}
