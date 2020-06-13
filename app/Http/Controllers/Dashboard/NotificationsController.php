<?php

namespace MixCode\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use MixCode\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    protected $viewPath = 'dashboard.notifications';

    public function show(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        
        $sectionName = trans('main.new_order_requested', ['sender' => $notification->data['sender']]);

        return view("{$this->viewPath}.show", compact('sectionName', 'notification'));
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications()->update(['read_at' => now()]);

        return back();
    }
}
