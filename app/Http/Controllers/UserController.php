<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //post method api
    public  function register(Request $request){

        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'phone_no'=>'required',
            'password'=>'required|confirmed'
        ]);
        $data=new User();
        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone_no=$request->phone_no;
        $data->password=bcrypt($request->password);
        $data->save();

        return response()->json([
            'status'=>1,
            'message'=>'successfully registration',
        ],200);

    }

    //post method api
    public function login(Request $request){

        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(!$token=auth()->attempt(['email'=>$request->email, 'password'=>$request->password])){

            return response()->json([
                'status'=>0,
                'message'=>'login failed'
            ],404);

        }else{
            return response()->json([
                'status'=>1,
                'message'=>'successfully login',
                'access_token'=>$token
            ],200);
        }

    }

    //get method api
    public function profile(){

        $userdat=auth()->user();
         return response()->json([
            'status'=>1,
            'message'=>'user profile data',
            'data'=>$userdat
         ],200);

    }

    //get method api
    public function logout(){

        auth()->logout();
         return response()->json([
            'status'=>1,
            'message'=>'successfully logout'
         ],200);

    }

}
