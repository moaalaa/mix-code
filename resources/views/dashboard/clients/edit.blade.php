@extends('dashboard.layouts.app') 

@section('section', $sectionName)

@section('styles')
    {{-- Bootstrap file input --}}
    <link href="{{ asset('/dashboard_assets/libs/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>

    {{-- Bootstrap Switch --}}
    <link href="{{ asset('/dashboard_assets/libs/bootstrap-switch/css/bootstrap-switch' . getRtlDirection() . '.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
 

    <!-- Page Heading -->
    <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-3 text-gray-800">{{ $sectionName }}</h1>
        
        <div>
            <a href="{{ route('dashboard.clients.show', $client) }}" class="d-sm-inline-block mb-2 btn btn-sm btn-info shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i> 
                @lang('main.show') {{ $client->name_by_lang }}
            </a>
            
            <a href="{{ route('dashboard.clients.index') }}" class="d-sm-inline-block mb-2 btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-tag fa-sm text-white-50"></i> 
                @lang('main.show_all') @lang('main.clients')
            </a>

        </div>
    </div>
    
    <!-- Content Row -->
    <div class="row mb-3">
    
        <div class="col-xl-1 col-md-1"></div>
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body border-left-info">
                    <div class="card-title font-weight-bold h5 text-center text-info">{{ $sectionName }}</div>
                    <div class="card-text">
                        <form action="{{ route('dashboard.clients.update', $client) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
    
                            {{-- EN Name --}}
                            <div class="form-group my-4 row">
                                <label class="col-sm-2 col-form-label" for="en_name">@lang('main.en_name')<span class="required"></span> </label>
                                <div class="col-sm-10">
                                    <input type="text" name="en_name" value="{{ $client->en_name }}" id="en_name" class="form-control @error('en_name') is-invalid @enderror" placeholder="@lang('main.en_name')" required>
                                    
                                    @error('en_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            {{-- AR Name --}}
                            <div class="form-group mb-4 row">
                                <label class="col-sm-2 col-form-label" for="ar_name">@lang('main.ar_name')<span class="required"></span> </label>
                                <div class="col-sm-10">
                                    <input type="text" name="ar_name" value="{{ $client->ar_name }}" id="ar_name" class="form-control @error('ar_name') is-invalid @enderror" placeholder="@lang('main.ar_name')" required>
                                    
                                    @error('ar_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            {{-- EN type --}}
                            <div class="form-group my-4 row">
                                <label class="col-sm-2 col-form-label" for="en_type">@lang('main.en_type')<span class="required"></span> </label>
                                <div class="col-sm-10">
                                    <input type="text" name="en_type" value="{{ $client->en_type }}" id="en_type" class="form-control @error('en_type') is-invalid @enderror" placeholder="@lang('main.en_type')" required>
                                    @error('en_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            {{-- AR type --}}
                            <div class="form-group mb-4 row">
                                <label class="col-sm-2 col-form-label" for="ar_type">@lang('main.ar_type')<span class="required"></span> </label>
                                <div class="col-sm-10">
                                    <input type="text" name="ar_type" value="{{ $client->ar_type }}" id="ar_type" class="form-control @error('ar_type') is-invalid @enderror" placeholder="@lang('main.ar_type')" required>
                                    @error('ar_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            {{-- English Overview --}}
         <div class="form-group mb-4 row">
             <label class="col-sm-2 col-form-label" for="en_overview">@lang('main.en_overview')<span class="required"></span> </label>
             <div class="col-sm-10">
                 <textarea type="text" name="en_overview" id="en_overview" class="form-control @error('en_overview') is-invalid @enderror" placeholder="@lang('main.en_overview')" required>
                     {{ $client->en_overview }}
                 </textarea>
                 @error('en_overview')
                     <div class="invalid-feedback">
                         {{ $message }}
                     </div>
                 @enderror
             </div>
         </div>
         
         {{-- Arabic Overview --}}
         <div class="form-group mb-4 row">
             <label class="col-sm-2 col-form-label" for="ar_overview">@lang('main.ar_overview')<span class="required"></span> </label>
             <div class="col-sm-10">
                 <textarea type="text" name="ar_overview" id="ar_overview" class="form-control @error('ar_overview') is-invalid @enderror" placeholder="@lang('main.ar_overview')" required>
                     {{ $client->ar_overview }}
                 </textarea>
                 @error('ar_overview')
                     <div class="invalid-feedback">
                         {{ $message }}
                     </div>
                 @enderror
             </div>
         </div>                  

                            {{-- Icon --}}
                            <div class="form-group mb-4 row">
                                <label class="col-sm-2 col-form-label" for="logo">@lang('main.logo')</label>
                                <div class="col-sm-10">


                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                            <img src="{{ $client->mainMediaUrl('image') }}" alt="{{ $client->name_by_lang }}" /> 
                                        </div>
                                        <div>
                                            <span class="btn blue btn-outline btn-file">
                                                <span class="fileinput-new btn btn-success"> @lang('main.select_image') </span>
                                                <span class="fileinput-exists btn btn-info"> @lang('main.change') </span>
                                                <input type="file" name="image" id="image" accept="jpg,png,jpeg">
                                            </span>
                                            <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> @lang('main.remove') </a>
                                        </div>
                                    </div>
                                    
                                    

                                    @error('image')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-info">@lang('main.edit') @lang('main.client')</button>
                                </div>
                            </div>
                        </form>
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


    {{-- Bootstrap Switch --}}
    <script src="{{ asset('/dashboard_assets/libs/bootstrap-switch/js/bootstrap-switch.js') }}" type="text/javascript"></script>
@endsection