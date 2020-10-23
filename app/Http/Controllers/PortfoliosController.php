<?php

namespace MixCode\Http\Controllers;

use Illuminate\Http\Request;
use MixCode\Portfolio;
use MixCode\Utils\UsingSEO;

class PortfoliosController extends Controller
{
    use UsingSEO;
    
    // public function index()
    // {
    //     tap(trans('site.portfolio'), function ($seoTitle) {
    //         $this->seo()->generate(['title' => $seoTitle, 'description' => config('app.name') . ' ' . $seoTitle]);
    //     });

    //      $portfolios = Portfolio::all();
  
    //      return view('index', compact( 'portfolios' ));
        
    // }


    // public function show( Portfolio $portfolio)
    // {

    //     $portfolio->load('categories');
          
    //     return view('portfolio-details' , compact('portfolio'));
        
    // }

}
