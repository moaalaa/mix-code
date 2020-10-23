@extends('dashboard.layouts.app')

@section('section', $sectionName)

@section('content')

<!-- Page Heading -->
<div class="d-flex flex-column flex-lg-row align-items-center justify-content-between mb-4">

    <h1 class="h3 mb-3 text-gray-800">{{ $sectionName }}</h1>
    <div class="text-center">

        {{-- @if ($client->isActive())
            <a href="{{ route('dashboard.clients.mark_as.in_active', $client) }}"
                class="d-sm-inline-block mb-2 btn btn-sm btn-danger shadow-sm">
                <i class="fas fa-times fa-sm text-white-50"></i>
                @lang('main.disable')
            </a>
        @else
            <a href="{{ route('dashboard.clients.mark_as.active', $client) }}"
                class="d-sm-inline-block mb-2 btn btn-sm btn-success shadow-sm">
                <i class="fas fa-check fa-sm text-white-50"></i>
                @lang('main.active')
            </a>
        @endif --}}

        <a href="{{ route('dashboard.clients.edit', $client) }}"
            class="d-sm-inline-block mb-2 btn btn-sm btn-info shadow-sm">
            <i class="fas fa-edit fa-sm text-white-50"></i>
            @lang('main.edit')
        </a>

        <a href="{{ route('dashboard.clients.destroy',  $client) }}"
            class="d-sm-inline-block mb-2 btn btn-sm btn-danger shadow-sm" data-toggle="modal"
            data-target="#deleteModel-{{ $client->id }}" title="@lang('main.delete')">
            <i class="fas fa-trash fa-sm text-white-50"></i>
            @lang('main.delete')
        </a>

        <a href="{{ route('dashboard.clients.create') }}" class="d-sm-inline-block mb-2 btn btn-sm btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            @lang('main.add') @lang('main.clients')
        </a>

        <a href="{{ route('dashboard.clients.index') }}" class="d-sm-inline-block mb-2 btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-tag fa-sm text-white-50"></i>
            @lang('main.show_all') @lang('main.clients')
        </a>

        @component('dashboard.components.deleteModelForm')
            @slot('id', $client->id )
            @slot('deleteTitle', trans('main.clients') . ' ' . $client->name_by_lang)
            @slot('url', route('dashboard.clients.destroy', $client->id) )
        @endcomponent

    </div>
</div>

<!-- Content Row -->
<div class="row">

    <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
        <div class="card  border-left-success">
            
            <div class="card-body">

                <div class="card-title font-weight-bold h5 text-center  row">
                    <div class="card-title col-md-6 col-sm-12 mb-0">@lang('main.created_at'):
                        {{ $client->created_at->calendar() }} </div>
                        <div class="card-title col-md-6 col-sm-12 mb-0">@lang('main.updated_at'):
                        {{ $client->updated_at->calendar() }} </div>
                </div>
                <hr>
                <div class="card-text">
                    <div class="row">

                        {{-- EN Name --}}
                        <div class="col-md-6 col-sm-12">
                            <div class="h6">
                                <span class="font-weight-bold">@lang('main.en_name'): </span>
                                <span class="text-muted">{{ $client->en_name }}</span>
                            </div>
                            <hr>
                        </div>

                        {{-- AR Name --}}
                        <div class="col-md-6 col-sm-12">
                            <div class="h6">
                                <span class="font-weight-bold">@lang('main.ar_name'): </span>
                                <span class="text-muted">{{ $client->ar_name }}</span>
                            </div>
                            <hr>
                        </div>
 
 {{-- type --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.type'): </span>

        <span class="text-muted">{{ $client->type_by_lang }}</span>
    </div>
    <hr>
</div>

 

<div class="col-xl-12 col-md-12 col-sm-12 mb-3">
    {{-- English Overview --}}
<div class="card border-left-warning mb-3">
 <div class="card-body">
     <div class="card-title font-weight-bold h5 text-center text-warning">@lang('main.en_overview')</div>
     <div class="card-text">
         {!! $client->en_overview !!}
     </div>
 </div>
</div>

{{-- Arabic Overview --}}
<div class="card border-left-warning mb-3">
 <div class="card-body">
     <div class="card-title font-weight-bold h5 text-center text-warning">@lang('main.ar_overview')</div>
     <div class="card-text">
         {!! $client->ar_overview !!}
     </div>
 </div>
</div>            
 </div>
 
                        {{-- Icon --}}
                        <div class="col-md-12 col-sm-12">
                            <div class="h6">
                                <span class="font-weight-bold">@lang('main.logo'): </span>
                                <span class="text-muted">
                                    <img class="fixed-image-size" src="{{ $client->mainMediaUrl()  }}" alt="{{ $client->name_by_lang }}">    
                                </span>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

</div>
@endsection