@extends('dashboard.layouts.app') 

@section('section', $sectionName)

@section('styles')

    {{-- gijgo-bootstrap-datepicker --}}
    <link href="{{ asset('/dashboard_assets/libs/gijgo-bootstrap-datepicker/css/gijgo.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- Select2 --}}
    <link href="{{ asset('/dashboard_assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/dashboard_assets/libs/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

  {{-- Bootstrap Switch --}}
   <link href="{{ asset('/dashboard_assets/libs/bootstrap-switch/css/bootstrap-switch' . getRtlDirection() . '.min.css') }}" rel="stylesheet" type="text/css"/>


    <style>
        .grid-col {
            flex: 1;
            padding: 0 .1em;
        }
    </style>

    
    @if (isRtl())
        <style>
            .gj-picker-bootstrap div[role=navigator] {
                flex-direction: row-reverse !important;
            }
        </style>
    @endif
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $sectionName }}</h1>
        
        <div>
            <a href="{{ route('dashboard.portfolios.show', $portfolio) }}" class="d-sm-inline-block btn btn-sm btn-info shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i> 
                @lang('main.show') {{ $portfolio->name_by_lang }}
            </a>
            
            <a href="{{ route('dashboard.portfolios.index') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plane fa-sm text-white-50"></i> 
                @lang('main.show_all') @lang('main.portfolios')
            </a>

        </div>
    </div>
    
    <!-- Content Row -->
    <div class="row mb-3">
    
        <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
            <div class="card">
                <div class="card-body border-left-info">
                    <div class="card-title font-weight-bold h5 text-center text-info">{{ $sectionName }}</div>
                    <div class="card-text">
                        <form action="{{ route('dashboard.portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
    
                            
 

{{-- client --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="client">@lang('main.client')<span
            class="required"></span> </label>
    <div class="col-sm-10">
       
            <select name="client_id" id="client_id"
            class="form-control select2 @error('client_id') is-invalid @enderror"
            data-placeholder="@lang('main.clients')" required>
            @foreach ($clients as $client)
            <option value="{{ $client->id }}"
                {{  $client->id == old('client_id') ? 'selected' : '' }}>
                {{ $client->name_by_lang }}
            </option>
            @endforeach
        </select>    

        @error('client')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

{{-- url --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="url">@lang('main.url')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="text" name="url" value="{{ $portfolio->url }}" id="url" class="form-control @error('url') is-invalid @enderror" placeholder="@lang('main.url')" required>
        @error('url')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>



     <hr>

                {{-- Categories --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="categories_id">@lang('main.categories')<span class="required"></span> </label>
    <div class="col-sm-10">
        <select name="categories_id" id="categories_id" class="form-control select2 @error('categories_id') is-invalid @enderror" data-placeholder="@lang('main.categories')"   required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ in_array($category->id, $portfolio->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                    {{ $category->name_by_lang }} 
                </option>
            @endforeach
        </select>

        @error('categories_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
                            
            
                            <hr>  

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
                        {{ $category->status === 'active' ? 'checked' : '' }}
                        >
                        
                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
                            <hr>

              
{{-- Images --}}
{{-- <div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="images">@lang('main.images')</label>
    <div class="col-sm-10">
        <input type="file" name="images" id="images" accept=".png,.jpg,.jpeg" >

        @error('images')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div> --}}

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-info">@lang('main.edit') @lang('main.portfolios')</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-12 col-md-12 col-sm-12">
            {{-- Media --}}
            @include('dashboard.portfolios.includes.show._media')
        </div>
    </div>
    
@endsection

@section('scripts')
    {{-- gijgo-bootstrap-datepicker --}}
    <script src="{{ asset('/dashboard_assets/libs/gijgo-bootstrap-datepicker/js/gijgo.min.js') }}" type="text/javascript"></script>
        
    {{-- Colcade --}}
    <script src="{{ asset('/dashboard_assets/libs/colcade/colcade.js') }}" type="text/javascript"></script>
        
    {{-- Select2 --}}
    <script src="{{ asset('/dashboard_assets/libs/select2/js/select2.min.js') }}" type="text/javascript"></script>
    
    {{-- CKeditor --}}
    <script src="{{ asset('/dashboard_assets/libs/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
     {{-- Bootstrap Switch --}}
     <script src="{{ asset('/dashboard_assets/libs/bootstrap-switch/js/bootstrap-switch.js') }}" type="text/javascript"></script>

 

    {{-- Colcade Init --}}
    <script>
        new Colcade('.grid', {
            columns: '.grid-col',
            items: '.grid-item'   
        });
    </script>

    {{-- Delete Media --}}
    <script>
        deleteMedia('.delete-image', '{{ route("dashboard.portfolios.media.destroy", $portfolio) }}');
    </script>
@endsection