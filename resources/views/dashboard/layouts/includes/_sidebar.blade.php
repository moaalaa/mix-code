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
        @lang('main.users_and_settings')
    </div>

    <!-- Nav Item - Settings -->
    <li class="nav-item {{ active_route('dashboard.settings.*') }}">
        <a class="nav-link" href="{{ route('dashboard.settings.show') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>@lang('main.general_settings')</span>
        </a>
    </li>

    <!-- Nav Item Users -->
    <li class="nav-item {{ active_route('dashboard.users.*') }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
            <i class="fas fa-fw fa-users"></i>
            <span>@lang('main.users')</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ active_route('dashboard.users.create') }}" href="{{ route('dashboard.users.create') }}">@lang('main.add') @lang('main.users')</a>
                <a class="collapse-item {{ active_route('dashboard.users.index') }}" href="{{ route('dashboard.users.index') }}">@lang('main.show_all') @lang('main.users')</a>
                <a class="collapse-item text-danger {{ active_route('dashboard.users.trashed') }}" href="{{ route('dashboard.users.trashed') }}">@lang('main.trashed')</a>
            </div>
        </div>
    </li>

    

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        @lang('main.categories')
    </div>

    <!-- Nav Item Category -->
    <li class="nav-item {{ active_route('dashboard.categories.*') }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true" aria-controls="collapseCategories">
            <i class="fas fa-fw fa-tag"></i>
            <span>@lang('main.categories')</span>
        </a>
        <div id="collapseCategories" class="collapse" aria-labelledby="headingCategories" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ active_route('dashboard.categories.create') }}" href="{{ route('dashboard.categories.create') }}">@lang('main.add') @lang('main.categories')</a>
                <a class="collapse-item {{ active_route('dashboard.categories.index') }}" href="{{ route('dashboard.categories.index') }}">@lang('main.show_all') @lang('main.categories')</a>
                <a class="collapse-item text-danger {{ active_route('dashboard.categories.trashed') }}" href="{{ route('dashboard.categories.trashed') }}">@lang('main.trashed')</a>
            </div>
        </div>
    </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
    
      <!-- Heading -->
      <div class="sidebar-heading">
          @lang('main.services_and_courses')
      </div>

    <li class="nav-item {{ active_route('dashboard.services.*') }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseservices" aria-expanded="true" aria-controls="collapseservices">
            <i class="fas fa-fw fa-paperclip"></i>
            <span>@lang('main.services')</span>
        </a>
        <div id="collapseservices" class="collapse" aria-labelledby="headingservices" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ active_route('dashboard.services.create') }}" href="{{ route('dashboard.services.create') }}">@lang('main.add') @lang('main.services')</a>
                <a class="collapse-item {{ active_route('dashboard.services.index') }}" href="{{ route('dashboard.services.index') }}">@lang('main.show_all') @lang('main.services')</a>
                <a class="collapse-item text-danger {{ active_route('dashboard.services.trashed') }}" href="{{ route('dashboard.services.trashed') }}">@lang('main.trashed')</a>
            </div>
        </div>
    </li>


    <li class="nav-item {{ active_route('dashboard.courses.*') }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecourses" aria-expanded="true" aria-controls="collapsecourses">
            <i class="fas fa-fw fa-paperclip"></i>
            <span>@lang('main.courses')</span>
        </a>
        <div id="collapsecourses" class="collapse" aria-labelledby="headingcourses" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ active_route('dashboard.courses.create') }}" href="{{ route('dashboard.courses.create') }}">@lang('main.add') @lang('main.courses')</a>
                <a class="collapse-item {{ active_route('dashboard.courses.index') }}" href="{{ route('dashboard.courses.index') }}">@lang('main.show_all') @lang('main.courses')</a>
                <a class="collapse-item text-danger {{ active_route('dashboard.courses.trashed') }}" href="{{ route('dashboard.courses.trashed') }}">@lang('main.trashed')</a>
            </div>
        </div>
    </li>



    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        @lang('main.portfolios')
    </div>

    <li class="nav-item {{ active_route('dashboard.portfolios.*') }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseportfolios" aria-expanded="true" aria-controls="collapseportfolios">
             <i class="fa fa-gift"></i>
            <span>@lang('main.portfolios')</span>
        </a>
        <div id="collapseportfolios" class="collapse" aria-labelledby="headingportfolios" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ active_route('dashboard.portfolios.create') }}" href="{{ route('dashboard.portfolios.create') }}">@lang('main.add') @lang('main.portfolios')</a>
                <a class="collapse-item {{ active_route('dashboard.portfolios.index') }}" href="{{ route('dashboard.portfolios.index') }}">@lang('main.show_all') @lang('main.portfolios')</a>
                <a class="collapse-item text-danger {{ active_route('dashboard.portfolios.trashed') }}" href="{{ route('dashboard.portfolios.trashed') }}">@lang('main.trashed')</a>
            </div>
        </div>
    </li>

  


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Nav Item - Contacts -->
    <li class="nav-item {{ active_route('dashboard.contacts.*') }}">
        <a class="nav-link" href="{{ route('dashboard.contacts.index') }}">
            <i class="fas fa-fw fa-envelope"></i>
            <span>@lang('main.contacts')</span>
        </a>
    </li>
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>