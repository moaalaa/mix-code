<div class="page-actions">
    <div class="btn-group">
        <button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
            <span class="hidden-sm hidden-xs">
                {{ trans('main.show') }} {{ trans('main.shortcuts') }}&nbsp;
            </span>
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="{{ route('dashboard.settings.show') }}">
                    <i class="fa fa-gears"></i>
                    {{ trans('main.show') }} {{ trans('main.settings') }}
                </a>
            </li>
            
            <li>
                <a href="{{ route('dashboard.users.index') }}">
                    <i class="fa fa-users"></i>
                    {{ trans('main.show') }} {{ trans('main.users') }}
                </a>
            </li>
            
        </ul>
    </div>
</div>