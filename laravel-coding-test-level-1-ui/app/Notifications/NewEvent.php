<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewEvent extends Notification
{
    use Queueable;
    private $event;
    private $user_name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($event, $user_name)
    {
        $this->event = $event;
        $this->user_name = $user_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hello '.$this->user_name)
                    ->line('A new event has been created!')
                    ->line('Event name: '.$this->event->name)
                    ->line('Start: '.date('l, F d y h:i:s', strtotime($this->event->startAt)))
                    ->line('End: '.date('l, F d y h:i:s', strtotime($this->event->endAt)))
                    ->action('More', url('/events'))
                    ->line('Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
