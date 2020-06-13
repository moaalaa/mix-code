<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow-sm">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    {{-- <a class="navbar-brand custom-navbar-brand text-muted font-weight-bold" href="{{ route('dashboard.dashboard') }}">
        @if (isLang('ar'))
            @lang('main.mx_board') <sub> @lang('main.mx_mixcode') </sub>
        @else
            @lang('main.mx_mixcode') <sub> @lang('main.mx_board') </sub>
            
        @endif
    </a> --}}
    {{-- <a class="navbar-brand custom-navbar-brand" href="{{ route('dashboard.dashboard') }}">
        <img src="{{ asset('/dashboard_assets/img/mixcode-board-v2-logo.svg') }}" alt="">
    </a> --}}


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Notifications -->
        {{-- @include('dashboard.layouts.includes._header_notifications') --}}
        

        <!-- Nav Item - Messages -->
        {{-- @include('dashboard.layouts.includes._header_messages') --}}
        
        {{-- <div class="topbar-divider d-none d-sm-block"></div> --}}
        
        <!-- Nav Item - languages -->
        @include('dashboard.layouts.includes._header_languages')
        
        <div class="topbar-divider d-none d-sm-block"></div>
        
        <!-- Nav Item - User Information -->
        @include('dashboard.layouts.includes._header_user_info')
        

    </ul>

</nav>