@extends('dashboard.layouts.app')

@section('section', $sectionName)

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $sectionName }}</h1>
    <div>
        <a href="{{ route('dashboard.courses.edit', $course) }}"
            class="d-sm-inline-block btn btn-sm btn-info shadow-sm">
            <i class="fas fa-edit fa-sm text-white-50"></i>
            @lang('main.edit')
        </a>

        <a href="{{ route('dashboard.courses.destroy',  $course) }}"
            class="d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal"
            data-target="#deleteModel-{{ $course->id }}" title="@lang('main.delete')">
            <i class="fas fa-trash fa-sm text-white-50"></i>
            @lang('main.delete')
        </a>

        <a href="{{ route('dashboard.courses.create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            @lang('main.add') @lang('main.courses')
        </a>

        <a href="{{ route('dashboard.courses.index') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-paperclip fa-sm text-white-50"></i>
            @lang('main.show_all') @lang('main.courses')
        </a>

        @component('dashboard.components.deleteModelForm')
            @slot('id', $course->id )
            @slot('deleteTitle', trans('main.courses') . ' ' . $course->name_by_lang)
            @slot('url', route('dashboard.courses.destroy', $course->id) )
        @endcomponent

    </div>
</div>

<!-- Content Row -->
<div class="row">
 
    <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
        <div class="card  border-left-success">
            <div class="row no-gutters">
                
                <div class="col-md-12 col-sm-12">

            <div class="card-body">
                <div class="card-title font-weight-bold h5 text-center  row">
                    <div class="card-title col-md-6 col-sm-12 mb-0">@lang('main.created_at'):
                        {{ $course->created_at->calendar() }} </div>
                    <div class="card-title col-md-6 col-sm-12 mb-0">@lang('main.updated_at'):
                        {{ $course->updated_at->calendar() }} </div>
                </div>
                <hr>
                <div class="card-text">
                    <div class="row">

                        {{-- EN Name --}}
                        <div class="col-md-6 col-sm-12">
                            <div class="h6">
                                <span class="font-weight-bold">@lang('main.en_name'): </span>
                                <span class="text-muted">{{ $course->en_name }}</span>
                            </div>
                            <hr>
                        </div>

                        {{-- AR Name --}}
                        <div class="col-md-6 col-sm-12">
                            <div class="h6">
                                <span class="font-weight-bold">@lang('main.ar_name'): </span>
                                <span class="text-muted">{{ $course->ar_name }}</span>
                            </div>
                            <hr>
                        </div>
                        
                    </div>
                </div>
                

                <div class="card-text">
                    <div class="row">

                        {{-- EN Name --}}
                        <div class="col-md-6 col-sm-12">
                            <div class="h6">
                                <span class="font-weight-bold">@lang('main.ar_overview'): </span>
                                <span class="text-muted">{!! $course->ar_overview !!}</span>
                            </div>
                            <hr>
                        </div>

                        {{-- AR Name --}}
                        <div class="col-md-6 col-sm-12">
                            <div class="h6">
                                <span class="font-weight-bold">@lang('main.en_overview'): </span>
                                <span class="text-muted">{!! $course->en_overview !!}</span>
                            </div>
                            <hr>
                        </div>
                        
                    </div>
                </div>
            </div>

          

        <div class="col-md-4 col-sm-12">
            <img src="{{ $course->mainMediaUrl() }}" class="card-img-top card-custom-image" alt="{{ $course->name_by_lang }}">
        </div>
    </div>


</div>
@endsection