<?php

namespace MixCode;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MixCode\Notifications\NewContactMessage;
use MixCode\Utils\UsingUuid;
use Notification;

class Contact extends Model
{
    use UsingUuid;

    protected $fillable = ['name', 'email', 'phone', 'message'];
 

      /**
     * Notify Admins for new message
     *
     * @return \MixCode\Contact
     */
    public function notifyAdminsForNewMessage()
    {
        Notification::send(User::typeAdmin()->get(), new NewContactMessage($this));

        return $this;
    }
}
