@extends('dashboard.layouts.app') 

@section('section', $sectionName)

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $sectionName }}</h1>
        <a href="{{ route('dashboard.courses.index') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-paperclip fa-sm text-white-50"></i> 
            @lang('main.show_all') @lang('main.courses')
        </a>
    </div>
    
    <!-- Content Row -->
    <div class="row">
    
        <div class="col-xl-1 col-md-1"></div>
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body border-left-info">
                    <div class="card-title font-weight-bold h5 text-center text-info">{{ $sectionName }}</div>
                    <div class="card-text">

                        <form action="{{ route('dashboard.courses.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
    
                            {{-- EN Name --}}
                            <div class="form-group my-4 row">
                                <label class="col-sm-2 col-form-label" for="en_name">@lang('main.en_name')<span class="required"></span> </label>
                                <div class="col-sm-10">
                                    <input type="text" name="en_name" value="{{ old('en_name') }}" id="en_name" class="form-control @error('en_name') is-invalid @enderror" placeholder="@lang('main.en_name')" required>
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
                                    <input type="text" name="ar_name" value="{{ old('ar_name') }}" id="ar_name" class="form-control @error('ar_name') is-invalid @enderror" placeholder="@lang('main.ar_name')" required>
                                    @error('ar_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            {{-- English Overview --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="en_overview">@lang('main.en_overview')<span class="required"></span> </label>
    <div class="col-sm-10">
        <textarea type="text" name="en_overview" id="en_overview" class="form-control @error('en_overview') is-invalid @enderror" placeholder="@lang('main.en_overview')" required>
            {{ old('en_overview') }}
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
            {{ old('ar_overview') }}
        </textarea>
        @error('ar_overview')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>





 
    
                            <div class="form-group mb-4 row">
                                <label class="col-sm-2 col-form-label" for="images">@lang('main.images')<span class="required"></span> </label>
                                <div class="col-sm-10">
                                    <input type="file" name="images" id="images" accept=".png,.jpg,.jpeg"  >
                            
                                    @error('images')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-info">@lang('main.add') @lang('main.course')</button>
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
<script src="{{ asset('/dashboard_assets/libs/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
@endsection