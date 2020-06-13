<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion " id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ dashboardUrl('/') }}">
         {{-- <div class="sidebar-brand-img">
            <img src="{{ asset('/dashboard_assets/img/logo-white.svg') }}" alt="Mix Code Board" title="MixCode Board">
          </div>
          <div class="sidebar-brand-text mx-3">Board</div> --}}
        <div class="mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ active_route('dashboard.dashboard') }}">
        <a class="nav-link" href="{{ dashboardUrl('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>@lang('main.dashboard')</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        @lang('main.trips')
    </div>

    <!-- Nav Item Feature -->
    <li class="nav-item {{ active_route('dashboard.features.*') }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFeatures" aria-expanded="true" aria-controls="collapseFeatures">
            <i class="fas fa-fw fa-paperclip"></i>
            <span>@lang('main.features')</span>
        </a>
        <div id="collapseFeatures" class="collapse" aria-labelledby="headingFeatures" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ active_route('dashboard.features.create') }}" href="{{ route('dashboard.features.create') }}">@lang('main.add') @lang('main.features')</a>
                <a class="collapse-item {{ active_route('dashboard.features.index') }}" href="{{ route('dashboard.features.index') }}">@lang('main.show_all') @lang('main.features')</a>
                <a class="collapse-item text-danger {{ active_route('dashboard.features.trashed') }}" href="{{ route('dashboard.features.trashed') }}">@lang('main.trashed')</a>
            </div>
        </div>
    </li>
    
    <!-- Nav Item Language -->
    <li class="nav-item {{ active_route('dashboard.languages.*') }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLanguages" aria-expanded="true" aria-controls="collapseLanguages">
            <i class="fas fa-fw fa-language"></i>
            <span>@lang('main.languages')</span>
        </a>
        <div id="collapseLanguages" class="collapse" aria-labelledby="headingLanguages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ active_route('dashboard.languages.create') }}" href="{{ route('dashboard.languages.create') }}">@lang('main.add') @lang('main.languages')</a>
                <a class="collapse-item {{ active_route('dashboard.languages.index') }}" href="{{ route('dashboard.languages.index') }}">@lang('main.show_all') @lang('main.languages')</a>
                <a class="collapse-item text-danger {{ active_route('dashboard.languages.trashed') }}" href="{{ route('dashboard.languages.trashed') }}">@lang('main.trashed')</a>
            </div>
        </div>
    </li>
    
    <!-- Nav Item Language -->
    <li class="nav-item {{ active_route('dashboard.trips.*') }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTrips" aria-expanded="true" aria-controls="collapseTrips">
            <i class="fas fa-fw fa-plane"></i>
            <span>@lang('main.trips')</span>
        </a>
        <div id="collapseTrips" class="collapse" aria-labelledby="headingTrips" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ active_route('dashboard.trips.create') }}" href="{{ route('dashboard.trips.create') }}">@lang('main.add') @lang('main.trips')</a>
                <a class="collapse-item {{ active_route('dashboard.trips.index') }}" href="{{ route('dashboard.trips.index') }}">@lang('main.show_all') @lang('main.trips')</a>
                <a class="collapse-item text-danger {{ active_route('dashboard.trips.trashed') }}" href="{{ route('dashboard.trips.trashed') }}">@lang('main.trashed')</a>
            </div>
        </div>
    </li>
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>