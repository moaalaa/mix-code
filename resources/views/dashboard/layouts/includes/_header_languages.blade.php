<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="languagesDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-lg fa-language fa-fw" ></i>
    </a>
    <!-- Dropdown - languages -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="languagesDropdown">
        <h6 class="dropdown-header">
            @lang('main.language_center')
        </h6>
        <a class="dropdown-item d-flex align-items-center {{ isLang('ar') ? 'text-muted' : '' }}" href="{{ route('change.language', ['lang' => 'ar']) }}">
            <div class="mr-3">
                <div class="icon-circle bg-info">
                    <i class="fas fa-language text-white"></i>
                </div>
            </div>
            <div>
                <span class="font-weight-bold">عربي</span>
            </div>
        </a>
        
        <a class="dropdown-item d-flex align-items-center {{ isLang('en') ? 'text-muted' : '' }}" href="{{ route('change.language', ['lang' => 'en']) }}">
            <div class="mr-3">
                <div class="icon-circle bg-success">
                    <i class="fas fa-language text-white"></i>
                </div>
            </div>
            <div>
                <span class="font-weight-bold">English</span>
            </div>
        </a>

    </div>
</li>