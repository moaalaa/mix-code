<?php

namespace MixCode\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MixCode\User;
use MixCode\Http\Controllers\Controller;
use MixCode\Http\Requests\ApiRegisterRequest;
use MoaAlaa\ApiResponder\ApiResponder;

class ApiRegisterController extends Controller
{
    use ApiResponder;
    
    /**
     * Register New User And Generate his token
     *
     * @param ApiRegisterRequest $request
     * @return json
     */
    public function register(ApiRegisterRequest $request)
    {
        try {
            $user = (new User())->register($request->all());
            
            $token = $user->createToken("User Token");
            
            $response = [
                "token_type"       => "Bearer",
                "token"            => $token->accessToken,
                "token_expires_at" => $token->token->expires_at,
                "user_info"             =>  $user 
            ];

            return $this->api()->response($response, null, Response::HTTP_CREATED);
            
        } catch (\Exception $ex) {
            return $this->api()->safeError($ex);
        }
    }

}
