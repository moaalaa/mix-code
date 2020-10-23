<section id="services" class="section-bg">
	<div class="container" data-aos="fade-up">

	  <header class="section-header pb-5">
		<h3 >Services</h3>
		{{-- <p>Laudem latine persequeris id sed, ex fabulas delectus quo. No vel partiendo abhorreant vituperatoribus.</p> --}} 
	</header>

	  <div class="row justify-content-center">


		@foreach ($services as $service)
		<div class="col-md-6 col-lg-5" data-aos="zoom-in" data-aos-delay="100">
			<div class="box text-center">
			  <div class="icon">
				<img class=" service-img" src="{{  $service->mainMediaUrl() }} " alt="{{$service->name_by_lang}}" style="width:100%">
			</div>
			<h4 class="title"><a href="">{{$service->name_by_lang}}</a></h4>
			  <p class="description">{!!$service->overview_by_lang !!}</p>
			</div>
		  </div>
			  
		@endforeach
		
	  
	   

	  </div>

	</div>
  </section>