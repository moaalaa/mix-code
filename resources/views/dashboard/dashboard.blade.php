@extends('dashboard.layouts.app')


@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('main.dashboard')</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- admins Card -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">@lang('main.admin')</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $admins_count }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-cog fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Card -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">@lang('main.users')</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users_count }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- services Card -->
     <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">@lang('main.services')</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $services_count }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>  


        <!-- crds Card -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">@lang('main.portfolios')</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $portfolios_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


      


    <!-- Messages Card -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">@lang('main.contacts')</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $messages_count }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--     
    <div class="col-xl-12 col-md-12 mb-4">
        <div class="card">
            <div class="card-body text-center text-info">
                Statistics Comming Soon
            </div>
        </div>
    </div> --}}

</div>

@endsection