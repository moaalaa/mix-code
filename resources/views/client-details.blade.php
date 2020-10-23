@extends('layouts.app')

 @section('content')

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>{{$client->name_by_lang}}</h2>
        <ol>
          <li><a href="/index">@lang('site.home')</a></li>
          <li>client details</li>
        </ol>
      </div>

    </div>
  </section><!-- Breadcrumbs Section -->

  <!-- ======= Portfolio Details Section ======= -->
  <section class="portfolio-details">
    <div class="container">

      <div class="portfolio-details-container">
<div class=row>
  <div class="col-lg-6 col-md-6 col-xs-6">
       <img src="{{  $client->mainMediaUrl() }}" class="client-details-image img-responsive"   alt="{{$client->name_by_lang}}">

      <div class="portfolio-description">
              <h2>{{$client->type_by_lang}}</h2>
             <p>  {!! $client->overview_by_lang !!} </p> 
        </div>

  </div>
  
  <div class="col-lg-6 col-md-6 col-xs-6">
 
    <h3 class="mt-5 mb-4"> Services</h3>

    @foreach ($client->portfolios as $portfolio)

    <div class="portfolio-info">
   
      <ul>
        <li><strong>Category</strong>:
          @foreach ($portfolio->categories as $category)
               {{ $category->name_by_lang }} 
          @endforeach

        </li>
        <li><strong>Project URL</strong>: <a href="{{$portfolio->url}}"><i class="fa fa-link btn btn-s btn-primary"> </i></a></li>
      </ul>
    </div>

 
    @endforeach
  </div>

</div>
        

      </div>






    </div>
  </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

@endsection