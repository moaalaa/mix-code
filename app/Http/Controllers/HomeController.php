<?php

namespace MixCode\Http\Controllers;

use Illuminate\Http\Request;
use MixCode\Client;
use MixCode\Portfolio;
use MixCode\Service;
 

class HomeController extends Controller
{
    public function index()
    {
     
        $services = Service::all();
        $clients = Client::orderBy('order','asc')->get();
         
        return view('index', compact([ 'services' , 'clients' ]));
    }
   
   


}
