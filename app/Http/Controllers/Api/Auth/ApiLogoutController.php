<?php

namespace MixCode\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MixCode\Http\Controllers\Controller;
use MixCode\Http\Requests\ApiLoginRequest;
use MoaAlaa\ApiResponder\ApiResponder;

class ApiLogoutController extends Controller
{
    use ApiResponder;
    
    /**
     * Logout User And revoke all him tokens
     *
     * @param Request $request
     * @return json
     */
    public function logout(Request $request)
    {
        try {
            auth()->user()->token()->revoke();
            
            return $this->api()->response([], 'User has been logged out successfully', Response::HTTP_OK);
            
        } catch (\Exception $ex) {
            return $this->api()->safeError($ex);
        }
    }
}
