<?php

namespace MixCode\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use MixCode\User ;

class ForgetPasswordToken extends Notification
{
    use Queueable;
    public $user ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( User $user)
    {
        $this->user = $user ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [  'message' => 'code sent successfully']; //trans("main.card_activated_successfully")
    }
}
