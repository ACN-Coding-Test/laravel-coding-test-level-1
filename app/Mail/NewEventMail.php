<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEventMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user;
    protected $event;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $event)
    {
        $this->user = $user;
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $sender = 'Admin';
        $address = 'info@admin.com';
        $subject = 'New Event created';
        return $this->markdown('events.mail.newEventMail')
            ->from($address, $sender)
            ->subject($subject);
    }
}
