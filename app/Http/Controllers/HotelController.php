<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    //
    function index(){
        $hotels = Hotel::all();
        return $hotels;
    }
    function store(Request $req){
        $newHotel = new Hotel();
        $newHotel->name = $req->name;
        $res = $newHotel->save();
        if($res){
            return response(['hotel' => $newHotel], 201);
        }else{
            return response(['msg' => 'problem creating hotel'], 500);
        }
    }
}
