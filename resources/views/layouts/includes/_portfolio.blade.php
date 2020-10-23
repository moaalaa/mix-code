
<section id="portfolio" class="clearfix">
    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <h3 class="section-title">@lang('site.portfolio')</h3>
      </header>
  
      <div class="row justify-content-center  " data-aos="fade-up" data-aos-delay="200">

        <!-- app section -->
 @foreach ($clients as $client)
 <div class="col-md-6 col-lg-4"  >
 <div class="card portfolio-card " >
  <img class="card-img-top  portfolio-img" src="{{  $client->mainMediaUrl() }} " alt="Card image" style="width:100%">
  <div class="card-body text-center">
  <h4 class="card-title portfolio-card-title">{{$client->name_by_lang}}</h4>
    <p class="card-text portfolio-card-text ">  {{$client->type_by_lang }} </p>
    <hr>
    <a href="{{ route('client_details',$client->id)}}" class="btn btn-primary card-text-btn "><i class="ion ion-android-open"></i> Project Details</a>
  </div>
</div>
</div>
 @endforeach    
 
 
      </div>

    </div>
  </section>