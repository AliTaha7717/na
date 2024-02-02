<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

      // $order= Order::all()->where('implemented','=','0');
       $order=Order::query()->with('owner')->where('implemented','=','0')->get();
       // $order= Order::find(1);

      //dd($order);
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
        $order=  Order::find($request->id);
        $order->user_id=$request->user()->id;
        $order->type=$request->type;
        $order->from=$request->from;
        $order->to=$request->to;
        $order->from_time=$request->from_time;
        $order->to_time=$request->to_time;
        $order->implemented=$request->implemented;
          $order->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        Order::find($request->id)->delete();
    }
}
