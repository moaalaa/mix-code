
@extends('dashboard.layouts.app') 

@section('section', $sectionName)

@section('styles')
    {{-- Bootstrap file input --}}
    <link href="{{ asset('/dashboard_assets/libs/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $sectionName }}</h1>
    </div>
    
    <!-- Content Row -->
    <div class="row mb-3">
    
        <div class="col-xl-1 col-md-1"></div>
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                        
                        {{-- Basic Tab --}}
                        <li class="nav-item">
                            <a class="nav-link active" id="basics-tab" data-toggle="tab" href="#basics" role="tab" aria-controls="basics" aria-selected="true">
                                @lang('main.basic')
                            </a>
                        </li>

                        {{-- Images Tab --}}
                        <li class="nav-item">
                            <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images-tab" aria-selected="false">
                                @lang('main.images')
                            </a>
                        </li>

                        {{-- About Us Tab --}}
                        <li class="nav-item">
                            <a class="nav-link" id="about-us-tab" data-toggle="tab" href="#about-us" role="tab" aria-controls="about-us" aria-selected="false">
                                @lang('site.about_us')
                            </a>
                        </li>

                        {{-- Social Media Tab --}}
                        <li class="nav-item">
                            <a class="nav-link" id="socials-tab" data-toggle="tab" href="#socials" role="tab" aria-controls="socials" aria-selected="false">
                                @lang('main.social_links')
                            </a>
                        </li>
    
                    </ul>
                </div>
                <div class="card-body border-left-info">
                    <div class="card-title font-weight-bold h5 text-center text-info">{{ $sectionName }}</div>
                    <div class="card-text">                            
                            <div class="tab-content">
                                
                                {{-- Basic Information --}}
                                <div class="tab-pane fade show active" id="basics" role="tabpanel" aria-labelledby="basics-tab">
                                    <form action="{{ route('dashboard.settings.store', $settings) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @include('dashboard.settings._basic', ['settings' => $settings])

                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-info">@lang('main.edit') @lang('main.basic')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                {{-- Images --}}
                                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                    <form action="{{ route('dashboard.settings.store', $settings) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @include('dashboard.settings._images', ['settings' => $settings])

                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-info">@lang('main.edit') @lang('main.images')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                {{-- About Us --}}
                                <div class="tab-pane fade" id="about-us" role="tabpanel" aria-labelledby="about-us-tab">
                                    <form action="{{ route('dashboard.settings.store', $settings) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @include('dashboard.settings._about_us', ['settings' => $settings])
                                    
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-info">@lang('main.edit') @lang('site.about_us')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
    
                                {{-- Socials --}}
                                <div class="tab-pane fade" id="socials" role="tabpanel" aria-labelledby="socials-tab">
                                    <form action="{{ route('dashboard.settings.store', $settings) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @include('dashboard.settings._socials', ['settings' => $settings])
                                    
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-info">@lang('main.edit') @lang('main.social_links')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>

                        
                    </div>

                </div>
            </div>
        </div>
    
    </div>
@endsection

@section('scripts')
    {{-- Bootstrap file input --}}
    <script src="{{ asset('/dashboard_assets/libs/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

    {{-- CKeditor --}}
    <script src="{{ asset('/dashboard_assets/libs/ckeditor/ckeditor.js') }}" type="text/javascript"></script>

    <script>
        deleteMedia('.delete-settings-image', '{{ route("dashboard.settings.media.destroy") }}');
    </script>
@endsection