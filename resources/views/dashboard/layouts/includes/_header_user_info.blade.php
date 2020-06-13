<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 text-gray-600 small">
            <i class="fa-angle-down text-gray-400"></i>
            {{ auth()->user()->full_name }}
        </span>
        {{-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> --}}
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        {{-- <a class="dropdown-item" href="#">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            @lang('site.profile')
        </a> --}}

        <a class="dropdown-item {{ active_route('dashboard.settings.*') }}" href="{{ route('dashboard.settings.show') }}">

            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            @lang('main.settings')
        </a>
        {{-- <a class="dropdown-item" href="#">
            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
            Activity Log
        </a> --}}
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            @lang('main.logout')
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item disabled" href="#">
            <i class="fas fa-tags fa-sm fa-fw mr-2 text-gray-400"></i>
            @lang('main.mx_mixcode_board_version') 0.5v
        </a>
    </div>
</li>