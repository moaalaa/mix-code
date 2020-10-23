<section id="clients" class="section-bg">

  <div class="container" data-aos="fade-up">

    <div class="section-header">
      <h3>@lang('site.our_clients')</h3>
    </div>

    <div class="row no-gutters clients-wrap clearfix" data-aos="zoom-in" data-aos-delay="100">
 

      @foreach ($clients as $client)
      <div class="col-lg-3 col-md-4 col-xs-6">
        <div class="client-logo">
          <img src="{{  $client->mainMediaUrl() }}  " class="img-fluid" alt="">
        </div>
      </div>
      @endforeach

    </div>

  </div>

</section>