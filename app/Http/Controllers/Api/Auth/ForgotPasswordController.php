<?php

namespace MixCode\Http\Controllers\Api\Auth;

use MixCode\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MixCode\Notifications\ForgetPasswordToken;
use MoaAlaa\ApiResponder\ApiResponder;
 use MixCode\User;

class ForgotPasswordController extends Controller
{
    use ApiResponder;
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;

    public function  sendResetLinkEmail (Request $request){

    //     try {
    //         $user = User::where("phone" , $request->phone)->first();
 
    //         if (! $user) {
    //             return $this->api()->error('Phone is wrong', Response::HTTP_NOT_FOUND);
    //         }

            


    // //  $user->notify( new ForgetPasswordToken($user));
         
    //        return $this->api()->response($user , Response::HTTP_CREATED);
          
    //         //code...
    //     }  catch (\Exception $ex) {
    //         return $this->api()->safeError($ex);
    //     }

        


    }
 
}
