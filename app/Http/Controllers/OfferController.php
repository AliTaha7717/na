<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Order;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    //
    public function index(Request $request)
    {

        // $order= Order::all()->where('implemented','=','0');
        $offer=Offer::query()->with(['driver','order'],)->where('order_id','=',$request->order_id)->get();
        //$offer=Offer::find(1)->driver;
        // $order= Order::find(1);

        //dd($order);
        return response([
            'offer'=>$offer
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $offer=Offer::create([
                'user_id'=>$request->user()->id,
                'order_id'=>$request->order_id,
                'price'=>$request->price,


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
        $offer=Offer::find($request->id);
        $offer->price=$request->price;
        $offer->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
       Offer::find($request->id)->delete();
    }


}
