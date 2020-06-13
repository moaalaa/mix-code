@extends('layouts.app')

@section('content')
<!-- Start Page -->
<div id="p-404" class="page pt-0">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="text">
					<h1>503</h1>
					<h3>{{ __($exception->getMessage() ?: 'Service Unavailable') }}</h3>
					<a class="btn btn-primary btn-back" href="{{ route('home') }}">@lang('site.home')</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Page -->
@endsection