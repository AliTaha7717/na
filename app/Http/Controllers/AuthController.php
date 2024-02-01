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

        $user=User::where('phone',$request->phone)->first();
        //dd($user);
        if ($user!=null)
        {
            if(Hash::check($request->password,$user->password))
            $token=$user->createToken('ali_token')->accessToken;
            return response([
                'token'=>$token
            ]);
        }
        else {
            $user = User::create(
                [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'type_acount'=>$request->type_acount,
                    'password' => Hash::make($request->password),
                ]
            );

            if ($request->type_acount == 'user') {
                $token = $user->createToken('ali_token')->accessToken;
                return response([
                    'token' => $token
                ]);
            }
            //dd($request->tyabe_acount);
            if ($request->type_acount == 'driver') {

                $driver = Driver::create(
                    [
                        'user_id' => $user->id,
                        'type' => $request->type,
                        'verified' => $request->verified,

                    ]
                );
                $token = $user->createToken('ali_token')->accessToken;
                return response([
                    'token' => $token
                ]);
            }
        }
    }
    public function profile(Request $request)
    {
       // dd($request);

        $d=Driver::query()->where('user_id','=',$request->user()->id)->get();
        //dd($d);
        return response([
            'user'=>$request->user(),
           'driver'=>$d
        ]) ;}


}
