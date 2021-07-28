<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function register(Request $req){
        if(!$req->name || !$req->email || !$req->password){
            return response(['msg' => 'all fields are required'], 400);
        }
        $newUser = new User();
        $newUser->name = $req->name;
        $newUser->email = $req->email;
        $newUser->password = Hash::make($req->password);

        $result = $newUser->save();
        if($result){
            $token = $newUser->createToken('my-app-token');
            return response(
                ['user' => $newUser,
                'token' =>  $token->plainTextToken]
            , 201);
        }else{
            return response(['msg' => 'error'], 500);
        }
    }
    function login(Request $req){
        if( !$req->email || !$req->password){
            return response(['msg' => 'all fields are required'], 400);
        } 
        $user = User::where('email', $req->email)->first();
        if($user){
            $match = Hash::check($req->password, $user->password);
            if($match){
                $token = $user->createToken('my-app-token');
                return response(['user'=> $user, 'token' => $token->plainTextToken], 200);
            }else{
                return response(['msg' => 'no user with these credentials'], 401);
            }
        }else{
            return response(['msg' => 'no user with these credentials'], 401);
        }
    }

}
