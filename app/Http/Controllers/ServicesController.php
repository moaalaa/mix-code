<?php

namespace MixCode\Http\Controllers;

use Illuminate\Http\Request;
use MixCode\Service;
use MixCode\Utils\UsingSEO;

class ServicesController extends Controller
{
    use UsingSEO;
    
    public function index()
    {
        tap(trans('site.service'), function ($seoTitle) {
            $this->seo()->generate(['title' => $seoTitle, 'description' => config('app.name') . ' ' . $seoTitle]);
        });

         $services = Service::all();
  
         return view('index', compact( 'services' ));
        
    }

 

}
