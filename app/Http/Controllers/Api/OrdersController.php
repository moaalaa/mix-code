<?php

namespace MixCode\Http\Controllers\Api;

use Illuminate\Http\Request;
use MixCode\Http\Controllers\Controller;
use Illuminate\Http\Response;
use MixCode\Http\Requests\ApiOrderRequest;
use MoaAlaa\ApiResponder\ApiResponder;
use MixCode\Order ;
use MixCode\Card ;

class OrdersController extends Controller
{

    use ApiResponder;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiOrderRequest $request)
    {
        
       try {
            $card  = Card::where('id','=',$request->card_id)->first();
            
        
            $order =  new Order;
            $order->company_id  = $card->company_id ;
            $order->card_id     = $request->card_id ;
            $order->user_id     = $request->user_id ;
            $order->card_limit  = $card->frequency  ;
           
            $order->save();
      
            return $this->api()->response([], trans('main.order_submitted'), Response::HTTP_CREATED);
            
        } catch (\Exception $ex) {
            return $this->api()->safeError($ex);
        }
    }


    
 
 
}