<?php

namespace MixCode\Http\Controllers\Api\Auth;

use MixCode\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    // protected function sendResetResponse(Request $request, $response)
    // {
       
    //     return $this->api()->response(['message'=>  $response]);
    // }

    
    // protected function sendResetFailedResponse(Request $request, $response)
    // {
        
    //     return $this->api()->response(['message'=>  $response] );
    // }

      

    
}
