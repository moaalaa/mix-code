@extends('dashboard.layouts.app') 

@section('section', $sectionName)

@section('styles')
    {{-- Bootstrap file input --}}
    <link href="{{ asset('/dashboard_assets/libs/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>

    {{-- Bootstrap Switch --}}
    <link href="{{ asset('/dashboard_assets/libs/bootstrap-switch/css/bootstrap-switch' . getRtlDirection() . '.min.css') }}" rel="stylesheet" type="text/css"/>

    {{-- Select2 --}}
    <link href="{{ asset('/dashboard_assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/dashboard_assets/libs/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $sectionName }}</h1>
        
        <div>
            <a href="{{ route('dashboard.cities.show', $city) }}" class="d-sm-inline-block btn btn-sm btn-info shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i> 
                @lang('main.show') {{ $city->name_by_lang }}
            </a>
            
            <a href="{{ route('dashboard.cities.index') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-map-signs fa-sm text-white-50"></i> 
                @lang('main.show_all') @lang('main.cities')
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
                        <form action="{{ route('dashboard.cities.update', $city) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
    
                            {{-- EN Name --}}
                            <div class="form-group my-4 row">
                                <label class="col-sm-2 col-form-label" for="en_name">@lang('main.en_name')<span class="required"></span> </label>
                                <div class="col-sm-10">
                                    <input type="text" name="en_name" value="{{ $city->en_name }}" id="en_name" class="form-control @error('en_name') is-invalid @enderror" placeholder="@lang('main.en_name')" required>
                                    
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
                                    <input type="text" name="ar_name" value="{{ $city->ar_name }}" id="ar_name" class="form-control @error('ar_name') is-invalid @enderror" placeholder="@lang('main.ar_name')" required>
                                    
                                    @error('ar_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Country --}}
                            <div class="form-group mb-4 row">
                                <label class="col-sm-2 col-form-label" for="country_id">@lang('main.country')<span class="required"></span> </label>
                                <div class="col-sm-10">
                                    <select name="country_id" id="country_id" class="form-control select2 @error('country_id') is-invalid @enderror" data-placeholder="@lang('main.country')" required>
                                        <option value="" disabled selected>@lang('main.country_id')</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" {{ $city->country_id == $country->id ? 'selected' : '' }}> {{ $country->name_by_lang }} </option>
                                        @endforeach
                                    </select>
                                    
                                    @error('country_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="form-group mb-4 row">
                                <label class="col-sm-2 col-form-label" for="status">@lang('main.status')<span class="required"></span> </label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="status" value="disable">
                                    
                                    <input type="checkbox" id="status" name="status" class="switch"  
                                        data-on-color="success" 
                                        data-off-color="danger" 
                                        data-on-text="@lang('main.active')" 
                                        data-off-text="@lang('main.disable')" 
                                        value="active"
                                        {{ $city->status === 'active' ? 'checked' : '' }}
                                        >
                                        
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            {{-- Image --}}
                            <div class="form-group mb-4 row">
                                <label class="col-sm-2 col-form-label" for="image">@lang('main.image')</label>
                                <div class="col-sm-10">

                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                            <img src="{{ $city->mainMediaUrl() }}" alt="{{ $city->name_by_lang }}" /> 
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
                                    <button type="submit" class="btn btn-info">@lang('main.edit') @lang('main.city')</button>
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

    {{-- Bootstrap Switch --}}
    <script src="{{ asset('/dashboard_assets/libs/bootstrap-switch/js/bootstrap-switch.js') }}" type="text/javascript"></script>

    {{-- Select2 --}}
    <script src="{{ asset('/dashboard_assets/libs/select2/js/select2.min.js') }}" type="text/javascript"></script>
@endsection