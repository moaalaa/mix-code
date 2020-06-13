@extends('layouts.app')

@section('content')


<div id="top-page">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="p-title">@lang('site.all_services')</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('site.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('site.all_services')</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Start Page -->
<div id="p-services" class="page py-5">
    <div class="container">
        <div class="row">
            @foreach ($services as $service)
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 custom-col">
                    @include('services._service_item', ['service' => $service])    
                </div>
            @endforeach     
        </div>
    </div>
</div>
<!-- End Page -->

@endsection