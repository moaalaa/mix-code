<?php

namespace MixCode\Http\Controllers;

use Illuminate\Http\Request;
use MixCode\Http\Requests\OrdersRequest;
use MixCode\User ;
use MixCode\Order ;

class OrdersController extends Controller
{ 
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Request $request ) 
    {
        $user = User::with(['orders','useOrders'])->where('phone' , '=' ,$request->phone)->first();
   
   if(  $user) {  
   
         return view("userTableInfo", compact('user'));

        }else{
          
          return  trans('main.no_data_for_this_number') ;
        }
    }

     

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    $order = Order::where('id' , '=',$id)->where('status','=','active')->first();
       
       
    if ($order->card_limit > 0 ||  $order->card_limit =='unlimited') {

      if($order->card_limit != 'unlimited'){
        $new_card_limit = $order->card_limit - 1;
      }else{
        $new_card_limit = $order->card_limit ;
      } 

      $status          = $order->status ;  
      

        if($new_card_limit == 0  && $order->card_limit != 'unlimited'){ 
            $status = 'disable' ;
         }
       
       $date = today()->toDateString();
 
      $update =  $order->update(['card_limit'=> $new_card_limit  , 'status'=> $status  , 'date_of_used'=> $date]);

        
     if($update ) {  notify('success', trans('main.discount_has_done_successfully')); }   
       
  
     } else {
        notify('error', trans('main.no_data_for_this_number'));
    }
     
        return redirect()->route('search');
    }

    
}
