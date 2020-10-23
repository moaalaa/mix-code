@extends('dashboard.layouts.app')



@section('section', $sectionName)


@section('styles')
    <style>
        .grid-col {
            flex: 1;
            padding: 0 .1em;
        }
    </style>
@endsection

@section('content')




<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $sectionName }}</h1>
    <div>
        <a href="{{ route('dashboard.portfolios.edit', $portfolio) }}"
            class="d-sm-inline-block btn btn-sm btn-info shadow-sm">
            <i class="fas fa-edit fa-sm text-white-50"></i>
            @lang('main.edit')
        </a>

        <a href="{{ route('dashboard.portfolios.destroy',  $portfolio) }}"
            class="d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal"
            data-target="#deleteModel-{{ $portfolio->id }}" title="@lang('main.delete')">
            <i class="fas fa-trash fa-sm text-white-50"></i>
            @lang('main.delete')
        </a>

        <a href="{{ route('dashboard.portfolios.create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            @lang('main.add') @lang('main.portfolios')
        </a>

        <a href="{{ route('dashboard.portfolios.index') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plane fa-sm text-white-50"></i>
            @lang('main.show_all') @lang('main.portfolios')
        </a>

        @component('dashboard.components.deleteModelForm')
            @slot('id', $portfolio->id )
            @slot('deleteTitle', trans('main.portfolios') . ' ' . $portfolio->name_by_lang)
            @slot('url', route('dashboard.portfolios.destroy', $portfolio->id) )
        @endcomponent

    </div>
</div>

<!-- Content Row -->
<div class="row">

    {{-- Basic Info --}}
    <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
        <div class="card  border-left-success">

            <div class="card-body">
                <div class="card-title font-weight-bold h5 text-center  row">
                    <div class="card-title col-md-6 col-sm-12 mb-0">@lang('main.created_at'):
                        {{ $portfolio->created_at->calendar() }} </div>
                    <div class="card-title col-md-6 col-sm-12 mb-0">@lang('main.updated_at'):
                        {{ $portfolio->updated_at->calendar() }} </div>
                </div>
                <hr>
                <div class="card-text">
                    <div class="row">

                     {{-- clinet name --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.client'): </span>

        <span class="text-muted">{{ $portfolio->client->en_name }}</span>
    </div>
    <hr>
</div>

 

{{-- url --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.url'): </span>

        <span class="text-muted">{{ $portfolio->url }}</span>
    </div>
    <hr>
</div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   

    {{-- features Info --}}
    <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
       <div class="row">
        <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
            <div class="card  border-left-danger">
        
                <div class="card-title font-weight-bold h5 text-center text-danger my-2">@lang('main.categories')</div>
                 
                <ul class="list-group list-group-flush">
                    @foreach ($portfolio->categories as $category)
                        
                        <a href="{{ $category->path() }}" class="list-group-item list-group-item-action" target="_blank">{{ $category->name_by_lang }}</a>
                        
                    @endforeach
                </ul>
                
            </div>
        </div>
       </div>
    </div>
    
   
 


    {{-- status --}}
    <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
<div class="card border-left-warning mb-3">
    <div class="card-body">
        <div class="card-title font-weight-bold h5 text-center text-warning">@lang('main.status')</div>
        <div class="card-text">
             @lang('main.'.$portfolio->status)
         </div>
    </div>
</div>  
</div>          
     


    {{-- Media --}}
    {{-- <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
        <div class="grid d-flex">
            @php
                $media = $portfolio->allMedia();
            @endphp
        
            <div class="grid-col grid-col--1"></div>
            <div class="grid-col grid-col--2 d-sm-none d-md-block"></div>
            <div class="grid-col grid-col--3 d-sm-none d-lg-block"></div>
            <div class="grid-col grid-col--4"></div>
            
            @foreach ($media as $image)
                <div class="card grid-item image-container">
                    <img class="card-img portfolio-image" src="{{ $image->getUrl() }}">
                        
                    <button type="button" class="btn btn-danger btn-sm delete-image" data-id="{{ $image->id }}">
                        <i class="fas fa-trash"></i>
                    </button>
        
                </div>
            @endforeach
        
        </div>
    </div> --}}

</div>
@endsection


@section('scripts')
    {{-- Colcade --}}
    <script src="{{ asset('/dashboard_assets/libs/colcade/colcade.js') }}" type="text/javascript"></script>
    
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