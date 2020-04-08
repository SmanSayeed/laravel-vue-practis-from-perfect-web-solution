<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use Auth;

class UserController extends Controller
{
    public function login(Request $request){
        $username = $request->email;
        $password = $request->password;

        $user = User::where('email',$username)->where('password',$password)->first();

        if($user){
            
        $token = Hash::make($request->password);
        $user->api_token = $token;
        $user->save();

        return response()->json(['token'=>$token],200);

        }
        return response()->json(['status'=>'Email or Password is wrong'],403);
     

    }
}

// public function login(Request $request){
//     // $username = $request->email;
//     // $password =bcrypt($request->password);

//     $credentials = $request->only('email','password');
//     // $user = User::where('email',$username)->where('password',$password)->first();

//     if(Auth::attemt($credentials)){
        
//     $token = Str::random(80);
//     Auth::user()->api_token = $token;
//     Auth::user()->save();

//     return response()->json(['token'=>$token],200);

//     }
//     return response()->json(['status'=>'Email or Password is wrong'],403);  
    


// }
