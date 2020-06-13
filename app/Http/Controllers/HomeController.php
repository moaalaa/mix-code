<?php

namespace MixCode\Http\Controllers;

use Illuminate\Http\Request;

use MixCode\Order;

use MixCode\User ;

class HomeController extends Controller
{
    public function index()
    {
        tap(trans('site.home'), function ($seoTitle) {
            $this->seo()->generate(['title' => $seoTitle, 'description' => config('app.name') . ' ' . $seoTitle]);
        });
        
        return view('welcome');
    }
    
    
    public function show(Request $request)
    {
    
    //     $user = User::with('orders')->where('phone' , '=' ,$request->id)->first();
  
    //     if($user) {  

    //      $data = " <table class='table table-borderd search-result-table '> " ;
    //         foreach ($user->orders as  $value) {
    //             $data .=
    //              "<tr> <td>Name </td>  <td> ".$user->full_name." </td> <tr> 
    //              <tr> <td>Card Type </td>  <td>  ". $value->ar_name." </td> <tr> 
    //             <tr> <td>Discount </td>  <td> ". $value->discount."  %</td> <tr> 
    //            <tr> <td>Ex-data </td>  <td>  ". $value->date_to."  </td> <tr>";

    //         }     

    // $data .= ' </table>';

    // return  $data ; 

    //     }else{
          
    //       return  trans('main.no_data_for_this_number') ;
    //     }

    }


}
