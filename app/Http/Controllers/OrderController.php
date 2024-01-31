<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show()
    {

       $order= Order::all()->where('implemented','=','0');
     //  dd($order);
      return response([
          'order'=> $order
       ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order=Order::create([
                'user_id'=>$request->user()->id,
                'type'=>$request->type,
                'from'=>$request->from,
                'to'=>$request->to,
                'from_time'=>$request->from_time,
                'to_time'=>$request->to_time,
                'implemented'=>$request->implemented

        ]

        );
    }



    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
