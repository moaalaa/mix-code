<div class="container">
	<div class="row">
		<div class="col">
			{{-- <div class="heading" data-aos="fade-up" data-aos-duration="3000" data-aos-anchor-placement="top-center">
				<h3 class="title">@Lang('main.services')</h3>
			</div> --}}

			<div class="heading">
				<h3 class="title">@Lang('main.services')</h3>
			</div>
		</div>
	</div>
	<div class="row">

		@foreach ($services as $service)
			<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12" data-aos="flip-down" data-aos-duration="3000" data-aos-anchor-placement="top-center">
				<div class="s-item">
					<div class="image">
						<img class="service-image-small" src="{{ $service->mainMediaUrlByLang() }}"
							alt="{{ $service->name_by_lang }}">
					</div>
					<div class="text">
						<h6>
							<a href="{{ route('our_work.show_by_service', $service) }}">{{ $service->name_by_lang }}</a>
						</h6>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>