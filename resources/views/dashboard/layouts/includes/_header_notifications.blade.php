@php
    $notificationsCount = auth()->user()->unReadNotifications()->count();
@endphp

<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Notifications -->
        <span class="badge badge-danger badge-counter">{{ $notificationsCount }}</span>
    </a>

    <!-- Dropdown - Notifications -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header"> @lang('main.notifications_center') </h6>
        @foreach (auth()->user()->unreadNotifications as $notification)
        
            <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard.notifications.show', $notification) }}">
                <div class="mr-3">
                    <div class="icon-circle bg-success">
                        <i class="fas fa-shopping-cart text-white"></i>
                    </div>
                </div>

                <div>
                    <div class="small text-gray-500">{{ $notification->created_at->calendar() }}</div>
                    @if ($notification->unread())
                        <div class="font-weight-bold">@lang('main.new_order_requested', ['sender' => $notification->data['sender']])</div>
                    @else
                        <div class="font-weight-normal">@lang('main.new_order_requested', ['sender' => $notification->data['sender']])</div>
                    @endif
                    
                </div>
            </a>
        @endforeach
        
        @if ($notificationsCount == 0)
            <a class="dropdown-item text-center small text-gray-500" href="#">@lang('main.no_notifications')</a>
        @else
            <a class="dropdown-item text-center small text-gray-500" href="{{ route('dashboard.notifications.mark_all_as_read') }}">@lang('main.mark_all_notifications_as_read')</a>
        @endif
    </div>
</li>
