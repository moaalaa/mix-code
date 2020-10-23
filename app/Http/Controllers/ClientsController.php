<?php

namespace MixCode\Http\Controllers;

use Illuminate\Http\Request;
use MixCode\Client;
use MixCode\Utils\UsingSEO;

class ClientsController extends Controller
{
    use UsingSEO;
    
    public function index()
    {
        tap(trans('site.client'), function ($seoTitle) {
            $this->seo()->generate(['title' => $seoTitle, 'description' => config('app.name') . ' ' . $seoTitle]);
        });

         $clients = Client::all();

         $clients->load('portfolios');
  
         return view('index', compact( 'clients' ));
        
    }


    public function show( Client $client)
    {
       
        return view('client-details' , compact('client'));
        
    }

}
