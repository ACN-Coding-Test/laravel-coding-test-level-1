<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $eventData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($eventData)
    {
        $this->eventData = $eventData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Event Created')
            ->markdown('emails.event-created')
            ->with('eventData', $this->eventData);
    }
}
