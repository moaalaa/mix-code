@extends('dashboard.layouts.app')

@section('section', $sectionName)

@section('content')


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $sectionName }}</h1>
        <div>
            <a href="{{ route('dashboard.users.edit', $user) }}" class="d-sm-inline-block btn btn-sm btn-info shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i>
                @lang('main.edit')
            </a>

            <a href="{{ route('dashboard.users.destroy',  $user) }}" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#deleteModel-{{ $user->id }}"  title="@lang('main.delete')">
                <i class="fas fa-trash fa-sm text-white-50"></i>
                @lang('main.delete')
            </a>
            
            {{-- <a href="{{ route('dashboard.users.create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i>
                @lang('main.add') @lang('main.users')
            </a> --}}

            <a href="{{ route('dashboard.users.index') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-users fa-sm text-white-50"></i>
                    @lang('main.show_all') @lang('main.users')
            </a>

            @component('dashboard.components.deleteModelForm')
                @slot('id', $user->id )
                @slot('deleteTitle', trans('main.user') . ' ' . $user->full_name)
                @slot('url', route('dashboard.users.destroy', $user->id) )
            @endcomponent
            
        </div>
    </div>
    
    <!-- Content Row -->
    <div class="row">
    
        <div class="col-xl-1 col-md-1"></div>
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card mb-3">
                <div class="card-body border-left-info">
                    <div class="card-title font-weight-bold h5 text-center  row">
                        <div class="card-title col-md-6 col-sm-12 mb-0">@lang('main.created_at'): {{ $user->created_at->calendar() }} </div>
                        <div class="card-title col-md-6 col-sm-12 mb-0">@lang('main.updated_at'): {{ $user->updated_at->calendar() }} </div>
                    </div>
                    <hr>
                    <div class="card-text">
                        <div class="row">
                            @include('dashboard.users.includes.show._basic_info')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    
    </div>
    
    @if ($user->isCustomer())
        
        <!-- Content Row -->
        {{-- <div class="row">    
            <div class="col-xl-1 col-md-1"></div>
            <div class="col-xl-12 col-md-12 col-sm-12">
                <div class="card mb-3">
                    <div class="card-body border-left-primary">
                        <div class="card-title font-weight-bold h4">@lang('main.social_links')</div>
                        <hr>
                        <div class="card-text">
                            <div class="row">
                                @include('dashboard.users.includes.show._social_info')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> --}}
    
        <!-- Content Row -->
        <div class="row">    
            <div class="col-xl-1 col-md-1"></div>
            <div class="col-xl-12 col-md-12 col-sm-12">
                <div class="card mb-3">
                    <div class="card-body border-left-danger">
                        <div class="card-title font-weight-bold h4">@lang('main.files')</div>
                        <hr>
                        <div class="card-text">
                            <div class="row">
                                @php
                                    $media = $user->userMedia();
                                @endphp

                                @include('dashboard.users.includes.show._files_info')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        
        </div>
    @endif
    

@endsection