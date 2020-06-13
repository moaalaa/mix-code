<section class="clients-slider">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="heading" data-aos="fade-up" data-aos-duration="3000" data-aos-anchor-placement="top-center">
					<h3 class="title">@lang('main.clients')</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="owl-carousel owl-theme clients">
					@foreach ($clients as $client)
						@if (strpos($client->mainMediaUrl(), 'placehold.co') !== false)
						@else
							<div class="item">
								<a href="{{ $client->url ?? '#' }}" target="{{ !! $client->url ? '_blank' : '_self'  }}">
									<img src="{{ $client->mainMediaUrl() }}" alt="{{ $client->name_by_lang }}" class="client-slider-image">
								</a>
							</div>
						@endif
					@endforeach

				</div>
			</div>
		</div>
	</div>
</section>