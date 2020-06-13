@extends('dashboard.layouts.app')

@section('section', $sectionName)

@section('content')


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $sectionName }}</h1>
    <div>

        <a href="{{ route('dashboard.contacts.destroy',  $contact) }}"
            class="d-sm-inline-block btn btn-sm btn-danger shadow-sm mr-1" data-toggle="modal"
            data-target="#deleteModel-{{ $contact->id }}" title="@lang('main.delete')">
            <i class="fas fa-trash fa-sm text-white-50"></i>
            @lang('main.delete')
        </a>

        <a href="{{ route('dashboard.contacts.index') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-user-tie fa-sm text-white-50"></i>
            @lang('main.show_all') @lang('main.contacts')
        </a>

        @component('dashboard.components.deleteModelForm')
            @slot('id', $contact->id )
            @slot('deleteTitle', trans('main.contact') . ' ' . $contact->name)
            @slot('url', route('dashboard.contacts.destroy', $contact->id) )
        @endcomponent

    </div>
</div>

<!-- Content Row -->
<div class="row">

    <div class="col-xl-1 col-md-1"></div>
    <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
        <div class="card border-left-success">
            <div class="card-body">
                <div class="card-text">
                    <div class="row">

                        {{-- Name --}}
                        <div class="col-md-6 col-sm-12">
                            <div class="h6">
                                <span class="font-weight-bold">@lang('main.name'): </span>

                                <span class="text-muted">{{ $contact->name }}</span>
                            </div>
                            <hr>
                        </div>

                        
                        {{-- Email --}}
                        <div class="col-md-6 col-sm-12">
                            <div class="h6">
                                <span class="font-weight-bold">@lang('main.email'): </span>

                                <span class="text-muted">{{ $contact->email }}</span>
                            </div>
                            <hr>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-12 col-md-12 col-sm-12">
        <div class="card border-left-info">
            <div class="card-body">
                <h5 class="card-title"><strong>@lang('main.message'): </strong></h5>
                <p class="card-text">
                    {{ $contact->message }}
                </p>

            </div>
        </div>
    </div>

</div>


@endsection