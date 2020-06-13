<?php

namespace MixCode\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MixCode\Http\Controllers\Controller;
use MoaAlaa\ApiResponder\ApiResponder;
use MixCode\Setting ;
 
class GeneralDataController extends Controller
{
    use ApiResponder;

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // NOTE: Not Tested Yet
        $data = [];
        $settings = getSettings();
        $lang = ($request->has('lang') && $request->filled('lang')) ? $request->lang : 'ar';

        // Basic (Contact) Data
        $data['basic'] = [
            'email' => $settings->email,
            'phone' => $settings->phone,
            'address' => $settings->address,
            'map_url' => $settings->map_url,
        ];

        // About Data
        $data['about'] = [
            'about_us'   => shortCleanString($settings->{$lang . "_about_us"}),
            'mission'    => shortCleanString($settings->{$lang . "_mission"}),
            'vision'     => shortCleanString($settings->{$lang . "_vision"}),
            'values'     => shortCleanString($settings->{$lang . "_values"}),
            'terms_and_conditions,'     => shortCleanString($settings->{$lang . "_terms_and_conditions"}),
        ];

        // social Data
        $data['social'] = [
            'facebook'      => $settings->facebook,
            'twitter'       => $settings->twitter,
            'linkedin'      => $settings->linkedin,
            'instagram'     => $settings->instagram,
            'snapchat'      => $settings->snapchat,
            'youtube'       => $settings->youtube,
        ];


             // social Data
             $data['media'] =  [
                 'logo' =>  $settings->mainMediaUrl('intro_image')  ,
                 'slider_images' =>  $settings->allMedia('slider_image')->map->getUrl()  ,
                 
             ];

        
        return $this->api()->response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \MixCode\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    // public function show(Feature $feature)
    // {
    // return $this->api()->response($feature);
    // }
}
