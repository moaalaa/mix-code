@extends('dashboard.layouts.app')

@section('section', $sectionName)

@section('content')


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $sectionName }}</h1>
    <div>
        <a href="{{ route('dashboard.cities.edit', $city) }}"
            class="d-sm-inline-block btn btn-sm btn-info shadow-sm">
            <i class="fas fa-edit fa-sm text-white-50"></i>
            @lang('main.edit')
        </a>

        <a href="{{ route('dashboard.cities.destroy',  $city) }}"
            class="d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal"
            data-target="#deleteModel-{{ $city->id }}" title="@lang('main.delete')">
            <i class="fas fa-trash fa-sm text-white-50"></i>
            @lang('main.delete')
        </a>

        <a href="{{ route('dashboard.cities.create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            @lang('main.add') @lang('main.cities')
        </a>

        <a href="{{ route('dashboard.cities.index') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-map-signs fa-sm text-white-50"></i>
            @lang('main.show_all') @lang('main.cities')
        </a>

        @component('dashboard.components.deleteModelForm')
            @slot('id', $city->id )
            @slot('deleteTitle', trans('main.cities') . ' ' . $city->name_by_lang)
            @slot('url', route('dashboard.cities.destroy', $city->id) )
        @endcomponent

    </div>
</div>

<!-- Content Row -->
<div class="row">

    <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
        <div class="card  border-left-success">
            <div class="row no-gutters">
                <div class="col-md-4 col-sm-12">
                    <img src="{{ $city->mainMediaUrl() }}" class="card-img-top card-custom-image" alt="{{ $city->name_by_lang }}">
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="card-body">
                        <div class="card-title font-weight-bold h5 text-center  row">
                            <div class="card-title col-md-6 col-sm-12 mb-0">@lang('main.created_at'):
                                {{ $city->created_at->calendar() }} </div>
                            <div class="card-title col-md-6 col-sm-12 mb-0">@lang('main.updated_at'):
                                {{ $city->updated_at->calendar() }} </div>
                        </div>
                        <hr>
                        <div class="card-text">
                            <div class="row">

                                {{-- EN Name --}}
                                <div class="col-md-6 col-sm-12">
                                    <div class="h6">
                                        <span class="font-weight-bold">@lang('main.en_name'): </span>
                                        <span class="text-muted">{{ $city->en_name }}</span>
                                    </div>
                                    <hr>
                                </div>

                                {{-- AR Name --}}
                                <div class="col-md-6 col-sm-12">
                                    <div class="h6">
                                        <span class="font-weight-bold">@lang('main.ar_name'): </span>
                                        <span class="text-muted">{{ $city->ar_name }}</span>
                                    </div>
                                    <hr>
                                </div>
                                
                                {{-- Country --}}
                                <div class="col-md-6 col-sm-12">
                                    <div class="h6">
                                        <span class="font-weight-bold">@lang('main.country'): </span>

                                        @if (!! $city->country)
                                            <a href="{{ $city->country->path() }}" target="_blank">{{ $city->country->name_by_lang }}</a>
                                        @else 
                                            <span class="text-muted">@lang('main.not_found')</span>
                                        @endif
                                    </div>
                                    <hr>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-6 col-sm-12">
                                    <div class="h6">
                                        <span class="font-weight-bold">@lang('main.status'): </span>

                                        @if ($city->isActive())
                                            <span class="badge badge-success">@lang("main.active")</span>
                                        @else
                                            <span class="badge badge-danger">@lang("main.disable")</span>
                                        @endif
                                    </div>
                                    <hr>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection