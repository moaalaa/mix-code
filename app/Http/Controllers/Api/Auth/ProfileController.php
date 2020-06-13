<?php

namespace MixCode\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use MixCode\Http\Controllers\Controller;
use MixCode\Http\Requests\ProfileRequest;
use MixCode\Order;
use MixCode\Card;
use MixCode\User ;
use MoaAlaa\ApiResponder\ApiResponder;

class ProfileController extends Controller
{
    use ApiResponder;
    
    /**
     * Get User Profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return $this->api()->response(auth()->user());
    }
    


    /**
     * Get User ordered card
     *
     * @return \Illuminate\Http\Response
     */

    public function getCardByUserId($id )
    {
   
        $order = Order::with('cards')->where('user_id' , '=' ,$id)->get();
         
        return $this->api()->response($order , Response::HTTP_CREATED);

    }



    /**
     * Update User Profile
     *
     * @param \MixCode\Http\Requests\ProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(ProfileRequest $request)
    {
        auth()->user()->update($request->validated());

        return $this->api()->response(auth()->user());
    }
    
    /**
     * Update User Logo
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo'  => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);
        
        auth()->user()->syncMedia($request->only('logo'));

        return $this->api()->response(auth()->user());
    }
    
    /**
     * Update User Profile
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        $password = ['password' => Hash::make($request->password)];
        
        auth()->user()->update($password);

        return $this->api()->response(auth()->user());
    }

}