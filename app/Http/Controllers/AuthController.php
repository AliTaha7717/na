<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        //dd($request);


        $user=User::where('phone',$request->phone)->first();
        if (!$user||!Hash::check($request->password,$user->password))
        {
            //dd($request);
            return response(['messqe'=>'not user'],440);

        }
        $token=$user->createToken('ali_token')->accessToken;
        return response([
            'token'=>$token
        ]);
    }
    public function logout(Request $request)
    {

        $request->user()->token()->revoke();
    }
    public function signup(Request $request)
    {


        $user= User::create(
            [
                'name'=>$request->name,
                'phone'=>$request->phone,
                'password'=>Hash::make($request->password),
            ]
        );

        if($request->taybe_acount=='user')
        {
            $token=$user->createToken('ali_token')->accessToken;
        return response([
            'token'=>$token
        ]);}
        //dd($request->tyabe_acount);
        if($request->taybe_acount=='driver')
        {

            $driver=Driver::create(
                [
                'user_id'=>$user->id,
                 'taybe'=>$request->taybe,
                    'verified'=>$request->verified
                ]
            );
            $token=$user->createToken('ali_token')->accessToken;
            return response([
                'token'=>$token
            ]);
        }

    }
}
